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
<h4>Configura&ccedil;&atilde;o - Período e Tipo de Ensino</h4>
	<div class="caixa" id="registro">
    <div class="bloco">
    <h4>Adicionar Registro</h4>
    <form method="get" name="cor_cad">
    <table cellpadding="0" cellspacing="0" border="0">
    <tr><td><strong>Tipo de Registro: </strong></td>
    <td>
    <select name="tipo">
    	<option value="p">Período</option>
    	<option value="e">Tipo de Ensino</option>
        <option value="r">Resultado</option>
    </select></td></tr>
    <tr><td><strong>Cadastro: </strong></td>
    <td><input type="text" name="nome" /></td></tr>
    <tr><td><strong>Cor: </strong></td>
    <td><input class="color" value="000000" name="cor"></td></tr>
    <tr><td colspan="2">
    <input type="submit" value="Salvar" class="botao"/>
    <input type="button" value="Fechar"  class="botao" onclick="document.getElementById('registro').style.display='none'"/>
    </td></tr></table>
    </form>
    </div></div>
    <div class="caixa" id="editar">
    <div class="bloco">
    <h4>Editar Registro</h4>
    <form method="get" name="cor_cad">
    <table cellpadding="0" cellspacing="0" border="0">
    <tr><td><strong>Tipo de Registro: </strong></td>
    <td>
    <input type="hidden" name="edit" id="edit" value="0" />
    <select name="tipoe" id="tipoe">
    	<option value="p">Período</option>
    	<option value="e">Tipo de Ensino</option>
        <option value="r">Resultado</option>
    </select></td></tr>
    <tr><td><strong>Cadastro: </strong></td>
    <td><input type="text" name="nomee" id="nomee"/></td></tr>
    <tr><td><strong>Cor: </strong></td>
    <td><input class="color" value="000000" name="core" id="core"></td></tr>
    <tr><td colspan="2">
    <input type="submit" value="Salvar" class="botao"/>
    <input type="button" value="Fechar"  class="botao" onclick="document.getElementById('editar').style.display='none'"/>
    </td></tr></table>
    </form>
    </div></div>
    <?php
	//cadastar periodo e tipo de ensino
	if(isset($_GET["tipo"], $_GET["nome"], $_GET["cor"])){
		$tipo = anti_injection($_GET["tipo"]);
		$nome = utf8_decode(anti_injection($_GET["nome"]));
		$cor = anti_injection($_GET["cor"]);
		if($tipo=="" or $nome=="" or $cor==""){
			echo "<script>alert('Informe um Tipo de registro, Cadastro e cor.');</script>";
		}else{
			$grava = write("INSERT  INTO s_conf (cadastro, cor, tipo) VALUES ('$nome', '$cor', '$tipo')");
		}
	}
	//editar
	if(isset($_GET["tipoe"], $_GET["nomee"], $_GET["core"], $_GET["edit"])){
		$tipo = anti_injection($_GET["tipoe"]);
		$nome = utf8_decode(anti_injection($_GET["nomee"]));
		$cor = anti_injection($_GET["core"]);
		$edit = anti_injection($_GET["edit"]);
		if($tipo=="" or $nome=="" or $cor=="" or $edit=="" or !is_numeric($edit) or $edit<0){
			echo "<script>alert('Informe um Tipo de registro, Cadastro e cor.');</script>";
		}else{
			$grava = write("UPDATE s_conf  SET cadastro='$nome', cor='$cor', tipo='$tipo' where id='$edit'");
		}
	}
	if(isset($_GET["delete"])){
		$delete = anti_injection($_GET["delete"]);
		if(is_numeric($delete) and $delete!="" and $delete>=0){
			$q = erase("Select t.id from turma as t, s_conf as s where s.id=t.tipo_ensino and s.id='$delete' ");
			if(read_num_line($q)>0){
				echo "<script>alert('O período ou tipo de ensino estão associados em alguma turma, delete a turma para que possa ser feita a deleção.');</script>";
			}else{
				//s.id=t.periodo or
				$q = read("Select t.id from turma as t, s_conf as s where s.id=t.periodo and s.id='$delete' ");
				if(read_num_line($q)>0){
					echo "<script>alert('O período ou tipo de ensino estão associados em alguma turma, delete a turma para que possa ser feita a deleção.');</script>";
				}else{
					$q = read("Select id FROM turma_aluno WHERE situacao='$delete'");
					if(read_num_line($q)>0){
						echo "<script>alert('Resultado Final relacionada em alguma turma, não é possível fazer a sua deleção.');</script>";
					}else{
						$delconf = erase("DELETE FROM s_conf where id='$delete'");	
					}
				}
			}
		}else{
			echo "<script>alert('Erro nos dados enviados, tente de novo.');</script>";
		}
	}
	?>
 <h6><img src="img/add.png" width="30px" align="center" onclick="document.getElementById('registro').style.display='block'" style="cursor:pointer"/></h6>
    <table cellpadding="5px" cellspacing="0px" border="0" bordercolor="#000000" width="100%">
    <tr><td width="auto" valign="top">
    <h5>Período</h5>
    <table cellpadding="5" cellspacing="0" border="1" bordercolor="#333333">
    <tr>
    <td align="center"><strong>Período</strong></td>
    <td align="center"><strong>Opções</strong></td></tr>
