<?php

$con = new mysqli("localhost", "root", "rootroot");
mysqli_select_db($con,"saludsecure");

if ($con->connect_error){
	die("Connection failed: ".$con ->connect_error);
}

$data=array();

    												
	$sql="Select idusuario from paciente where usuario='".$_REQUEST['usu']."' and contrasena='".$_REQUEST['pass']."'";
	$res=$con->query($sql);
	
	if($res->num_rows > 0){ 		//ya existe un usuario														
											
		$data['status']='err';
    	$data['result']= '';
	}else{							//como no existe el usuario, va a registrarse con ese nombre, por lo tanto ejecutamos y preparamos al sql.
		$sql= "INSERT INTO paciente (nombre,apellido,dni,credencial,nacimiento,contrasena,usuario) VALUES ('".$_REQUEST['nom']."','".$_REQUEST['ape']."','".$_REQUEST['dni']."','".$_REQUEST['credencial']."','".$_REQUEST['nac']."','".$_REQUEST['pass']."','".$_REQUEST['usu']."')";
			$res=$con->query($sql);
			if($res==1){
				$data['status']='ok';
    			$data['result']= '1';
			}else{
				$data['status']='error';
    			$data['result']= '1';
			}
	}
	echo json_encode($data);
	$con->close();	
	//http://localhost/SaludSecure/php/registrar.php?usu=AxelMan&pass=axelitosal&nom=kevin&ape=Kali&dni=666					
?>




