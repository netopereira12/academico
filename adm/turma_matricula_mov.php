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
	<h4>Turma - Matrícula - Movimentação</h4>
    
    <?php
if(isset($_GET["tid"])){
	$turma = anti_injection($_GET["turma"]);
	$tid = anti_injection($_GET["tid"]);
	if($tid!="" and $turma!=""){
		if(isset($_GET["situacao"])){
			$situacao = anti_injection($_GET["situacao"]);
			if($situacao!="" and is_numeric($situacao)){
				if($situacao==0){
					$data = date('Y')."-12-31";
				}else{
					$data = date('Y')."-".date('m')."-".date('d');
				}
				$altera = write("UPDATE turma_aluno SET situacao='$situacao', datafim='$data' WHERE id='$tid'");
				echo "<script>alert('Alterado com sucesso.'); location.href='turma_matricula.php?turma=$turma';</script>";
				echo "";
			}else{
				echo "<script>alert('ERRO FATAL.'); history.go(-1);</script>";
			}
		}
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma, t.prodesp FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		
		if(mysql_num_rows($c)!=0){
			$vt = mysql_fetch_assoc($c);
			include("../script/mascara.php");
			echo "<h5 align='center' style='font-weight:normal'><font color='#".htmlentities($vt["cor"])."'>".htmlentities($vt["tensino"])."<br>".htmlentities($vt["serie"])."ª ".htmlentities($vt["turma"])." - ".htmlentities($vt["tperiodo"])."</font> &nbsp;&nbsp;&nbsp;&nbsp;".mask_ra($vt["prodesp"],'###.###.###.###')."</h5>";
			$c = read("SELECT s.cadastro, s.cor, t.num, a.id, a.nome, a.ra, a.dg, t.situacao, t.datafim, t.id as tid FROM aluno as a, turma_aluno as t, s_conf as s WHERE t.turma='$turma' and t.aluno=a.id and s.id=t.situacao and t.id='$tid' order by t.num");
			$resp = read_list($c);
			echo "<center><form method='get' name='alterar' action='turma_matricula_mov.php'>
			<input type='hidden' name='turma' value='".$turma."'>
			<input type='hidden' name='tid' value='".$tid."'>
			<table cellpadding='5' cellspacing='0' border='0'>
			<tr><td><strong>Aluno: </strong></td><td>".htmlentities($resp["nome"])."</td><td><strong>Nº: </strong></td><td>".$resp["num"]."</td></tr>
			<tr><td colspan='5' align='center'>
			<strong>Situação: </strong><select name='situacao'>";
			$cs = read("Select id, cadastro FROM s_conf WHERE tipo='r' ORDER BY cadastro");
			while($vs=read_list($cs)){
				echo "<option value='".$vs["id"]."'>".htmlentities($vs["cadastro"])."</option>";
			}
			echo "</select></td></tr>
			<tr><td colspan='5' align='center'><input type='button' value='Cancelar' class='botao' onclick=\"history.go(-1);\">
			<input type='submit' value='Alterar' class='botao'>
			</td></tr>
			</table></form></center>";
			
		}
	}else{
		echo "<script>alert('Informe uma turma e aluno válidos.'); history.go(-1);</script>";
	}
}
 ?>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
