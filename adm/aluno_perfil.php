<?php 
include("valida_login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
<link href="../estilo/estilo_adm.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="aluno_ajax.js"></script>
<title><?php include("titulo.php");?></title>
</head>
<body >
<div class="topo">
	<?php include("topo.php"); ?>
</div>

<div class="menu">
	<?php include("menu.php"); ?>
</div>

<div class="texto">
	<h4>Perfil do Aluno</h4>
    <input type="image" onclick="javascript: history.go(-1);" src="img/icon_voltar.jpg" border="0" style="cursor: pointer"/>
    <?php
if(isset($_GET["id"])){
	$id = $_GET["id"];

	$pesq = "Select a.*, f.foto from aluno as a LEFT JOIN aluno_foto as f ON f.aluno=a.id  WHERE a.id='$id' LIMIT 1";
	$q = read($pesq);
	if(read_num_line($q)!=0){
	$resp = read_list($q);
	if($resp["foto"]==NULL){
		$img = "default.png";
	}else{
		$img = $resp["foto"];
	}
	include("../script/mascara.php");
	if(isset($_GET["salvar"])){
		$nome = utf8_decode(mb_strtoupper(anti_injection($_GET["aluno"]), 'UTF-8'));
		$ra = anti_injection($_GET["ra"]);
		$dg = anti_injection($_GET["dg"]);
		$caixa= utf8_decode(mb_strtoupper(anti_injection($_GET["caixa"]), 'UTF-8'));
		$rm = anti_injection($_GET["rm"]);
		$dia = anti_injection($_GET["dia"]);
		$mes = anti_injection($_GET["mes"]);
		$ano = anti_injection($_GET["ano"]);
		$pai = utf8_decode(mb_strtoupper(anti_injection($_GET["pai"]), 'UTF-8'));
		$mae = utf8_decode(mb_strtoupper(anti_injection($_GET["mae"]), 'UTF-8'));
		$ingresso = anti_injection($_GET["ingresso"]);
		$nasc = $ano."-".$mes."-".$dia;
		if($nome!="" and $ra!="" and $dg!="" and $caixa!="" and $rm!="" and $dia!="" and $mes!="" and $ano!="" and $pai!="" and $mae!="" and $ingresso!=""and is_numeric($ra) and is_numeric($rm) and is_numeric($mes) and is_numeric($dia) and is_numeric($ano) and is_numeric($ingresso)){
			$altera = write("UPDATE aluno SET nome='$nome', pai='$pai', mae='$mae', cx='$caixa', rm='$rm', ra='$ra', dg='$dg', nasc='$nasc' ,matricula='$ingresso' WHERE id='$id'");
		}else{
			echo "<script>alert('Informe todos os campos');</script>";
		}
	}
	?>

<!-- UPLLOAD da FOTO-->
<div class="caixa" id="upload">
<div class="bloco">
	<h4>Alterar Foto</h4>
    <form method="post" action="upload_foto.php" name="upload" enctype="multipart/form-data">
    <input type="file" name="arquivo" />
    <input type="hidden" name="tipo" value="2" />
    <input type="hidden" name="idaluno" value="<?php echo $id ?>" />
    <br />
    <input type="button" name="cancel" value="Cancelar" onclick="document.getElementById('upload').style.display='none'" class="botao"/>
    <input type="submit" name="enviar" value="Enviar" class="botao"/>
    </form>
</div></div>
	<div class="caixa" id="editar">
    <div class="bloco">
    <h4>Editar Aluno</h4>
    <form method="get" name="cor_cad" action="aluno_perfil.php">
    <input type="hidden" name="id" value="<?php echo $id?>" />
    <table cellpadding="0" cellspacing="0" border="0">
    <tr><td><strong>Aluno: </strong></td>
    <td><input type="text" name="aluno" value="<?php echo htmlentities($resp["nome"],0,"iso-8859-1") ?>" size="50"/>
   </td></tr>
   <tr><td><strong>R.A.: </strong></td>
    <td><input name="ra" value="<?php echo htmlentities($resp["ra"]) ?>" size="50"></td></tr>
    <tr><td><strong>Digito: </strong></td>
    <td><input name="dg" value="<?php echo htmlentities($resp["dg"]) ?>" size="50"></td></tr>
    <tr><td><strong>Caixa: </strong></td>
    <td><input type="text" name="caixa" value="<?php echo htmlentities($resp["cx"]) ?>" size="50"/></td></tr>
    <tr><td><strong>RM: </strong></td>
    <td><input name="rm" value="<?php echo htmlentities($resp["rm"]) ?>" size="50"></td></tr>
    <tr><td><strong>Nascimento: </strong></td>
    <?php $data = explode("-",$resp["nasc"]); ?>
    <td><input name="dia" value="<?php echo $data[2] ?>" size="2">/<input name="mes" value="<?php echo $data[1] ?>" size="2">/<input name="ano" value="<?php echo $data[0] ?>" size="2">dd/mm/aaaa</td></tr>
    <tr><td><strong>Pai: </strong></td>
    <td><input name="pai" value="<?php echo htmlentities($resp["pai"],0,"iso-8859-1") ?>" size="50"></td></tr>
    <tr><td><strong>Mãe: </strong></td>
    <td><input name="mae" value="<?php echo htmlentities($resp["mae"],0,"iso-8859-1") ?>" size="50"></td></tr>
    <tr><td><strong>Ano de Ingresso: </strong></td>
    <td><input name="ingresso" value="<?php echo htmlentities($resp["matricula"]) ?>" size="50"></td></tr>
    <tr><td colspan="2" align="center">
    <input type="submit" value="Salvar"  name="salvar" class="botao"/>
    <input type="button" value="Fechar"  class="botao" onclick="document.getElementById('editar').style.display='none'"/>
    </td></tr></table>
    </form>
    </div></div>

<table cellpadding="5" cellspacing="0" border="0">
<tr>
  <td colspan="8" align="center" valign="middle">
<div class="icone">
<input type="hidden" name="txtnome" id="txtnome" value="<?php echo $id?>"/>
<input type="image" src="img/icon_document_fail.png" name="btnPesquisar" value="Pesquisar" onclick="getDoc();" width="50px" border="0"/>
Documento Pendente</div>
  <div class="icone">
  <input type="hidden" name="dig" id="dig" value="<?php echo $id?>"/>
<input type="image" src="img/icon_archive1.png" name="btnPesquisar" value="Pesquisar" onclick="getDocDig();" width="50px" border="0"/>
Documentos Digitalizados</div>
    <div class="icone">
      <input type="hidden" name="emitido" id="emitido" value="<?php echo $id?>"/>
<input type="image" src="img/icon_documento_expedidos.png" name="btnPesquisar" value="Pesquisar" onclick="getDocEmitido();" width="50px" border="0"/>
Documentos Expedidos</div>
    <div class="icone">
    <input type="hidden" name="matricula" id="matricula" value="<?php echo $id?>"/>
<input type="image" src="img/icon_box.png" name="btnPesquisar" value="btnPesquisar" onclick="getMatricula();" width="50px" border="0"/>
Matrículas
</div>
    <div class="icone"><a href="#" class="icone" onclick="document.getElementById('editar').style.display='block'"><img src="img/icon_class_Edit.png" alt="Editar Aluno" title="Editar Aluno" width="50px" height="51px"/><br />
      Editar Aluno</a></div>    </td>
  </tr>
<tr>
  <td rowspan="7" align="center"><img src="../foto/alu/<?php echo $img?>" width="120px"/><br />
  <a href='#' onclick="document.getElementById('upload').style.display='block';">Clique aqui para alterar a foto.</a>
  </td>
  <td colspan="3" width="50%"><strong>Aluno: </strong><?php echo htmlentities($resp["nome"]) ?></td>
  <td width="50%" rowspan="11" valign="top">
  <div id="resultado" class="box">
  </div>
  </td>
  </tr>
<tr>
  <td colspan="3"><big><strong>Caixa: <?php echo $resp["cx"] ?> RM: <?php echo $resp["rm"] ?></strong></big></td>
  </tr>
<tr>
  <td colspan="3"><strong>R.A.: </strong><?php echo mask_ra($resp["ra"], "###.###.###.###")." - ".$resp["dg"] ?></td>
  </tr>
<tr>
  <td colspan="3"><strong>Nascimento: </strong><?php echo str_replace("-","/",date("d-m-Y", strtotime($resp["nasc"]))); ?></td>
  </tr>
<tr>
  <td colspan="3"><strong>Pai:</strong> <?php echo htmlentities($resp["pai"],0,"iso-8859-1") ?></td>
  </tr>
<tr>
  <td colspan="3"><strong>Mãe: </strong><?php echo htmlentities($resp["mae"],0,"iso-8859-1") ?></td>
  </tr>
<tr>
  <td colspan="3"><strong>Ano de Ingresso: </strong><?php echo $resp["matricula"] ?></td>
  </tr>
<tr>
  <td align="center">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
  </tr>
<tr>
  <td align="center">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
  </tr>
<tr>
  <td align="center">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
  </tr>
<tr>
  <td align="center">&nbsp;</td>
  <td colspan="3">&nbsp;</td>
  </tr>

</table>
	<?php
	}else{
		echo "<center><h2>Aluno não localizado.</h2></center>";
	}
}else{
	echo "<center><h2>Aluno não localizado.</h2></center>";
}
?>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
