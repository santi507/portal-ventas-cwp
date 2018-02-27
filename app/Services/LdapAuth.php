<?php
namespace App\Services;

use Illuminate\Foundation\Application as App;
use Illuminate\Config\Repository as Config;
use Illuminate\Session\SessionManager as Session;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\InvalidAccessException;
use App\Exceptions\LdapConnectionException;
use Exception;
use ErrorException;

use App\Entities\Security\Role;
use App\Entities\Security\PermissionGroup;
use App\Entities\Security\Permission;


class LdapAuth
{
	protected $app     = null;
	protected $session = null;
	protected $config  = null;

	public function __construct(App $app, Session $session, Config $config)
	{
		$this->app     = $app;
		$this->config  = $config;
		$this->session = $session;
	}

	public function login($username, $password, $domain) {
		try {
			$domain = strtoupper($domain);

			$ldap_config = $this->config->get('auth.ldap.connection.' . $domain);
			$server = $ldap_config['path'];
			$dc     = $ldap_config['dc'];

			$ds = @ldap_connect($server);
			$ldapbind = ldap_bind($ds, $domain.'\\'.$username, $password);

			//Valid credentials
			if ($ldapbind) {
				$groups = [];

				$sr = @ldap_search($ds, $dc, 'samaccountname=' . $username, ['memberof', 'primarygroupid', 'title', 'cn', 'thumbnailphoto']);
				$entries = @ldap_get_entries($ds, $sr);

				// No information found, bad user
				if($entries['count'] == 0) throw new InvalidAccessException;

				// Get groups and primary group token
				$groups_cn = $entries[0]['memberof'];

				// Remove extraneous first entry
				array_shift($groups_cn);

				foreach($groups_cn as $group) {
					$temp = explode(',', $group, 2);
					$temp = explode('=', $temp[0]);
					$groups[] = $temp[1];
				}

				$roles = $this->validateGroups($groups);

				//Take name
				if (array_key_exists('cn', $entries[0])) {
					$name = utf8_encode($entries[0]['cn'][0]);
				} else {
					$name = '';
				}

				//Take thumbnail photo
				if (array_key_exists('thumbnailphoto', $entries[0])) {
					$photo = $entries[0]['thumbnailphoto'][0];
				} else {
					$photo = '';
				}

				//Take position
				if (array_key_exists('title', $entries[0])) {
					$position = utf8_encode($entries[0]['title'][0]);
				} else {
					$position = '';
				}

				if ($roles) {
					$user = [
						'username' => $username,
						'groups'    => $roles,
						'name'     => $name,
						'photo'    => $photo,
						'position' => $position
					];

					$this->session->put('admin-auth', $user);

					return true;
				} else {
					throw new InvalidAccessException;
				}

			} else {
				throw new InvalidCredentialsException;
			}
		} catch(ErrorException $ex) {
			$message = $ex->getMessage();

			if($message == 'ldap_bind(): Unable to bind to server: Can\'t contact LDAP server') {
				throw new LdapConnectionException;
			} elseif($message == 'ldap_bind(): Unable to bind to server: Invalid credentials') {
				throw new InvalidCredentialsException;
			} else {
				throw new Exception;
			}
		}
	}

	public function validateGroups($groups) {
		$roles = Role::lists('name')->toArray();
		$valid_roles = [];

		foreach ($roles as $role) {
			if (in_array($role, $groups)) {
				$valid_roles[] = $role;
			}
		}

		if (count($valid_roles) > 0) {
			return $valid_roles;
		} else {
			return false;
		}
	}

	public function getCurrentUser()
	{
		$user = $this->session->get('admin-auth');
		return $user;
	}

	public function can($permission)
	{
		$user = $this->getCurrentUser();
		$groups = $user['groups'];

		$permissions = [];

		foreach ($groups as $group) {
			$role = $this->getRoleByName($group);

			if ($role) {
				$permissions = array_merge($permissions, $role['permissions']);
			}
		}

		if (count($permissions) > 0) {
			if (
				in_array($permission, $permissions)
				|| in_array('superadmin', $permissions)
			) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getRoleByName($role_name) {
		$role = Role::where('name', $role_name)->first();

		if ($role) {
			$role_arr = $role->toArray();
			$role_arr['permissions'] = $role->permissions->lists('name')->toArray();

			return $role_arr;
		} else {
			return false;
		}
	}
}