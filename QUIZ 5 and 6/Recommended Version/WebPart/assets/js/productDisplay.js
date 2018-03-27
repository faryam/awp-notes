$(document).ready(function () {
	$(".toggle-sidebar").click(function () {
		$("#sidebar").toggleClass("collapsed");
		$("#content").toggleClass("col-md-12 col-md-9");
	});
	$('#example').DataTable({
		ajax: {
			url:'../API/api.php',
			method:'GET',
			data:{method:'getProducts'},
			dataSrc: 'data'
		},
		columns: [
			 { "data": "name" },
			 { "data": "description" },
			 { "data": "price" },
			 { "data": "category_name" },
			 { "data": null,
				"className": "text-center",
				"defaultContent": '<a href="#" class="btn btn-primary a-btn-slide-text btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a><a href="#" class="btn btn-danger a-btn-slide-text btn-xs" style="margin-left:5px"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>'
			 }
		]
	});
});