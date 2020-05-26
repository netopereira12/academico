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
	<h4>Favoritos</h4>
    
    <?php
if(isset($_GET["id"])){
	$idfav = anti_injection($_GET["id"]);
	if($idfav!=""){
		$cad = write("INSERT INTO s_usuario_favorito (id_user, id_fav) VALUES ('$login','$idfav')");
		echo "<script>location.href='favorito.php'</script>";
	}
}
if(isset($_GET["delid"])){
	$idfav = anti_injection($_GET["delid"]);
	if($idfav!=""){
		$cad = erase("DELETE FROM s_usuario_favorito WHERE id_user='$login' and id_fav='$idfav'");
		echo "<script>location.href='favorito.php'</script>";
	}
}


$pesq="SELECT f.nome, f.id, u.id_fav FROM s_favorito as f LEFT JOIN s_usuario_favorito as u ON u.id_fav=f.id and u.id_user='$login' ORDER BY f.nome";
$q = read($pesq);
echo "<table cellpadding='2' cellspacing='0' border='0' align='center'>";
while($resp = read_list($q)){
	if($resp["id_fav"]==NULL){
		$op="<a href='favorito.php?id=".$resp["id"]."'><img src='img/icon_correct.png' width='30px' border='0'></a>";
	}else{
		$op="<a href='favorito.php?delid=".$resp["id"]."'><img src='img/icon_cancel.png' width='30px' border='0'></a>";
	}
	echo "<tr><td>".htmlentities($resp["nome"],0,"iso-8859-1")."</td><td>$op</td></tr>";
}
echo "</table>";
 ?>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
