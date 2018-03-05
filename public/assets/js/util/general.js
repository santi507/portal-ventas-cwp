$(document).on('ready', function() {
	$('#shop_sellers').DataTable({
		"columns": [
			{"width": "12.5%"},
			{"width": "12.5%"},
			{"width": "12.5%"},
			{"width": "12.5%"},
			{"width": "12.5%"},
			{"width": "12.5%"},
			{"width": "12.5%"},
			{"width": "12.5%"},
		],
		"language": {
			"emptyTable": "No hay datos disponibles",
			"info": "",
			"infoEmpty": "",
			"lengthMenu": "",
			"search": "Buscar:",
			"paginate": {
		        "next":       "<i class='fa fa-caret-right'></i>",
		        "previous":   "<i class='fa fa-caret-left'></i>"
		    }
		}
	});
});

