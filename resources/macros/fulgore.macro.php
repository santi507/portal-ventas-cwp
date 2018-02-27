<?php
function fulgore__form_field($name, $label, $field=null, $options=null) {
	$errors = session('errors', new Illuminate\Support\MessageBag);
?>
    <div class="form-group row">
        <div class="col-md-6 text-right"><?php echo $label ?>:</div>
        <div class="col-md-6">
	       	<?php if ($options && isset($options['icon'])): ?>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-fw fa-<?php echo $options['icon'] ?>"></i></div>
					<?php echo $field ?>
				</div>
			<?php elseif($options && isset($options['prefix'])): ?>
				<div class="input-group">
					<div class="input-group-addon"><?php echo $options['prefix'] ?></div>
					<?php echo $field ?>
				</div>
			<?php else: ?>
            	<?php echo $field ?>
            <?php endif; ?>
        </div>
        <div class="col-md-6 col-md-offset-6 sidetip">
        <?php
			if(count($errors->get($name)) == 0) {
				$current_value = Input::old($name);
			} else {
				foreach($errors->get($name) as $message){
					echo '<div class="error"><i class="fa fa-fw fa-times-circle"></i> '.$message.'</div>';
				}
			}
		?>
        </div>
    </div>
<?php
}

Form::macro('fulgore__sidetip', function($name, $options=null) {
	$errors = session('errors', new Illuminate\Support\MessageBag);

	if(count($errors->get($name)) == 0) {
		$current_value = Input::old($name);
	} else {
		foreach($errors->get($name) as $message){
			echo '<div class="error"><i class="fa fa-fw fa-times-circle"></i> '.$message.'</div>';
		}
	}
});

Form::macro('fulgore__field_text', function($name, $label, $value, $options=null) {
	$value = $value ?: old($name);
	$attributes = ['class' => 'form-control field-'.$name];

	if (isset($options)) {
		if (isset($options['autocomplete'])) {
			$attributes += ['autocomplete' => $options['autocomplete']];
		}
	}

	fulgore__form_field(
		$name,
		$label,
		Form::text($name, $value, $attributes),
		$options
	);
});

Form::macro('fulgore__field_checkbox', function($name, $label, $value, $selected, $options=null) {
	$value = $value ?: old($name);

	fulgore__form_field(
		$name,
		$label,
		Form::checkbox($name, $value, $selected, ['class' => 'form-control field-'.$name]),
		$options
	);
});

Form::macro('fulgore__field_money', function($name, $label, $value) {
	$value = $value ?: old($name);

	fulgore__form_field(
		$name,
		$label,
		Form::number($name, $value, ['class' => 'form-control field-'.$name, 'min' => 0, 'step' => '0.50']),
		['prefix' => 'B/.']
	);
});

Form::macro('fulgore__field_file', function($name, $label) {
	fulgore__form_field(
		$name,
		$label,
		Form::file($name)
	);
});

Form::macro('fulgore__field_textarea', function($name, $label, $value, $_attributes=null) {
	$value = $value ?: old($name);

	$attributes = ['class' => 'form-control field-'.$name];

	if ($_attributes) {
		$attributes += $_attributes;
	}

	fulgore__form_field(
		$name,
		$label,
		Form::textarea($name, $value, $attributes)
	);
});

Form::macro('fulgore__field_password', function($name, $label, $_attributes=null) {
	$attributes = ['class' => 'form-control field-'.$name];

	if ($_attributes) {
		$attributes += $_attributes;
	}

	fulgore__form_field(
		$name,
		$label,
		Form::password($name, $attributes)
	);
});

Form::macro('fulgore__field_select', function($name, $label, $value, $data, $_attributes=null) {
	$value = $value ?: old($name);

	$attributes = ['class' => 'form-control field-'.$name];

	if ($_attributes) {
		if (isset($_attributes['class'])) {
			$attributes['class'] .= ' ' .$_attributes['class'];
		} else {
			$attributes += $_attributes;
		}
	}

	fulgore__form_field(
		$name,
		$label,
		Form::select($name, $data, $value, $attributes)
	);
});

Form::macro('fulgore__field_selectRange', function($name, $label, $value, $start, $end) {
	$value = $value ?: old($name);

	fulgore__form_field(
		$name,
		$label,
		Form::selectRange($name, $start, $end, $value, ['class' => 'form-control field-'.$name])
	);
});

Form::macro('fulgore__field_date', function($name, $label, $value) {
	$value = $value ?: old($name);

	fulgore__form_field(
		$name,
		$label,
		Form::text($name, $value, ['class' => 'form-control datetimepicker field-'.$name, 'readonly' => true])
	);
});
