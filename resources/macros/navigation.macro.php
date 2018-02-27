<?php
Html::macro('auth_nav_li', function($route, $text, $fa=null, $permissions=null){

	//Validate permissions
	if ($permissions) {
		$auth = app('App\Services\LdapAuth');

		if (!$auth->can($permissions)) {
			return '';
		}
	}

	$is_active = false;

	//Current route
	$current_route = request()->route()->getName();

	if ($current_route == $route) {
		$is_active = true;
	} else {
		//Base route
		$split_route = explode('.', $current_route);
		$base_route = $split_route[0].'.'.$split_route[1];

		if ($base_route == $route) {
			$is_active = true;
		}
	}

	//Output <li>
	$output = '<li class="' . ($is_active ? 'active' : '') . '">';
	$output.= '<a href="'. route($route) . '">';

	if ($fa) {
		$output .= '<i class="fa fa-fw fa-'.$fa.'"></i> ';
	}

	$output.= $text;
	$output.= '</a>';
	$output.= '</li>';

	return $output;
});