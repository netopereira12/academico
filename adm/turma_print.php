<?php 
include("valida_login.php");
if(isset($_GET["turma"])){
	$turma = anti_injection($_GET["turma"]);
	if($turma!=""){
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma, t.prodesp FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		
		if(read_num_line($c)!=0){
			$vt = read_list($c);
			include("../script/mascara.php");
		$c = read("SELECT s.cadastro, s.cor, t.num, a.id, a.nome, a.ra, a.dg, t.situacao, t.datafim, t.id as tid FROM aluno as a, turma_aluno as t, s_conf as s WHERE t.turma='$turma' and t.aluno=a.id and s.id=t.situacao order by t.num");
		echo "
		<table width='700px' cellpadding='5' cellspacing='0' border='0' bordercolor='#000000'><tr><td>
		<h5 style='color: #000' align='center'>".$vt["serie"]."ª ".$vt["turma"]." - Ensino ".htmlentities($vt["tensino"],0,"iso-8859-1")."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Período: <font color='#".$vt["cor"]."'>".htmlentities($vt["tperiodo"],0,"iso-8859-1")."</font><br>Código Prodesp: ".mask_ra($vt["prodesp"],'###.###.###.###')."</h5>
		<table width='100%' cellpadding='5' cellspacing='0' border='1' bordercolor='#000000'><tr>
		<td align='center'><strong>Nº</strong></td>
		<td align='center' width='450px'><strong>Aluno</strong></td>
		<td align='center' width='120px'><strong>RA</strong></td>
		<td align='center'><strong>Situação</strong></td>
		<td align='center'><strong>Data Fim</strong></td>
		</tr>";
		while($v = read_list($c)){
			echo "<tr><td>".$v["num"]."</td>
			<td>".htmlentities($v["nome"],0,"iso-8859-1")."</td>
			<td><small>".mask_ra($v["ra"], "###.###.###.###")."-".$v["dg"]."</small></td>
			<td><b><a href='turma_matricula_mov.php?turma=$turma&tid=".$v["tid"]."'><font color='#".$v["cor"]."'>".htmlentities($v["cadastro"],0,"iso-8859-1")."</font></a></b></td>
			<td>".str_replace("-","/",date("d-m-Y", strtotime($v["datafim"])))."</td></tr>
			";
		}
		echo "</table></td></tr></table>";
		echo '<br><script>window.print();</script>';
		}else{
			echo "<script>alert('Turma não localizada.'); history.go(-1);</script>";
		}
	}else{
		echo "<script>alert('Turma não pode ser vázio.'); history.go(-1);</script>";
	}
}
?>
