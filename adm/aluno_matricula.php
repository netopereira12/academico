<?php
include("valida_login.php");
if (isset($_GET["id"])) {
	$id = anti_injection($_GET["id"]);
	if($id!=""){
		$qd = read("SELECT s.cadastro, s.cor, t.num, t.situacao, t.datafim, tu.serie, tu.turma, tu.ano FROM aluno as a, turma_aluno as t, s_conf as s, turma as tu WHERE t.turma=tu.id and t.aluno=a.id and s.id=t.situacao and a.id='$id' order by tu.ano");
		sleep(1);
		$return = "<h4>Matrículas</h4>";
		while($respd = read_list($qd)){
			$return.= $respd["ano"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			".$respd["serie"]."ª ".$respd["turma"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			nº".$respd["num"]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<font color='#".$respd["cor"]."'><b>".$respd["cadastro"]."</b></font><hr>";
		}
		$return.= "<hr>";
		
		echo $return;
	}else{
		echo "<h4>Não há registro de turma</h4>";
	}
}else{
	echo "<h4>Não há registro de turmas</h4>";
}
?>