<?php
include("valida_login.php");
if(isset($_GET["idaluno"], $_GET["iddoc"])){
	$idaluno = anti_injection($_GET["idaluno"]);	
	$iddoc = anti_injection($_GET["iddoc"]);	
	if($idaluno!="" and $iddoc!="" and is_numeric($iddoc)){
		$cad = write("INSERT INTO aluno_doc_p () VALUES ('$idaluno', '$iddoc')");
		echo "<script>alert('Documento associado ao aluno.'); location.href='aluno_perfil.php?id=$idaluno'; </script>";
	}else{
		echo "<script>alert('Dados incorretos, tente novamente'); history.go(-1);</script>";
	}
}else{
	echo "<script>alert('Dados incorretos, tente novamente'); history.go(-1);</script>";
}
?>