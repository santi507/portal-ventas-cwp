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

	$('#products').DataTable({
		"pageLength": 8,
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

	$('#shops').DataTable({
		"pageLength": 8,
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

	//get subcategories
	$('.product_category').on('change', function(e){
		$('.product_subcategory').append("<option value=''>Cargando ...</option>");
		$.get(app_url + "/admin/subcategory/" + e.target.value, function(res, req){
			$('.product_subcategory').empty().append("<option value=''>Escoger opción</option>");
			for (i = 0; i < res.length; i++) {
				$('.product_subcategory').append("<option value='" + res[i].id + "' distrito='" + res[i].name + "'> " + res[i].name + "</option>");
			}
		});
	});

	//MESES GESTION
	moment.locale('es');

	for (var i = 0; i < 6; i++) {
		$('.meses').append("<option value='"+ moment().subtract(i,'months').format('YYYY-MM') +"'>" + moment().subtract(i,'months').format('MMMM, YYYY') + "</option>");
	}
});