<?php
$q = read("Select * from s_conf where tipo='p' order by cadastro");
while($resp = read_list($q)){
	$delete = "<a href='conf_sistema.php?delete=".$resp["id"]."' onclick=\"return confirm('Deseja mesmo deletar este período?');\"><img src='img/delete.png' alt='Delete período' title='Delete período' width='30px'></a>";
	$edite = "<a href='#' onclick=\"document.getElementById('editar').style.display='block'; document.getElementById('nomee').value='".htmlentities($resp["cadastro"],0,"iso-8859-1")."'; document.getElementById('edit').value='".$resp["id"]."'; document.getElementById('core').value='".$resp["cor"]."';\"><img src='img/edit.png' alt='Editar período' title='Editar período' width='30px'></a>";
	echo "<tr><td>
	<font color='#".$resp["cor"]."'>".htmlentities($resp["cadastro"],0,"iso-8859-1")."</font>
	</td><td>
	$delete &nbsp;&nbsp;&nbsp;&nbsp; $edite
	</td></tr>";
}
?>
</table>
	</td>
      <td width="auto" valign="top"><h5>Tipo de Ensino</h5>
<table cellpadding="5" cellspacing="0" border="1" bordercolor="#333333">
    <tr>
    <td align="center"><strong>Tipo de Ensino</strong></td>
    <td align="center"><strong>Opções</strong></td></tr>
<?php
$q = read("Select * from s_conf where tipo='e' order by cadastro");
while($resp = read_list($q)){
	$delete = "<a href='conf_sistema.php?delete=".$resp["id"]."' onclick=\"return confirm('Deseja mesmo deletar este tipo de ensino?');\"><img src='img/delete.png' alt='Delete tipo de ensino' title='Delete tipo de ensino' width='30px'></a>";
	$edite = "<a href='#' onclick=\"document.getElementById('editar').style.display='block'; document.getElementById('nomee').value='".htmlentities($resp["cadastro"],0,"iso-8859-1")."'; document.getElementById('edit').value='".$resp["id"]."'; document.getElementById('core').value='".$resp["cor"]."';\"><img src='img/edit.png' alt='Editar tipo ensino' title='Editar tipo ensino' width='30px'></a>";
	echo "<tr><td>
	<font color='#".$resp["cor"]."'>".htmlentities($resp["cadastro"],0,"iso-8859-1")."</font>
	</td><td>
	$delete &nbsp;&nbsp;&nbsp;&nbsp; $edite
	</td></tr>";
}
?>
</table></td>
    <td width="auto" valign="top">
    <h5>Tipo de Resultado Final</h5>
<table cellpadding="5" cellspacing="0" border="1" bordercolor="#333333">
    <tr>
    <td align="center"><strong>Resultdado Final</strong></td>
    <td align="center"><strong>Opções</strong></td></tr>
<?php
$q = read("Select * from s_conf where tipo='r' order by cadastro");
while($resp = read_list($q)){
	$delete = "<a href='conf_sistema.php?delete=".$resp["id"]."' onclick=\"return confirm('Deseja mesmo deletar este tipo de resultado final?');\"><img src='img/delete.png' alt='Delete tipo de ensino' title='Delete tipo de ensino' width='30px'></a>";
	$edite = "<a href='#' onclick=\"document.getElementById('editar').style.display='block'; document.getElementById('nomee').value='".htmlentities($resp["cadastro"],0,"iso-8859-1")."'; document.getElementById('edit').value='".$resp["id"]."'; document.getElementById('core').value='".$resp["cor"]."';\"><img src='img/edit.png' alt='Editar tipo ensino' title='Editar tipo ensino' width='30px'></a>";
	echo "<tr><td>
	<font color='#".$resp["cor"]."'>".htmlentities($resp["cadastro"],0,"iso-8859-1")."</font>
	</td><td>
	$delete &nbsp;&nbsp;&nbsp;&nbsp; $edite
	</td></tr>";
}
?>
</table>
    </td>
    </tr>
	</table>
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
