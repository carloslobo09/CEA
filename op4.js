$(document).ready(function(){
	$(".btn-exit-cuo").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("href");
		swal({ 
		  title: '¿Estás seguro?',
		  text: "¿Desea eliminar esta cuota?",
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Eliminar',
		  cancelButtonText: 'Cancelar'
        })
        .then(function () {
		  window.location.href=urlDir;
		});
	});
});