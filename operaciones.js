$(function(){
//seteamos la posiciones de las alertas en la esquina superior izquierda
alertify.set('notifier','position', 'top-left');
getAll();	

//alertify.alert('Ready!');
/*
alertify.confirm('Confirmar', '¿Confirmas eliminar el libro?', function(){
 alertify.success('Ok') 
}
    , function(){ alertify.error('Cancel')
});
*/


$(document).on('click','#btnSelec',function(){ 
	//$('#popo').popover();
		//tomamos los datos del libro elegido y lo guardamos en variables
		var libro_id= $(this).closest('tr').find('td:eq(0)').text();
		var titulo= $(this).closest('tr').find('td:eq(1)').text();
		var autor= $(this).closest('tr').find('td:eq(2)').text();
		var hojas= $(this).closest('tr').find('td:eq(3)').text();
		var precio= $(this).closest('tr').find('td:eq(4)').text();
		var isbn= $(this).closest('tr').find('td:eq(5)').text();

		// ponemos los datos en los inputs de la ventana modal/popup
		$('#txttitulo_').val(titulo);
		$('#txtautor_').val(autor);
		$('#txtprecio_').val(precio);
		$('#txthojas_').val(hojas);
		$('#txtisbn_').val(isbn);
		$('#txtlibro_id').val(libro_id);

		// $('#txthojas_').attr('data-placement','left')
   //add all atributes.....

   //and finally show the popover
   //$('#txthojas_').popover('show')


	});

$(document).on('click','#btnUpdate',function(){ 
//$('#btnUpdate').click(function(){
		//creamos el objeto json
		var datos =JSON.stringify({
		titulo: $('#txttitulo_').val(),
		autor: $('#txtautor_').val(),
		hojas: $('#txthojas_').val(),
		precio: $('#txtprecio_').val(),
		isbn: $('#txtisbn_').val(),
		libro_id: $('#txtlibro_id').val(),
		action: 'update'

				
		});

			$.post( "dbCrud.php", datos)
				  .done(function( data ) {
				  	 getAll();	
				    $("#btnHideModal").trigger('click');
				  	alertify.success(data); 
				  	//$('#msj').html(data);
				  	//$('#msj').show();
				    //cerramos la ventana modal despues de 5 segundos...
				    /*setTimeout(function(){
				    	$('#msj').html('');
				    	$('#msj').hide();
				        $("#btnHideModal").trigger('click');
				    }, 5000);

				   // $('input').val('');
				   */
			});
	});


	//click en boton nuevo
	$('#btnNew').click(function(){
		$('input').val('');
		$('#txttitulo').focus();
	});

	//eliminar libro
	$(document).on('click','#btnBorrar',function(){ 
		 //obtenemos el id_libro guardado en el atributo alt del boton
		 var idL= $(this).attr('alt');		 
		//preguntamos si confirma borrado
		alertify.confirm('Confirmar', '<b>¿Confirmas eliminar el libro?</b>', function(){		
		 //creamos el json con id_libro y la accion borrar
		var datos=JSON.stringify({
				IdLibro: idL,
				action: 'delete'
			});
		//hacemos post al crud de operaciones pasandole el json
		$.post( "dbCrud.php", datos)
		  .done(function( data ) {	
		    getAll();	  
		    alertify.success(data); 
		    $('input').val('');
		  });

		}//si no desea borrar mostramos el msj
		    , function(){ alertify.error('Borrar libro cancelado')
		});

		
		
	});

	//registrar libro
	$('#btnAdd').click(function(){
		if ($.trim($('#txttitulo').val())==''){			
					alertify.error('Ingresa el título');
					$('#txttitulo').focus();
				    return false;
		}
		if ($.trim($('#txtautor').val())==''){			
					alertify.error('Ingresa el autor');
					$('#txtautor').focus();
				    return false;
		}
		if ($.trim($('#txthojas').val())==''){			
					alertify.error('Ingresa el número de hojas');
					$('#txthojas').focus();
				    return false;
		}
		if ($.trim($('#txtprecio').val())==''){			
					alertify.error('Ingresa el precio');
					$('#txtprecio').focus();
				    return false;
		}
		if ($.trim($('#txtisbn').val())==''){			
					alertify.error('Ingresa el ISBN','position', 'top-right');
					$('#txtisbn').focus();
				    return false;
		}



		//creamos objeto json con los datos de los inputs
		var datos=JSON.stringify({
				titulo: $('#txttitulo').val(),
				autor: $('#txtautor').val(),
				hojas: $('#txthojas').val(),
				precio: $('#txtprecio').val(),
				isbn: $('#txtisbn').val(),
				action: 'add'
		});
		//hacemos post al crud de operaciones
		$.post( "dbCrud.php", datos)
		  .done(function( data ) {		   
		    //alertify.alert('Resultado', data);
		    alertify.alert('Resultado', data, function(){  getAll(); /*location.reload();*/ });
		   // $('input').val('');
		   
		  });
		
	});

	//obtenemos todos los libros
	function getAll(){
		var datos=JSON.stringify({
				action: 'getall'
			});

	$.post( "dbCrud.php", datos)
		  .done(function( data ) {		  
		 //borramos  todas las filas de la tabla excepto los encabezados
		$('#tblContactos tr:not(:first)').remove();
		 //convertimos string json de php a un OBJETO JSON jQuery
		  var dataa = jQuery.parseJSON(data);
        	
		 
		for(var i=0;i<dataa.length;i++){
			var newRow =
				"<tr>"
				+"<td>"+dataa[i].Id_Libro+"</td>"
				+"<td>"+dataa[i].Titulo+"</td>"
				+"<td>"+dataa[i].Autor+"</td>"
				+"<td>"+dataa[i].Hojas+"</td>"
				+"<td>"+dataa[i].Precio+"</td>"
				+"<td>"+dataa[i].ISBN+"</td>"			

				+"<td><a id='btnBorrar' class='btn btn-warning btn-sm' href='javascript:void(0)' alt="+ dataa[i].Id_Libro +"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>  "
	    	    +"<a data-toggle='modal' data-target='#myModal' id='btnSelec' class='btn btn-danger btn-sm' href='avascript:void(0)' alt="+ dataa[i].Id_Libro +"><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>"

				+"</tr>" ;
				$(newRow).appendTo("#tblContactos tbody");
		}//for
		$('input').val('');
		$('#txtTitulo').focus();


		    
		    
		  }); //POST
	}//getAll function


	//limpiar libreria
		$('#btnClean').click(function(){
			alertify.confirm('Confirmar', '<b>ESTA ACCIÓN ELIMINARÁ TODOS LOS LIBROS REGISTRADOS,<br> ¿ESTAS SEGURO?</b>', function(){		
		 //creamos el json con id_libro y la accion borrar
		    var datos=JSON.stringify({				
				action: 'clean'
			});
		//hacemos post al crud de operaciones pasandole el json
		$.post( "dbCrud.php", datos)
		  .done(function( data ) {	
		    getAll();	  
		    alertify.success(data); 		   
		  });

		}//si no desea borrar mostramos el msj
		    , function(){ alertify.error('Borrar todos los libros cancelado')
		});
		});


		$('#btnBuscar').click(function(){
			alertify.message('<b>El buscador estará pendiente para la siguiente entrega</b>'); 
		});


});