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
	<h4>Configuração - Unidade de Ensino</h4>
<?php
if(isset($_POST["salvar"])){
	$cue = utf8_decode(anti_injection($_POST["ue"]));
	$crua = utf8_decode(anti_injection($_POST["rua"]));
	$cnum = utf8_decode(anti_injection($_POST["num"]));
	$cbairro = utf8_decode(anti_injection($_POST["bairro"]));
	$ccidade = utf8_decode(anti_injection($_POST["cidade"]));
	$cuf = utf8_decode(anti_injection($_POST["uf"]));
	$ccep = utf8_decode(anti_injection($_POST["cep"]));
	$ctel = utf8_decode(anti_injection($_POST["telefone"]));
	$cemail = utf8_decode(anti_injection($_POST["email"]));
	$csite = utf8_decode(anti_injection($_POST["site"]));
	if($cue!="" and $crua!="" and $cnum!="" and $cbairro!="" and $ccidade!="" and $cuf!="" and $ctel!="" and is_numeric($ctel) and $cemail!="" and filter_var($cemail, FILTER_VALIDATE_EMAIL)!=FALSE){
		if($csite!=""){
			if(filter_var($csite, FILTER_VALIDATE_URL) == FALSE){
				echo "<script>alert('Site inválido. Informe outro ou deixe em branco se não possuir site.');</script>";		
				$csite="";
			}
		}
		if(isset($_POST["novo"])){
			$q = write("INSERT INTO s_ue (nome, rua, num, bairro, cidade, uf, cep, logo, tel, email, site) VALUES ('$cue', '$crua', '$cnum', '$cbairro', '$ccidade', '$cuf', '$ccep', 'default.png', '$ctel','$cemail', '$csite')");
		}else{
			$q = write("UPDATE s_ue  SET nome='$cue', rua='$crua', num='$cnum', bairro='$cbairro', cidade='$ccidade', uf='$cuf', cep='$ccep', tel='$ctel', email='$cemail', site='$csite' WHERE id='1'");
		}
		echo "<script>alert('Unidade de Ensino gravada com sucesso.'); location.href='conf_ue.php'; </script>";
	}
	
}
$q = read("Select * from s_ue WHERE id='1' ");
if(read_num_line($q)<1){
	$ue = $rua = $num = $bairro = $cidade = $uf = $cep = $tel = $email = $site = $op = $logo = "";
	$op = "<input type='hidden' name='novo' value='1'>";
}else{
	$resp = read_list($q);
	$ue = $resp["nome"];
	$rua = $resp["rua"];
	$num = $resp["num"];
	$bairro = $resp["bairro"];
	$cidade = $resp["cidade"];
	$uf = $resp["uf"];
	$cep = $resp["cep"];
	$tel = $resp["tel"];
	$email = $resp["email"];
	$site = $resp["site"];
	$logo = $resp["logo"];
	$op = "";
}
?>
<div class="caixa" id="upload">
<div class="bloco">
	<h4>Alterar Logotipo</h4>
    <form method="post" action="upload_foto.php" name="upload" enctype="multipart/form-data">
    <input type="file" name="arquivo" />
    <input type="hidden" name="tipo" value="1" />
    <br />
    <input type="button" name="cancel" value="Cancelar" onclick="document.getElementById('upload').style.display='none'" class="botao"/>
    <input type="submit" name="enviar" value="Enviar" class="botao"/>
    </form>
</div></div>
<form action="conf_ue.php" name="confue" method="post">
<table cellpadding="5" cellspacing="0" border="0" width="auto" align="center">
<tr>
  <td rowspan="10" valign="top" align="center">
  <?php
if($ue==""){
	echo "Não existe unidade de ensino gravada no sistema.<br>Salva os dados da unidade de ensino.";
}else{
	?><img src='../foto/log/<?php echo $logo ?>' width="150px"><BR><a href='#' onclick="document.getElementById('upload').style.display='block';">Clique aqui para alterar o Logotipo.</a><?php
}
  ?></td>
	<td><strong>Escola: </strong></td><td><input name="ue" type="text" value="<?php echo htmlentities($ue,0,"iso-8859-1") ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>Rua:</strong></td>
  <td><input name="rua" type="text" id="rua" value="<?php echo htmlentities($rua,0,"iso-8859-1") ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>Nº</strong></td>
  <td><input name="num" type="text" id="num" value="<?php echo htmlentities($num) ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>Bairro:</strong></td>
  <td><input name="bairro" type="text" id="bairro" value="<?php echo htmlentities($bairro,0,"iso-8859-1") ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>Cidade:</strong></td>
  <td><input name="cidade" type="text" id="cidade" value="<?php echo htmlentities($cidade,0,"iso-8859-1") ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>UF:</strong></td>
  <td><input name="uf" type="text" id="uf" value="<?php echo htmlentities($uf) ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>CEP:</strong></td>
  <td><input name="cep" type="text" id="cep" value="<?php echo htmlentities($cep) ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>Telefone:</strong></td>
  <td><input name="telefone" type="text" id="telefone" value="<?php echo htmlentities($tel) ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>E-mail:</strong></td>
  <td><input name="email" type="text" id="email" value="<?php echo $email ?>" size="30" /></td>
</tr>
<tr>
  <td><strong>Site:</strong></td>
  <td><input name="site" type="text" id="site" value="<?php echo $site ?>" size="30" />
  <?php echo $op; ?>
  </td>
</tr>
<tr>
  <td colspan="3" align="center"><input type="submit" name="salvar" id="salvar" value="Salvar" class="botao"/></td>
  </tr>
</table>
</form>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
