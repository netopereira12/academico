<?php 
include("valida_login.php");
if(isset($_GET["turma"])){
	$turma = anti_injection($_GET["turma"]);
	if($turma!=""){
		$cue = read("Select nome, logo FROM s_ue WHERE id='1'");
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma, t.prodesp FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		
		if(read_num_line($c)!=0){
			$vt = read_line($c);
			$vue = read_line($cue);
			include("../script/mascara.php");
			$html='<table cellpadding="10" cellspacing="0" border="0" width="100%"><tr><td><img src="../foto/log/'.$vue["logo"].'" width="40px"></td><td align="center"><h2>'.htmlentities($vue["nome"],0,"iso-8859-1").'</h2></td></tr></table><hr><h5 style="color: #000" align="center">'.$vt["serie"].'ª '.$vt["turma"].' - Ensino '.htmlentities($vt["tensino"],0,"iso-8859-1").'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Período: <font color="#'.$vt["cor"].'">'.htmlentities($vt["tperiodo"],0,"iso-8859-1").'</font><br>Código Prodesp: '.mask_ra($vt["prodesp"],'###.###.###.###').'</h5>';

		$sqlq = "Select t.num, a.nome, f.foto from aluno as a
		INNER JOIN turma_aluno as t ON a.id=t.aluno 
		LEFT JOIN aluno_foto as f ON f.aluno=a.id 
		WHERE t.turma='$turma'";
		$c = read($sqlq);
		$a=1;
		$html.= '<table width="100%" cellpadding="5" cellspacing="0" border="1" bordercolor="#000000"><tr>';
		while($v = read_list($c)){
			if($v["foto"]==NULL){
				$img = "default.png";
			}else{
				$img = $v["foto"];
			}
				$html.= '<td align="center"><img src="../foto/alu/'.$img.'" width="50px"><br><small>'.$v["num"].' - '.htmlentities($v["nome"],0,"iso-8859-1").'</small></td>';
			$a++;
			if($a==8){
				$html.= '</tr><tr>';
				$a=1;
			}
		}
		$html.= '</tr></table>';
		echo $html;
		echo '<br><script>window.print();</script>';
		}else{
			
			$html= "Turma não localizada";
		}
		

		
	}
}
?>
