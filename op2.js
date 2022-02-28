$(document).ready(function(){
	$(".btn-guardar-prof").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("href");
		swal({
		  title: '¿Estás seguro?',
          text: "¿Desea guardar?",
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
            document.tuformulario.submit()
        });
        
	});
});
$(document).ready(function(){
	$(".btn-guardar-curs").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("hsref");
		swal({
		  title: '¿Estás seguro?',
          text: "¿Desea guardar?",
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
            document.tuformulario2.submit()
        });
        
	});
});
$(document).ready(function(){
	$(".btn-guardar-alum").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("hsref");
		swal({
		  title: '¿Estás seguro?',
          text: "¿Desea guardar?",
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
            document.tuformulario3.submit()
        });
        
	});
});
