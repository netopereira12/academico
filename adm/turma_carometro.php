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
	<h4><a href="turma_view.php">Turma</a> - Carometro</h4>
<?php
if(isset($_GET["turma"])){
	$turma = anti_injection($_GET["turma"]);
	if($turma!=""){
		?>
		<img src="img/print.png" onclick="window.open('turma_carometro_print.php?turma=<?php echo $turma?>');" style="cursor:pointer;"/>
		<?php
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma, t.prodesp FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		
		if(read_num_line($c)!=0){
			$vt = read_list($c);
			include("../script/mascara.php");
			echo "<hr><h5 style='color: #000' align='center'>".$vt["serie"]."ª ".$vt["turma"]." - Ensino ".htmlentities($vt["tensino"],0,"iso-8859-1")."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Período: <font color='#".$vt["cor"]."'>".htmlentities($vt["tperiodo"],0,"iso-8859-1")."</font><br>Código Prodesp: ".mask_ra($vt["prodesp"],'###.###.###.###')."</h5>";

		$sqlq = "Select t.num, a.nome, f.foto from aluno as a
		INNER JOIN turma_aluno as t ON a.id=t.aluno 
		LEFT JOIN aluno_foto as f ON f.aluno=a.id 
		WHERE t.turma='$turma' order by t.num";
		$c = read($sqlq);
		$a=1;
		echo "<table width='100%' cellpadding='5' cellspacing='0' border='1' bordercolor='#000000'><tr>";
		while($v = read_list($c)){
			if($v["foto"]==NULL){
				$img = "default.png";
			}else{
				$img = $v["foto"];
			}
				echo "<td align='center'><img src='../foto/alu/$img' width='50px'><br><small>".$v["num"]." - ".htmlentities($v["nome"],0,"iso-8859-1")."</small></td>";
			$a++;
			if($a==8){
				echo "</tr><tr>";
				$a=1;
			}
		}
		echo "</tr></table>";
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
