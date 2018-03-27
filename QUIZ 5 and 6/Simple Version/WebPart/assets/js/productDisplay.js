$(document).ready(function () {
	$(".toggle-sidebar").click(function () {
		$("#sidebar").toggleClass("collapsed");
		$("#content").toggleClass("col-md-12 col-md-9");
	});
	$.ajax({
		url:'../API/api.php',
		type: 'GET',
		data:{method:"getProducts"},
		success: function (data) {
			if(data.status=='ok'){
				for (var key in data.data) {
					html ="<tr>";
					html +=		'<td>'+data.data[key]['name']+'</td>';
					html +=		'<td>'+data.data[key]['description']+'</td>';
					html +=		'<td>'+data.data[key]['price']+'</td>';
					html +=		'<td>'+data.data[key]['category_name']+'</td>';
					html +=		'<td><a href="#" class="btn btn-primary a-btn-slide-text btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a><a href="#" class="btn btn-danger a-btn-slide-text btn-xs" style="margin-left:5px"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>';
					html +="</tr>";
					$("#bodyProduct").append(html)
				}
				$('#example').DataTable();
			}
		},
		cache: false,
		contentType: false,
	});
});