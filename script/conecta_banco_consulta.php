
<?php
//header('Content-Type: text/html; charset=utf-8');

function leitura_conection(){
	$servidor="localhost";
	$usuario_db= "usuarioleitura";
	$senha_db="1234";
	$banco= "academico1";
	$con = mysqli_connect( $servidor, $usuario_db, $senha_db, $banco);
	//verifica a conexão
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: ".mysqli_connect_error();
  }else{
	  return $con;
	}
}

function read($sql){
	$con = leitura_conection();
	$resp= mysqli_query($con, $sql);
	mysqli_close($con);
	return $resp;
}

function read_list($consult){
	return mysqli_fetch_assoc($consult);
}

function read_num_line($consult){
	return mysqli_num_rows($consult);
}
?>
	  