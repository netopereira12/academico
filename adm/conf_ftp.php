<?php 
include("valida_login.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
<link href="../estilo/estilo_adm.css" rel="stylesheet" type="text/css" /> 
<title><?php include("titulo.php");?></title>
</head>

<body>
<div class="topo">
	<?php include("topo.php"); ?>
</div>

<div class="menu">
	<?php include("menu.php"); ?>
</div>
<div class="texto">
	<h4>Configuração - FTP</h4>
<?php
if($v["tipo"]!=1){
	echo "<h3>Ferramenta disponível apenas para usuário Administrador.</h3>";
}else{
if(isset($_POST["salvar"])){
	$ftp_server = utf8_decode(anti_injection($_POST["servidor_ftp"]));
	$ftp_user = utf8_decode(anti_injection($_POST["usuario_ftp"]));
	$ftp_pass = utf8_decode(anti_injection($_POST["senha_ftp"]));
	$aluno = utf8_decode(anti_injection($_POST["aluno"]));
	$doc = utf8_decode(anti_injection($_POST["documento"]));
	$qrcode = utf8_decode(anti_injection($_POST["qrcode"]));
	$logotipo = utf8_decode(anti_injection($_POST["logotipo"]));
	if($ftp_user!="" and $ftp_pass!="" and $aluno!="" and $doc!="" and $qrcode!="" and $logotipo!="" and $ftp_server!=""){
		$ftp_server = codic($ftp_server);
		$ftp_user = codic($ftp_user);
		$ftp_pass = codic($ftp_pass);
		$aluno = codic($aluno);
		$doc = codic($doc);
		$qrcode = codic($qrcode);
		$logotipo = codic($logotipo);
		$q = write("UPDATE s_ftp SET ftp_server='$ftp_server', ftp_user = '$ftp_user', ftp_pass='$ftp_pass', ftp_aluno='$aluno', ftp_doc='$doc', ftp_qrcode='$qrcode', ftp_logo='$logotipo' WHERE id='1' ");
	}else{
		echo "<script>alert('Informe um usuario, senha e caminho dos arquivos. Nenhum campo pode ficar em branco.');</script>";
	}
}
$q = read("Select * from s_ftp WHERE id='1' ");
$resp = read_list($q);
?>
<form action="conf_ftp.php" name="ftp_config" method="post">
	<table cellpadding="5" cellspacing="0" border="0" bordercolor="#000000" width="auto" align="center">
    <tr>
    	<td><strong>Servidor: </strong></td><td><input type="text" name="servidor_ftp" value="<?php echo htmlentities(decodic($resp["ftp_server"]))?>" size=" 30px"/></td>
    </tr>
    <tr>
    	<td><strong>Usuário: </strong></td><td><input type="text" name="usuario_ftp" value="<?php echo htmlentities(decodic($resp["ftp_user"]))?>" size=" 30px"/></td>
    </tr>
    <tr>
      <td><strong>Senha:</strong></td>
      <td><input name="senha_ftp" type="text" id="senha_ftp" value="<?php echo htmlentities(decodic($resp["ftp_pass"]))?>" size=" 30px"/></td>
    </tr>
    <tr>
      <td><strong>Aluno:</strong></td>
      <td><input name="aluno" type="text" id="aluno" value="<?php echo (decodic($resp["ftp_aluno"]))?>" size=" 30px"/></td>
    </tr>
    <tr>
      <td><strong>Documentos:</strong></td>
      <td><input name="documento" type="text" id="documento" value="<?php echo (decodic($resp["ftp_doc"]))?>" size=" 30px"/></td>
    </tr>
    <tr>
      <td><strong>QR Code:</strong></td>
      <td><input name="qrcode" type="text" id="qrcode" value="<?php echo (decodic($resp["ftp_qrcode"]))?>" size=" 30px"/></td>
    </tr>
    <tr>
      <td><strong>Logotipo:</strong></td>
      <td><input name="logotipo" type="text" id="logotipo" value="<?php echo (decodic($resp["ftp_logo"]))?>" size=" 30px"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="salvar" id="salvar" value="Salvar" class="botao"/></td>
      </tr>
    </table>
</form>
<?php } ?>
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
