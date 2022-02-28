$(document).ready(function(){
	$(".btn-guardar-usu").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("hsref");
		swal({
		  title: '¿Estás seguro?',
          text: "¿Desea guardar cambios?",
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Guardar',
		  cancelButtonText: 'Cancelar'
        })
        .then(function(){
            swal({
                type:'success',
                title:'Datos guardados con exito',
                showConfirmButton: false,
  timer: 1500
            })
            document.tuformulario4.submit()
        });
        
	});
});
$(document).ready(function(){
	$(".btn-guardar-cuo").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("hsref");
		swal({
          text: "¿Deseas pagar esta cuota?",
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Confirmar',
		  cancelButtonText: 'Cancelar'
        })
        .then(function(){
            swal({
                type:'success',
                title:'Datos guardados con exito',
                showConfirmButton: false,
  timer: 1500
            })
            document.tuformulario1.submit()
        });
        
	});
});