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
	<h4>Turma - Visualizar</h4>
    <center>
   <form action="turma_view.php" method="get" name="ano">
   <strong>Ano: </strong><input type="text" name="ano" size="5" /><input type="submit" name="proc" value="Procurar"/>
   </form>
   </center>
<?php
if(isset($_GET["ano"])){
	$ano = anti_injection($_GET["ano"]);
	if($ano=="" or !is_numeric($ano) or $ano<0){
		$ano = date("Y");
	}
}else{
	$ano = date("Y");
}
if(isset($_GET["del"])){
	$del = anti_injection($_GET["del"]);
	if($del!=""){
		$ver = read("Select turma from turma_aluno WHERE turma='$del' LIMIT 1");
		if(read_num_line($ver)==0){
			$delete = ersa("DELETE FROM turma WHERE id='$del'");
		}else{
			echo "<script>alert('Há alunos cadastrado na turma, delete os alunos para poder fazer a exclusão da turma.'); history.go(-1);</script>";
		}
	}else{
		echo "<script>alert('Informe uma turma para fazer a deleção.'); history.go(-1);</script>";
	}
}
$query = read("Select t.*, s.cadastro from turma as t, s_conf as s where t.ano='$ano' and s.tipo='e' and t.tipo_ensino=s.id order by tipo_ensino, serie, ano");
?>
<table cellpadding="5" cellspacing="0" border="1" bordercolor="#000000" align="center" width="90%">
	<tr>
    	<td align="center"><strong>Turma</strong></td>
        <td align="center"><strong>Ensino</strong></td>
        <td align="center"><strong>Opções</strong></td>
    </tr>
    <?php
	if(read_num_line($query)<=0){
		echo "<tr><td colspan='3' align='center'><strong><font color='RED'>Não turmas registradas no ano letivo de $ano.</font></strong></td></tr>";
	}else{
		while($resp=read_list($query)){
			$matricula = "<a href='turma_matricula.php?turma=".$resp["id"]."'><img src='img/matricula.png' border='0' width='80px'></a>";
			$carometro = "<a href='turma_carometro.php?turma=".$resp["id"]."'><img src='img/group.png' border='0' width='25px' alt='Carometro' title='Carometro'></a>";
			$print = "<a href='turma_print.php?turma=".$resp["id"]."' target='_blank'><img src='img/print.png' border='0' width='25px' alt='Imprimir' title='Imprimir turma'></a>";
			$xls = "<a href='turma_excel.php?turma=".$resp["id"]."' target='_blank'><img src='img/icon_xls.png' border='0' width='25px' alt='Gerar Excel' title='Gerar Excel'></a>";
			$editar = "<a href='turma_editar.php?turma=".$resp["id"]."'><img src='img/edit.png' border='0' width='25px' alt='Editar turma' title='Editar turma'></a>";
			$deletar = "<a href='turma_view.php?del=".$resp["id"]."&ano=$ano'><img src='img/delete.png' border='0' width='30px' alt='Deletar turma' title='Deletar turma'></a>";
			$doc = "<a href='turma_doc_view.php?turma=".$resp["id"]."&ano=$ano'><img src='img/doc_folder.png' border='0' width='30px' alt='Documentos Pendentes' title='Documentos Pendentes'></a>";
			echo "<tr><td align='center'>".$resp["serie"]." - ".$resp["turma"]."
			</td><td align='center'>".htmlentities($resp["cadastro"],0,"iso-8859-1")."</td>
			<td align='center'>
			$doc
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$print
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$xls
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$carometro
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$matricula
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$editar
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$deletar
			</td></tr>";
		}
	}
	?>
</table>
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
