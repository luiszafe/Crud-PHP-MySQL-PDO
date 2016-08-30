<?php 
include ('dbCon.php');
$con = dbConn::getConnection();
 ?>

<!DOCTYPE html>
<!-- Crud (PHP, PDO, jQuery, Bootstrap, JSON, alertify)  20/junio/2016
author: Luis Zárate
github: https://github.com/luiszafe
email:  luiszaafe@gmail.com
 -->
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud Local Storage HTML5</title>
	<!-- incluimos cdn Boostrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	
	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.7.1/css/alertify.min.css"/>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/alertifyjs/1.7.1/css/themes/bootstrap.min.css"/>
	<style>
	/* centran los encabezados y filas de la tabla contactos*/
		td,th{
			text-align: center;
			vertical-align: middle;
		}
	</style>


</head>
<body>
	<!-- menu -->
			<nav role="navigation" class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand"><b>CRUD</b></a>
        </div>

        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            	<!-- javascript:void(0), idica que en lugar de ir al link del elemento (a), debe ejecutarse el codigo javascript indicado despues de los dos puntos-->
                <li><a id='btnNew' href="javascript:void(0)"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Nuevo</a></li>
                <li><a id='btnAdd' href="javascript:void(0)"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Registrar</a></li>
                <li><a id='btnBuscar' href="javascript:void(0)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Buscar</a></li>
                <li><a id='btnClean' href="javascript:void(0)"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Vaciar</a></li>
            </ul>
        </div>
</nav>
		<!--/ menu -->
	<div class="container">
		

		<div class="row">
			<div class="panel panel-info" >
		  <div class="panel-heading text-center">
		  	<h3><b>Libreria Hidalgo</b></h3>
		  </div>
		  <div class="panel-body">
		   	<div class="col-xs-3">
			Titulo<input type="text" class="form-control input-sm alfanumericos" id="txttitulo"/>
		</div>
		<div class="col-xs-3">
			Autor<input type="text" class="form-control input-sm alfabeticos" id="txtautor"/>
		</div>
		<div class="col-xs-1">
			# Hojas<input type="text" class="form-control input-sm enteros" id="txthojas"/>
		</div>
		<div class="col-xs-2">
			Precio<input type="text" class="form-control input-sm decimales" id="txtprecio"/>
		</div>
		<div class="col-xs-3">
			ISBN<input type="text" class="form-control input-sm alfanumericos" id="txtisbn"/>
		</div>
		<!--btnAdd para agregar contactos, btnSave para guardar los cambios de un contacto seleccionado -->
		
		<br><br>
<hr>
<span class="label label-default text-center">Libros disponibles</span>
<!--creamosla tabla  donde mostraremos los contactos -->
<table ID='tblContactos' class='table table-striped table-responsive table-hover'>
     <tr>     
     <th>Id</th>
     <th>Titulo</th>    
     <th>Autor</th>
     <th>Hojas</th>     
     <th>Precio</th> 
     <th>ISBN</th>  
     <th colspan="2" align="center">Acciones</th>
     </tr>
     <?php 
	/*
		$datos=$con->query('select * from Libros');
		$res=$datos->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($res as $item){
			echo '<tr>';			
	    	echo '<td>'. $item['Id_Libro'] .'</td>';    
	    	echo '<td>'. $item['Titulo'] .'</td>';
	    	echo '<td>'. $item['Autor'] .'</td>';
	    	echo '<td>'. $item['Hojas'] .'</td>';
	    	echo '<td>'. $item['Precio'] .'</td>';
	    	echo '<td>'. $item['ISBN'] .'</td>';	  
	    	echo '<td><a id="btnBorrar" class="btn btn-warning btn-sm" href="javascript:void(0)" alt="'. $item['Id_Libro'] .'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
	    	         <a data-toggle="modal" data-target="#myModal" id="btnSelec" class="btn btn-danger btn-sm" href="javascript:void(0)"" alt="'. $item['Id_Libro'] .'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>';	  

	    	         
	    	echo '</tr>';
    }
*/
	 ?>

     </table>


		  </div>
		  <div class="panel-footer">
		  	<div class="row">
		  	<div  class='col-xs-5 text-left'>June 2016 <a href="https://github.com/luiszafe">luiszafe</a> </div><div  class='col-xs-7 text-right'>Crud (PHP, PDO, MySQL, jQuery, Bootstrap, JSON, alertify)</div>
		  	</div>
		  </div>


		</div> <!-- /fin div row  -->
	

	</div>	<!-- /fin div container  -->
	





<div id='popup' class="hide">
	
</div>



<!--incluimos jQuery 	-->
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>




<script src="operaciones.js" ></script>
<script src="validator.js" ></script>



	<!-- incluimos cdn JavaScript de Boostrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/alertifyjs/1.7.1/alertify.min.js"></script>


	<!-- VENTANA MODAL / POPUP -->
<div class="modal fade" tabindex="-1" role="dialog" id='myModal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center"><b>Acualizar Libro</b></h4>
      </div>
      <div class="modal-body">
       
       <div class="row">
			<input type="text" class="hidden" id="txtlibro_id" value='0' />
			<div class="col-xs-6">Titulo<input type="text" class="form-control input-sm alfanumericos" id="txttitulo_" required /></div>
			<div class="col-xs-6">Autor<input type="text" class="form-control input-sm alfabeticos" id="txtautor_"/></div>
			<div class="col-xs-6">Precio<input type="text" class="form-control input-sm decimales" id="txtprecio_"/></div>
			<div class="col-xs-6">ISBN<input type="text" class="form-control input-sm alfanumericos" id="txtisbn_"/></div>
			<div class="col-xs-6"># Hojas<input type="text" class="form-control input-sm enteros" id="txthojas_"/></div>
			

		</div>
        <!-- -->
      </div>
      <div class="modal-footer">      	
      	<div id ='msj' class="alert alert-info" style='display:none; font-size:11px; text-align:center'></div>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id='btnHideModal'>Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnUpdate">Guardar Cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- TERMINA VENTANA MODAL / POPUP -->



</body>
</html>