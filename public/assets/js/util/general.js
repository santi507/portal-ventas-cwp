$(document).on('ready', function() {
	$(".select2").select2();

	$('body').on('keyup', 'input.number-field', function(e) {
	    if (/\D/g.test(this.value)) {
	        this.value = this.value.replace(/\D/g, '');
	    }
	});

	$('.datetimepicker').datetimepicker({
	    pickTime: false,
	    language: 'es'
	});
});

function pad(str, max)
{
	str = str.toString();
	return str.length < max ? pad("0" + str, max) : str;
}

function enableField(field)
{
	field.removeAttr('disabled');
	field.prop('required', true);
}

function enableFields(fields)
{
	for (i = 0; i < fields.length; i++) {
		enableField(fields[i]);
	}
}

function disableField(field)
{
	field.prop('disabled', true);
	field.removeAttr('required');
}

function disableFields(fields)
{
	for (i = 0; i < fields.length; i++) {
		disableField(fields[i]);
	}
}