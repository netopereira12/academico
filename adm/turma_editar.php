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
	<h4><a href="turma_view.php">Turma</a> - Editar</h4>
    
<?php
if(isset($_GET["turma"])){
	$turma = anti_injection($_GET["turma"]);
	if($turma!=""){
		if(isset($_GET["editar"])){
			$serie = anti_injection($_GET["serie"]);
			$turma2 = anti_injection($_GET["turma2"]);
			$periodo = anti_injection($_GET["periodo"]);
			$ensino = anti_injection($_GET["ensino"]);
			$prodesp = anti_injection($_GET["prodesp"]);
			$ano = anti_injection($_GET["ano"]);
			if($serie!="" and $turma2!="" and $periodo!="" and $ensino!="" and $prodesp!="" and $ano!=""){
				$altera = write("UPDATE turma SET serie='$serie', turma='$turma2', periodo='$periodo', tipo_ensino='$ensino', prodesp='$prodesp', ano='$ano' WHERE id='$turma'");
				echo "<script>location.href='turma_view.php';</script>";
			}else{
				echo "<script>alert('Informe todos os campos.'); history.go(-1);</script>";
			}
		}
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma, t.prodesp, t.id, t.ano FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		$resp = read_list($c);
		?>
        <form action="turma_editar.php" name="feditar" method="get">
        <input type="hidden" name="editar" value="1" />
        <input type="hidden" name="turma" value="<?php echo $turma ?>" />
		<table cellpadding="5" cellspacing="0" border="0">
        <tr><td><strong>Série: </strong></td>
        <td><input type="text" name="serie" value="<?php echo $resp["serie"]?>" /></td></tr>
         <tr><td><strong>Turma: </strong></td>
        <td><input type="text" name="turma2" value="<?php echo $resp["turma"]?>" /></td></tr>
         <tr><td><strong>Periodo: </strong></td>
        <td><select name="periodo">
        <?php
		$resp1=read("Select cadastro, id FROM s_conf WHERE tipo='p' ORDER BY cadastro");
		$op="";
		while($vresp=read_list($resp1)){
			if($resp["tperiodo"]==$vresp["cadastro"]){
				$op="selected";
			}else{
				$op="";
			}
			echo "<option value='".$vresp["id"]."' $op>".htmlentities($vresp["cadastro"],0,"iso-8859-1")."</option>";
		}
		?>
        </select>
        </td></tr>
         <tr><td><strong>Ensino: </strong></td>
        <td>
        <select name="ensino">
        <?php
		$resp1=read("Select cadastro, id FROM s_conf WHERE tipo='e' ORDER BY cadastro");
		$op="";
		while($vresp=read_list($resp1)){
			if($resp["tensino"]==$vresp["cadastro"]){
				$op="selected";
			}else{
				$op="";
			}
			echo "<option value='".$vresp["id"]."' $op>".htmlentities($vresp["cadastro"],0,"iso-8859-1")."</option>";
		}
		?>
        </select>
        </td></tr>
         <tr><td><strong>PRODESP: </strong></td>
        <td><input type="text" name="prodesp" value="<?php echo $resp["prodesp"]?>" /></td></tr>
        <tr><td><strong>Ano: </strong></td>
        <td><input type="text" name="ano" value="<?php echo $resp["ano"]?>" /></td></tr>
		<tr><td colspan="2" align="center">
        <input type="submit" name="salvar" value="Salvar" class="botao" />
        <input type="button" name="cancel" value="Cancelar" onclick="history.go(-1);" class="botao"/>
        </td></tr>
        </table>
        </form>
		<?php
	}else{
		echo "<script>alert('Informe uma turma para editar.'); history.go(-1);</script>";
	}
}else{
	echo "<script>alert('Informe uma turma para editar.'); history.go(-1);</script>";
}
?>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
