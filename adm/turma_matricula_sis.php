<?php 
include("valida_login.php");
if(isset($_POST["matricula"])){
	$num = anti_injection($_POST["num"]);
	$ra = anti_injection($_POST["ra"]);
	$dig = anti_injection($_POST["dig"]);
	$dia = anti_injection($_POST["dia"]);
	$mes = anti_injection($_POST["mes"]);
	$ano = anti_injection($_POST["ano"]);
	$turma = anti_injection($_POST["id"]);
	if(is_numeric($num) and $num!="" and is_numeric($ra) and $ra!="" and $dig!="" and is_numeric($dia) and $dia!="" and is_numeric($mes) and $mes!="" and is_numeric($ano) and $ano!="" and $turma!=""){
		$v1 = read("SELECT id, ano FROM turma WHERE id='$turma'");
		$v2 = read("SELECT id FROM aluno WHERE ra='$ra' and dg='$dig'");
		if(read_num_line($v1)>0 and read_num_line($v2)>0){
			$r1 = read_list($v1);
			$r2 = read_list($v2);
			$tid = $r1["id"];
			$tano = $r1["ano"];
			$aid = $r2["id"];
			$id = uniqid();
			$data = $ano."-".$mes."-".$dia;
			$datafim = $ano."-12-31";
			$cad = write("INSERT INTO turma_aluno VALUES ('$id', '$tid', '$num','$aid', '$data', '12', '$datafim')");
			echo "<script>alert('Aluno matriculado com sucesso.');location.href='turma_matricula.php?turma=$tid';</script>";
		}else{
			echo "<script>alert('Turma ou aluno não localizados.');</script>";
		}
	}else{
		echo "<script>alert('Erro, os campos Número, RA, Dígito, Dia, Mês e Ano não podem ser vazios e deve ser numéricos, exceto o Dígito.');</script>";
	}
}
?>
