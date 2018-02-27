<?php

Html::macro('btn_show', function($route, $id) {
	$classes = 'display action btn btn-default btn-sm';

	$output = '<a href="'.route($route, $id).'" class="'.$classes.'">';
	$output.= '<i class="fa fa-fw fa-eye"></i>';
	$output.= '</a>';

	return $output;
});

Html::macro('btn_edit', function($route, $id) {
	$classes = 'edit action btn btn-default btn-sm';

	$output = '<a href="'.route($route, $id).'" class="'.$classes.'">';
	$output.= '<i class="fa fa-fw fa-pencil"></i>';
	$output.= '</a>';

	return $output;
});

Html::macro('btn_destroy', function($route, $id, $confirm_msg='¿En serio desea eliminar este elemento?') {
	$classes = 'destroy action btn btn-default btn-sm';

	$output = Form::open(['route' => [$route, $id], 'class' => 'action-btn']);
	$output.= Form::hidden('_method', 'DELETE');
	$output.= '<button type="submit" class="'.$classes.'" onclick="if(!confirm(\''.$confirm_msg.'\')){return false;}">';
	$output.= '<i class="fa fa-fw fa-trash"></i>';
	$output.= '</button>';
	$output.= Form::close();

	return $output;
});