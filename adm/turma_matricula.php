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
	<h4><a href="turma_view.php">Turma</a> - Matrícula</h4>
<?php
if(isset($_GET["turma"])){
	$turma = anti_injection($_GET["turma"]);
	if($turma!=""){
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma, t.prodesp FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		
		if(read_num_line($c)!=0){
			$vt = read_list($c);
			include("../script/mascara.php");
			echo "<hr><h5 style='color: #000' align='center'>".$vt["serie"]."ª ".$vt["turma"]." - Ensino ".htmlentities($vt["tensino"],0,"iso-8859-1")."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Período: <font color='#".$vt["cor"]."'>".htmlentities($vt["tperiodo"],0,"iso-8859-1")."</font><br>Código Prodesp: ".mask_ra($vt["prodesp"],'###.###.###.###')."</h5>";
			?>
            <center>
			<form action="turma_matricula_sis.php" method="post" name="cad">
            <input type="hidden" name="id" value="<?php echo $turma?>" />
            <strong>Número: </strong><input type="text" name="num" size="3"/>
            <strong>RA: </strong><input type="text" name="ra" size="20"/> - 
            <input type="text" name="dig" size="3"/><br />
            <strong>Matrícula em: </strong>
			<input type="text" name="dia" size="3"/> / 
            <input type="text" name="mes" size="3"/> / 
            <input type="text" name="ano" size="6"/> <font color="#990000">dd/mm/aaaa</font>
            <br /><input type="submit" name="matricula" value="Matrícular" class="botao"/>
            </form>
            </center>
			<?php
		
		if(isset($_GET["daluno"])){
			if($_GET["daluno"]!=""){
				$num = $_GET["num"];
				$daluno = $_GET["daluno"];
				$delete_aluno = erase("DELETE FROM turma_aluno WHERE num='$num' and turma='$turma' and aluno='$daluno'");
			}
		}
		$c = read("SELECT s.cadastro, s.cor, t.num, a.id, a.nome, a.ra, a.dg, t.situacao, t.datafim, t.id as tid FROM aluno as a, turma_aluno as t, s_conf as s WHERE t.turma='$turma' and t.aluno=a.id and s.id=t.situacao order by t.num");
		echo "<table width='100%' cellpadding='5' cellspacing='0' border='1' bordercolor='#000000'><tr>
		<td align='center'><strong>Nº</strong></td>
		<td align='center' width='450px'><strong>Aluno</strong></td>
		<td align='center' width='120px'><strong>RA</strong></td>
		<td align='center'><strong>Situação</strong></td>
		<td align='center'><strong>Data Fim</strong></td>
		<td align='center'><strong>Excluir</strong></td>
		</tr>";
		while($v = read_list($c)){
			$excluir = "<a href='turma_matricula.php?turma=$turma&daluno=".$v["id"]."&num=".$v["num"]."' onclick=\"return confirm('Deseja realmente deletar o aluno ".htmlentities($v["nome"],0,"iso-8859-1")."')\"><img src='img/delete.png' width='20px'></a>";
			echo "<tr><td>".$v["num"]."</td>
			<td>".htmlentities($v["nome"],0,"iso-8859-1")."</td>
			<td>".mask_ra($v["ra"], "###.###.###.###")."-".$v["dg"]."</td>
			<td><b><a href='turma_matricula_mov.php?turma=$turma&tid=".$v["tid"]."'><font color='#".$v["cor"]."'>".htmlentities($v["cadastro"],0,"iso-8859-1")."</font></a></b></td>
			<td>".str_replace("-","/",date("d-m-Y", strtotime($v["datafim"])))."</td>
			<td align='center'>".$excluir."</td>
			</tr>
			";
		}
		echo "</table>";
		}else{
			echo "<script>alert('Turma não localizada.'); history.go(-1);</script>";
		}
	}else{
		echo "<script>alert('Turma não pode ser vázio.'); history.go(-1);</script>";
	}
}
?>


</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
