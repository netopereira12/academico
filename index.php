<?php
if(isset($_GET["install"])){
	$path = "INSTALL/";
	$patha = explode("/",$path);
	$path2=$patha[0];
	$diretorio = dir($path);
    //echo "<table align='center'><tr><td>";
    //echo "Lista de arquivos do diret&oacute;rio '<strong>".$path."</strong>':<br />";    
	while($arquivo = $diretorio -> read()){
		if($arquivo=="." or $arquivo==".." or $arquivo==""){
			
		}else{
			unlink($path.$arquivo);
    		//echo ">> ".$arquivo." &nbsp;&nbsp;&nbsp; deletado .... OK<br />";
		}
	}
	//echo "<hr>Limpeza conclu&iacute;da.</td></tr></table>";
	$diretorio -> close();
	echo "<script>location.href='index.php';</script>";
}else{
	if(file_exists("INSTALL/install_valid.php")){
		echo "<script>location.href='INSTALL/install.php';</script>";
	}else{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include("title.php"); ?></title>
</head>

<body onload="acesso.login.focus()">
<div class="capa">

<table cellpadding="0" cellspacing="0" border="0">
<tr><td align="center">
<h3>
<img src="img/logo.png" alt="SCGA" width="300px"/><br />
Sistema de Controle e Gestão Acadêmica
</h3>
</td></tr>
<tr><td align="center">
<form action="login.php" method="post" name="acesso">
<strong>Login: </strong><input type="text" name="login" size="30" /><br />
<strong>Senha: </strong><input type="password" name="senha" size="30" /><br />
<input type="submit" name="send" value="Entrar" class="botao"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="esqueci" value="Esqueci minha senha" class="botao" onclick="alert('Entre em contato com o administrador de sua Unidade de Ensino.');" />
</form>
</td></tr>
<tr>
  <td align="center"><br />
<br />
<br />
<br />
<?php include("rodape.php"); ?></td>
</tr>
</table>

</div>
</body>
</html>
<?php }
}?>