<?php
include("valida_login.php");
if(isset($_GET["idaluno"], $_GET["iddoc"])){
	$aluno = anti_injection($_GET["idaluno"]);
	$doc = anti_injection($_GET["iddoc"]);
	include("../script/conecta_ftp.php");
	if((!$ftp_conecta) || (!$ftp_login)){
		echo "<script>alert('Não foi possível fazer a deleção do arquivo.'); history.go(-1); </script>";
	}else{
		$del  = "doc/".$doc;
		//echo $aluno;
		$deleta = ftp_delete($ftp_conecta,$del);
		ftp_close($ftp_conecta);
		$cadimg = erase("DELETE FROM aluno_doc WHERE aluno='$aluno' and doc='$doc' ");
		echo "<script>alert('Arquivo deletado com sucesso.'); location.href='aluno_perfil.php?id=$aluno';</script>";
	}
}else{
	echo "<script>alert('Não foi possível fazer a deleção do arquivo.'); history.go(-1); </script>";
}
?>