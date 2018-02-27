<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

//Requests
use App\Http\Requests\Admin\AuthRequest;

//Exceptions
use Exception;
use App\Exceptions\LdapConnectionException;
use App\Exceptions\InvalidAccessException;
use App\Exceptions\InvalidCredentialsException;

//Facades
use Hash;

class AuthController extends Controller {

	public function __construct()
	{

	}

	public function login()
    {
        $domains = config('auth.ldap.domains');
        $domains_list = [];

        foreach ($domains as $domain) {
            $domains_list[$domain] = $domain;
        }

		return view('admin.login')->with('domains', $domains_list);
	}

    public function do_hybrid_login(AuthRequest $request)
    {
        $user = request()->input('username');
        $static_users = config('auth.ldap.static_users');

        foreach ($static_users as $key => $value) {
            if ($user == $key) {
                return $this->do_static_login();
            }
        }

        return $this->do_login($request);
	}

	public function do_static_login()
    {
        $domain   = request()->input('domains');
        $username = strtolower(request()->input('username'));
        $password = request()->input('password');

		$static_users = config('auth.ldap.static_users');

        try {
            //Validar si el usuario existe
            if (!isset($static_users[$username])) {
                throw new InvalidCredentialsException;
            } else {
                $user = $static_users[$username];

                //Validar password
                if ( ! Hash::check($password, $user['password']) ) {
                    throw new InvalidCredentialsException;
                } else {
                    session()->put('admin-auth', $user);
                    return redirect()->route('admin.index');
                }
            }
        } catch(InvalidCredentialsException $ex) {
            return redirect()->route('admin.login')->with('error', trans('messages.auth.login.error.invalid_credentials'));
        } catch(InvalidAccessException $ex) {
            return redirect()->route('admin.login')->with('error', trans('messages.auth.login.error.invalid_access'));
        } catch(LdapConnectionException $ex) {
            return redirect()->route('admin.login')->with('error', trans('messages.auth.login.error.connection_issues'));
        } catch(Exception $ex) {
            return redirect()->route('admin.login')->with('error', trans('messages.auth.login.error.unhandled_exception'));
        }

	}

    public function do_login(AuthRequest $request)
    {
        $domain   = request()->input('domains');
        $username = request()->input('username');
        $password = request()->input('password');

        $ldap = app('App\Services\LdapAuth');

        try {
            $ldap->login($username, $password, $domain);

            return redirect()->route('admin.index');
        } catch(InvalidCredentialsException $ex) {
            return redirect()->route('admin.login')->with('error', trans('messages.auth.login.error.invalid_credentials'));
        } catch(InvalidAccessException $ex) {
            return redirect()->route('admin.login')->with('error', trans('messages.auth.login.error.invalid_access'));
        } catch(LdapConnectionException $ex) {
            return redirect()->route('admin.login')->with('error', trans('messages.auth.login.error.connection_issues'));
        } catch(Exception $ex) {
            return redirect()->route('admin.login')->with('error', trans('messages.auth.login.error.unhandled_exception'));
        }
    }

    public function logout()
    {
        session()->forget('admin-auth');
        return redirect()->route('admin.login')->with('success', trans('messages.auth.logout.success'));
    } 
}