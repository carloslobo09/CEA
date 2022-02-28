$(document).ready(function(){
	$(".btn-exit-alumn").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("href");
		swal({
		  title: '¿Estás seguro?',
		  text: "¿Desea eliminar al profesor?",
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
$(document).ready(function(){
	$(".btn-exit-curs").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("href");
		swal({
		  title: '¿Estás seguro?',
		  text: "¿Desea eliminar este curso?",
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
$(document).ready(function(){
	$(".btn-exit-alum").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("href");
		swal({ 
		  title: '¿Estás seguro?',
		  text: "¿Desea eliminar este alumno?",
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
$(document).ready(function(){
	$(".btn-exit-usu").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("href");
		swal({
        
          title: '¿Deseas Cerrar Sesion?',
          type:'info', 
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Aceptar',
		  cancelButtonText: 'Cancelar'
        })
        .then(function () {
		  window.location.href=urlDir;
		});
	});
});
