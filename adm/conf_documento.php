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
	<h4>Configuração - Documentação <img src="img/add.png" width="30px" align="center" onclick="document.getElementById('doc').style.display='block'" style="cursor:pointer"/></h4>
    <div class="caixa" id="doc">
    <div class="bloco">
    <h4>Adicionar Documentos</h4>
    <form action="conf_documento.php" method="get">
    <strong>Documento: </strong><input type="text" name="documento" size="40" /><br />
    <center>
    <input type="submit" value="Salvar" class="botao"/>
    <input type="button" value="Fechar"  class="botao" onclick="document.getElementById('doc').style.display='none'"/>
    </center>
    </form>
    </div></div>
    <div class="caixa" id="doce">
    <div class="bloco">
    <h4>Editar Documentos</h4>
    <form action="conf_documento.php" method="get">
    <input type="hidden" name="ide" id="ide" />
    <strong>Documento: </strong><input type="text" name="documentoe" id="documentoe" size="40" /><br />
    <center>
    <input type="submit" value="Salvar" class="botao"/>
    <input type="button" value="Fechar"  class="botao" onclick="document.getElementById('doce').style.display='none'"/>
    </center>
    </form>
    </div></div>
    <?php
	if(isset($_GET["documento"])){
		$doc = anti_injection($_GET["documento"]);
		if($doc!=""){
			$doc = utf8_decode(mb_strtoupper($doc, 'UTF-8'));
			$q = read("Select * from s_doc where doc='$doc' order by doc");
			if(read_list($q)<=0){
				$q = write("INSERT INTO s_doc (doc) VALUES ('$doc')");
			}else{
				echo "<script>alert('Já existe este documento cadastrado, informe outro.');</script>";
			}
		}else{
			echo "<script>alert('Documento não pode ser vazio, informe um valor válido.');</script>";
		}
	}
	if(isset($_GET["documentoe"])){
		$doc = anti_injection($_GET["documentoe"]);
		$id = anti_injection($_GET["ide"]);
		if($doc!="" and $id>0 and is_numeric($id) and $id!=""){
			$doc = utf8_decode(mb_strtoupper($doc, 'UTF-8'));
			$q = read("Select * from s_doc where doc='$doc' order by doc");
			if(read_num_line($q)<=0){
				$q = write("UPDATE s_doc SET doc='$doc' WHERE id='$id'");
			}else{
				echo "<script>alert('Já existe este documento cadastrado, informe outro.');</script>";
			}
		}else{
			echo "<script>alert('Documento não pode ser vazio, informe um valor válido.');</script>";
		}
	}
	if(isset($_GET["delete"])){
		$id = anti_injection($_GET["delete"]);
		if(is_numeric($id) and $id!=""){
			$q = read("Select * from aluno_doc where doc='$id' limit 1");
			if(read_num_line($q)<=0){
				$q = erase("DELETE FROM s_doc WHERE id='$id'");
			}else{
				echo "<script>alert('Documento relacionado à um aluno, exclua a relação para que seja feita a deleção.');</script>";
			}
		}else{
			echo "<script>alert('Documento não pode ser vazio, informe um valor válido.');</script>";
		}
	}
	?>
<table cellpadding="5" cellspacing="0" border="1" bordercolor="#333333" align="center" width="50%">
<tr>
<td align="center"><strong>Documento</strong></td>
<td align="center"><strong>Opções</strong></td></tr>
<?php
$q = read("Select * from s_doc order by doc");
while($resp = read_list($q)){
	$delete = "<a href='conf_documento.php?delete=".$resp["id"]."' onclick=\"return confirm('Deseja mesmo deletar este documento?');\"><img src='img/delete.png' alt='Deletar documento' title='Deletar documento' width='30px'></a>";
	$edite = "<a href='#' onclick=\"document.getElementById('doce').style.display='block'; document.getElementById('documentoe').value='".htmlentities($resp["doc"],0,"iso-8859-1")."'; document.getElementById('ide').value='".$resp["id"]."';\"><img src='img/edit.png' alt='Editar documento' title='Editar documento' width='30px'></a>";
	echo "<tr><td>".htmlentities($resp["doc"],0,"iso-8859-1")."</td><td>$delete &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $edite</td></tr>";
}
?>
</table>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
