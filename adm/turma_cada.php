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
	<h4>Turma - Cadastrar</h4>
    <?php
if(isset($_GET["salvar"])){
	$ano = anti_injection($_GET["ano"]);
	$serie = anti_injection($_GET["serie"]);
	$turma = anti_injection($_GET["turma"]);
	$periodo = anti_injection($_GET["periodo"]);
	$ensino = anti_injection($_GET["ensino"]);
	$prodesp = anti_injection($_GET["prodesp"]);
	if($ano!="" and $ano>0 and is_numeric($ano) and $serie!="" and $serie>0 and is_numeric($serie) and $turma!="" and $periodo!="" and $periodo>0 and is_numeric($periodo) and $ensino!="" and $ensino>0 and is_numeric($ensino) and $prodesp!="" and $prodesp>0 and is_numeric($prodesp)){
		$query = read("Select * from turma where serie='$serie' and turma='$turma' and tipo_ensino='$ensino' and ano='$ano'");
		if(read_num_line($query)>0){
			echo "<script>alert('Turma já cadastrada, informe outra.');</script>";
		}else{
			$id = uniqid();
			$turma = utf8_decode(mb_strtoupper($turma, 'UTF-8'));;
		$query = write("INSERT INTO turma (id, serie, turma, periodo, tipo_ensino, prodesp, ano) VALUES ('$id', '$serie','$turma','$periodo','$ensino','$prodesp','$ano')");
		echo "<script>alert('Turma cadastrada com sucesso, sobre o ID $id.');</script>";
		}
	}else{
		echo "<script>alert('Os campos não pode ser vazios.');</script>";
	}
}


$q = write("Select * from s_ano where status='1'");
$qe=write("Select * from s_conf where tipo='e' order by cadastro");
$qp=write("Select * from s_conf where tipo='p' order by cadastro");
$resp = read_list($q);
if(read_num_line($q)<=0 or read_num_line($qp)<=0 or read_num_line($qe)<=0){
?>
<p align="center"><strong style="color:#F00;">AVISO</strong>
</p>
Verifique as configurações do sistema, dados insuficientes.<br /><br />
<?php
	if(read_num_line($q)<=0){
		echo "<strong>Ano Letivo não aberto ou inexistente.</strong><br /><br>";
	}
	if(read_num_line($qe)<=0){
		echo "<strong>Tipo de Ensino não cadastrado.</strong><br /><br>";
	}
	if(read_num_line($qp)<=0){
		echo "<strong>Período não cadastrado.</strong>";
	}

}else{
	?>
    <table cellpadding="5" cellspacing="0" border="0" bordercolor="#000000" align="center">
    <form action="turma_cada.php" method="get" name="cad">
     <tr><td><strong>Ano: </strong></td>
    <td><input type="text" name="ano" size="20" value="<?php echo $resp["ano"]?>" readonly="readonly"/></td></tr>
    <tr><td><strong>Série: </strong></td>
    <td><input type="text" name="serie" size="20" /></td></tr>
     <tr><td><strong>Turma: </strong></td>
    <td><input type="text" name="turma" size="20" /></td></tr>
     <tr><td><strong>Período: </strong></td>
    <td><select name="periodo">
    <?php
	while($resp=read_list($qp)){
		echo "<option value='".$resp["id"]."'>".htmlentities($resp["cadastro"],0,"iso-8859-1")."</option>";
	}
    ?>
    </select></td></tr>
     <tr><td><strong>Ensino: </strong></td>
    <td><select name="ensino">
    <?php
	while($resp=read_list($qe)){
		echo "<option value='".$resp["id"]."'>".htmlentities($resp["cadastro"],0,"iso-8859-1")."</option>";
	}
    ?>
    </select></td></tr>
     <tr><td><strong>Prodesp: </strong></td>
    <td><input type="text" name="prodesp" size="20" /></td></tr>
    <tr><td colspan="2">
    <input type="submit" name="salvar" value="Salvar" class="botao" />
    </td></tr>
    </form>
    </table>
   <?php
}
    ?>
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
