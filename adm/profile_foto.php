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
	<h4>Perfil - Trocar foto</h4>
    <form method="post" action="upload_foto.php" name="upload" enctype="multipart/form-data">
    <input type="file" name="arquivo" />
    <input type="hidden" name="tipo" value="3" />
    <input type="hidden" name="idaluno" value="<?php echo codic($login) ?>" />
    <br />
    <input type="button" name="cancel" value="Cancelar" onclick="document.getElementById('upload').style.display='none'" class="botao"/>
    <input type="submit" name="enviar" value="Enviar" class="botao"/>
    </form>
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
