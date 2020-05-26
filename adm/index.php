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
	<h4>Meus Favoritos</h4>
    
    <?php
    /*
  $code_number = "../foto/qrc/52ed8e2e007a1.png";
 include('../script/phpqrcode/qrlib.php');
    $codeContents = '52ed8e2e007a1';
QRcode::png($codeContents, $code_number, QR_ECLEVEL_L , 5);

echo "<img src='$code_number' /> 52ed8e2e007a1"; */

$pesq = read("SELECT f.nome, f.id, u.id_fav, f.endereco FROM s_favorito as f INNER JOIN s_usuario_favorito as u ON u.id_fav=f.id and u.id_user='$login' ORDER BY f.nome");
if(read_num_line($pesq)>0){
	while($ver=read_list($pesq)){
		echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$ver["endereco"]."'>".htmlentities($ver["nome"],0,"iso-8859-1")."</a></p>";
	}
}else{
	echo "<h3>Não há favoritos cadastrados.</h3>";
}
 ?>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
