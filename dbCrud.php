<?php
 include('dbCon.php');
$con = dbConn::getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$data = json_decode(file_get_contents("php://input"));
//var_dump($data);
//xit();
$action = $data->action;
//$action='getall';
//if(isset($_POST['action']) && !empty($_POST['action'])) {
    //$action = $_POST['action'];
		switch ($action){
			case 'add':
			//print_r($con);
			RegistrarLibro($data,$con);
			break;

			case 'delete':
			BorrarLibro($data,$con);
			break;

			case 'update':
			ActualizarLibro($data,$con);
			break;

			case 'getall':
			getLibros($con);
			break;

			case 'clean':
			CleanLibreria($con);
			break;


			default:
				echo "{'res':'opción inválida'}";


		}//switch

		
}//if


 function RegistrarLibro($data,$con){
	try {
	$stmt=$con->prepare('INSERT  INTO libros VALUES(null, :titulo, :autor, :hojas, :precio, :isbn) ');
	$stmt->bindParam('titulo', $data->titulo);
	$stmt->bindParam('autor', $data->autor);
	$stmt->bindParam('hojas', $data->hojas);
	$stmt->bindParam('precio', $data->precio);
	$stmt->bindParam('isbn', $data->isbn);
	$res = $stmt->execute();	
	if ($res ==1)
		echo 'SE REGISTRÓ EL LIBRO <b>'. $data->titulo .'</b> CON EL ID: <b>'. $con->lastInsertId() .'</b>';
	else
	echo 'ERROR AL REGISTRAR EL LIBRO';
	
	} catch (PDOException $e) {
            $e->getMessage();
            echo $e;
      }
	

}
function BorrarLibro($data, $con){
	try {
		$stmt = $con->prepare('DELETE FROM Libros WHERE Id_Libro = :id');
		$stmt->bindParam('id', $data->IdLibro);
		$stmt->execute();		
		echo 'LIBRO ELIMINADO';
		
	} catch (PDOException $e) {
            $e->getMessage();
            echo $e;
      }
	
}

function ActualizarLibro($data, $con){
	try {
		// console.log($data->libro_id);
		 $stmt =$con->prepare('UPDATE Libros SET titulo=:titulo, autor=:autor, hojas=:hojas, precio=:precio, isbn=:isbn WHERE id_libro=:idlibro');
		 $stmt->bindParam('titulo', $data->titulo);
		 $stmt->bindParam('autor', $data->autor);
		 $stmt->bindParam('hojas', $data->hojas);
		 $stmt->bindParam('precio', $data->precio);
		 $stmt->bindParam('isbn', $data->isbn);
		 $stmt->bindParam('idlibro', $data->libro_id);
		 $stmt->execute();		 		 
		echo 'LIBRO ACTUALIZADO';

	} catch (PDOException $e) {
		$e->getMessage();
		echo $e;
	}




	
}
function getLibros($con){
	$stmt = $con->prepare('SELECT * FROM Libros order by titulo desc');
	$stmt->execute();
	$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//print_r($res);
	echo json_encode($res);
	//$someJSON= (json_encode($res));
	//$someObject = json_decode($someJSON);
	//echo $someJSON;
	//echo '{"users":'.json_encode($res).'}';

}


function CleanLibreria($con){
	try {
		$stmt = $con->prepare('DELETE FROM libros; ALTER TABLE Libros AUTO_INCREMENT = 1');
		$stmt->execute();
		echo 'SE ELIMINARON TODOS LOS LIBROS';
		
	} catch (PDOException $e) {
		$e->getMessage();
		echo $e;
	}
	

}

 ?>


