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
	<h4><a href="turma_view.php">Turma</a> - Documentação Pendente</h4>
    
    <?php
if(isset($_GET["turma"])){
	$turma = anti_injection($_GET["turma"]);
	if($turma!=""){
		?>
        <a href="turma_doc_excel.php?turma=<?php echo $turma?>"><img src="img/icon_xls.png" width="30px" alt="Gerar pedidos de documentos em Excel" title="Gerar pedidos de documentos em Excel" border="0"/></a>
        <a href="turma_doc_print.php?turma=<?php echo $turma?>" target="_blank"><img src="img/print.png" width="30px" alt="Imprir pedidos de documentos" title="Imprir pedidos de documentos"/></a>
        
		<?php
		$q = read("Select * from s_ue WHERE id='1' ");
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		if(read_num_line($c)!=0){
			$vt = read_list($c);
			$ve = read_list($q);
			include("../script/mascara.php");
			
			$c = read("SELECT t.num, a.id, a.nome, a.ra, a.dg, sdoc.doc, t.situacao FROM aluno as a, turma_aluno as t, aluno_doc_p as doc, s_doc as sdoc WHERE t.turma='$turma' and t.aluno=a.id and a.id=doc.aluno and doc.doc=sdoc.id and t.situacao=0 order by t.num");
			$aluno ="";
				while($v = read_list($c)){
					if($aluno!=$v["id"]){
						?>
                        <br />
                        <hr />
						<table cellpadding="5" cellspacing="0" border="0" align="center">
                        <tr><td><img src="../foto/log/<?php echo $ve["logo"]?>" width="50px"/>
                        </td>
                        <td align="center">
                        <strong><?php echo htmlentities($ve["nome"],0,"iso-8859-1") ?></strong><br />
                        <strong><?php echo htmlentities($ve["rua"],0,"iso-8859-1") ?></strong>, 
                        <strong><?php echo $ve["num"]?></strong> - 
                        <strong><?php echo htmlentities($ve["cidade"],0,"iso-8859-1") ?></strong>/
                        <strong><?php echo $ve["uf"]?></strong> - 
                        <strong>CEP: <?php echo $ve["cep"]?></strong><br />
                        <strong>Telefone: <?php echo mascara("(##)-####-####", $ve["tel"]);?></strong><br />
                        </td>
                        </tr>
                        </table>
						<?php
						echo "<h5 style='color: #000' align='center'>".$vt["serie"]."ª ".$vt["turma"]." - Ensino ".htmlentities($vt["tensino"],0,"iso-8859-1")."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Período: <font color='#".$vt["cor"]."'>".htmlentities($vt["tperiodo"],0,"iso-8859-1")."</font></h5>";
						echo "<p><strong>Aluno(a): &nbsp;&nbsp;&nbsp;</strong>".htmlentities($v["nome"],0,"iso-8859-1")." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nº:</strong> ".$v["num"]."</p>";
						$aluno=$v["id"];
						echo "<p><strong>Providenciar os seguintes documentos:</strong></p>";
						echo "<p><strong>Regularize a sua situação, pois a não apresentação da documentação prejudicará a sua vida escola.</strong></p>";
						echo "<p>Campinas, ".date("d/m/Y")."</p><br>";
					}
					echo "<big><strong>&nbsp;&nbsp;&nbsp;&nbsp;".htmlentities($v["doc"],0,"iso-8859-1")."</strong></big><br>";
				}
		}
	}
}
 ?>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
