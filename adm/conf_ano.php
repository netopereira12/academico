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
	<h4>Configuração - Ano Letivo <img src="img/add.png" title="Adicionar ano letivo" alt="Adicionar ano letivo" width="30px" align="center" style="cursor:pointer;" onclick="document.getElementById('registro').style.display='block'"/></h4>
    <div class="caixa" id="registro">
    <div class="bloco">
    <h4>Abrir Ano Letivo</h4>
    <form action="conf_ano.php" method="get" name="anof">
    <strong>Ano: </strong><input type="text" name="ano" size="10"/><br />
    <input type="submit" name="enviar" value="Salvar" class="botao" />
    <input type="button" name="enviar" value="Cancelar" class="botao" onclick="document.getElementById('registro').style.display='none'"/>
    </form>
    </div></div>
   <div class="caixa" id="editar">
    <div class="bloco">
    <h4>Editar Ano Letivo</h4>
    <form action="conf_ano.php" method="get" name="anof">
    <input type="hidden" name="id" id="id" />
    <strong>Ano: </strong><input type="text" name="anoe" id="anoe" size="10"/><br />
    <input type="submit" name="enviar" value="Salvar" class="botao" />
    <input type="button" name="enviar" value="Cancelar" class="botao" onclick="document.getElementById('editar').style.display='none'"/>
    </form>
    <h5>Edição do ano pode acarretar danos ao sistema, cuidado ao faze-lo.</h5>
    </div></div>
    <?php
	//deleta ano
	if(isset($_GET["delete"])){
		$delete = anti_injection($_GET["delete"]);
		if(is_numeric($delete) and $delete>0 and $delete!=""){
			$q = read("Select ano from turma WHERE ano='$delete'");
			if(read_list($q)>0){
				echo "<script>alert('Ano associado a uma turma, delete a turma para que possa deletar o ano $delete.');</script>";
			}else{
				$q = erase("DELETE FROM s_ano WHERE ano='$delete'");
			}
		}else{
			echo "<script>alert('Erro no ano informado.');</script>";
		}
	}
	//edita ano
	if(isset($_GET["anoe"])){
		$ano = anti_injection($_GET["anoe"]);
		$id = anti_injection($_GET["id"]);
		if($ano!="" and is_numeric($ano) and $ano>0 and $id!="" and is_numeric($id) and $id>0){
			$q = read("Select * from s_ano WHERE ano='$ano'");
			if(read_list($q)<=0){
				$q = write("UPDATE s_ano SET ano='$ano' WHERE id='$id'");
			}else{
				echo "<script>alert('Ano já informado, tente novamente.');</script>";
			}
		}else{
			echo "<script>alert('Ano deve ser numérico e positivo.');</script>";
		}
	}
	//grava ano
	if(isset($_GET["ano"])){
		$ano = anti_injection($_GET["ano"]);
		if($ano!="" and is_numeric($ano) and $ano>0){
			$q = read("Select * from s_ano WHERE ano='$ano'");
			if(read_list($q)<=0){
				$q = write("INSERT INTO s_ano (ano) VALUES ('$ano')");
			}else{
				echo "<script>alert('Ano já informado, tente novamente.');</script>";
			}
		}else{
			echo "<script>alert('Ano deve ser numérico e positivo.');</script>";
		}
	}
	if(isset($_GET["atv"])){
		$atv = anti_injection($_GET["atv"]);
		if($atv!="" and is_numeric($atv) and $atv>0){
			$q = write("UPDATE s_ano SET status='0'");
			$q = write("UPDATE s_ano SET status='1' WHERE ano='$atv'");
		}else{
			echo "<script>alert('Ano deve ser numérico e positivo.');</script>";
		}
	}
	
	$busca = "Select * from s_ano order by ano DESC";
	$total_reg = "10"; // número de registros por página
	if(!isset($_GET["pagina"])){
		$pc = "1";
	}else{
		$pc = $_GET["pagina"];
	}
	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;
	
	$limite = read("$busca LIMIT $inicio, $total_reg");
	$todos = read("$busca");
	$tr = read_num_line($todos); // verifica o número total de registros
	$tp = $tr / $total_reg; // verifica o número total de páginas

	?>
    <table cellpadding="5" cellspacing="0" border="1" bordercolor="#333333" width="50%" align="center">
    <tr>
    <td align="center"><strong>Ano</strong></td>
    <td align="center"><strong>Status</strong></td>
    <td align="center"><strong>Opções</strong></td>
    </tr>
    <?php
	while($resp = read_list($limite)){
		echo "<tr><td align='center'>".$resp["ano"]."</td><td align='center'>";
		if($resp["status"]==1){
			$op = "<img src='img/on.png' width='30px'>";
		}else{
			$op = "<a href='conf_ano.php?atv=".$resp["ano"]."'><img src='img/off.png' width='30px' border='0'></a>";
		}
		echo $op;
			$delete = "<a href='conf_ano.php?delete=".$resp["ano"]."' onclick=\"return confirm('Deseja mesmo deletar este ano?');\"><img src='img/delete.png' alt='Delete ano' title='Delete ano' width='30px'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$editar = "<img src='img/edit.png' width='30px' border='0' alt='Editar ano letivo' title='Editar ano letivo' style='cursor: pointer' onclick=\"document.getElementById('editar').style.display='block'; document.getElementById('anoe').value='".$resp["ano"]."'; document.getElementById('id').value='".$resp["id"]."'\">";
		echo "</td><td align='center'>$delete $editar</td></tr>";
	}
	?>
    </table>
    <?php
	// agora vamos criar os botões "Anterior e próximo"
	$anterior = $pc -1; $proximo = $pc +1;
	if($pc>1){
		echo " <a href='?pagina=$anterior'><- Anterior</a> ";
	}
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	if($pc<$tp){
		echo " <a href='?pagina=$proximo'>Próxima -></a>";
	}

	?>
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
