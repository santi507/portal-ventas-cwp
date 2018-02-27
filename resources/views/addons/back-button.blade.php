@if(isset($back_url))
<a href="{{ $back_url }}" class="btn btn-default">
	<i class="fa fa-fw fa-arrow-left"></i> Regresar
</a>
@endif

<!--<div class="main-back-button">
	<?php
		$route = request()->route()->getName();
		$split = explode('.', $route);
		$back_route = str_replace('.'.$split[count($split)-1], '', $route);
	?>

	@if($back_route != $route)
	<a href="{{ URL::previous() }}" class="btn btn-default">
		<i class="fa fa-fw fa-arrow-left"></i> Regresar
	</a>
	@endif
</div>-->