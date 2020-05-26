
<?php
//header('Content-Type: text/html; charset=utf-8');

function delete_conection(){
	$servidor="localhost";
	$usuario_db= "usuarioexclusao";
	$senha_db="1234";
	$banco= "academico1";
	$con = mysqli_connect( $servidor, $usuario_db, $senha_db, $banco);
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: ".mysqli_connect_error();
  }else{
	  return $con;
	}
}

function erase($sql){
	$con = delete_conection();
	$resp= mysqli_query($con, $sql);
	mysqli_close($con);
	return $resp;
}
?>
	  