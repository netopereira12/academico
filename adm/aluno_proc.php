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
	<?php
	if(!isset($_GET["tipo"])){
		$_GET["tipo"]=1;
	}
	switch ($_GET["tipo"]){
    	case 2:
	      $op = "pelo Nome da Mãe";
    	  break;
	    case 3:
    	  $op = "por R.A.";
	      break;
    	case 4:
	      $op = "por RM";
    	  break;
		default:
		  $op = "por Nome";
		  break;
	  }
    ?>
	<h4>Alunos - Procurar <?php echo $op; ?></h4>
    
    <center>
    <form action="aluno_proc.php" method="get" name="form">
    <strong>Procurar: </strong>
    <input type="text" name="proc" size="50px" id="proc" />
    <input type="hidden" name="tipo" value="<?php echo $_GET["tipo"]?>"/>
    <input type="submit" name="p" value="Procurar" />
    </form>
    </center>
<?php
if(isset($_GET["proc"])){
	$proc = anti_injection($_GET["proc"]);
	if($proc!=""){
		switch ($_GET["tipo"]){
    	case 2:
	      $op = "mae LIKE  '".$_GET["proc"]."%'";
    	  break;
	    case 3:
    	  $op = "ra='".$_GET["proc"]."'";
	      break;
    	case 4:
	      $op = "rm='".$_GET["proc"]."'";
    	  break;
		default:
		  $op = "nome LIKE  '".$_GET["proc"]."%'";
		  break;
	  }
	    //######### INICIO Paginação
	$total_reg = 20;
	if (!isset($_GET["pagina"])){
		$pc = "1";
	}else{
		$pc = $_GET['pagina'];
	}
	$inicio = $pc-1;
	$inicio = $inicio*$total_reg;


	
	  $pesq = "Select id, nome, nasc, mae, cx, rm, ra, dg from aluno where $op order by nome LIMIT $inicio, $total_reg";
	$pesq2 = "Select nome from aluno where $op order by nome";
			
		//ve o total dos registros
		$total = read($pesq2);
		$p = read($pesq);
		
		$tr = read_num_line($total);
		$tp = $tr/$total_reg;
		include("../script/mascara.php");
		echo "<table border='0' cellpadding='10' cellspacing='0' width='700px' align='center'>";
		while($resp = read_list($p)){
			echo "<tr><td style='border-bottom: 1px solid #000'>
			<big><font color='#f00'><strong>RM:</strong> ".$resp["rm"]." <strong>Caixa: </strong>".$resp["cx"]."</font></big><br>
			<strong>Aluno:</strong> ".htmlentities($resp["nome"],0,"iso-8859-1")."<br> <strong>Nasc. </strong> ".str_replace("-","/",date("d-m-Y", strtotime($resp["nasc"])))."<br>
			<strong>Mãe:</strong> ".htmlentities($resp["mae"],0,"iso-8859-1")."<br>
		 <strong>R.A.: </strong>".mask_ra($resp["ra"], "###.###.###.###")." - ".$resp["dg"]."		
			</td><td style='border-bottom: 1px solid #000'>
			<a href='aluno_perfil.php?id=".$resp["id"]."'><img src='img/vejamais.jpg' border='0'></a>";
			echo "</td></tr>";
		}
		echo "<tr><td>";
		// agora vamos criar os botões "Anterior e próximo"
		$anterior = $pc -1;
		$proximo = $pc +1;
		
		if($pc>1){
			$s = "proc=".$_GET["proc"]."&tipo=".$_GET["tipo"]."&p=Procurar&pagina=$anterior";
			echo " <a href='?$s'><- Anterior</a> | ";
		}
		if($pc<$tp){
			$s = "proc=".$_GET["proc"]."&tipo=".$_GET["tipo"]."&p=Procurar&pagina=$proximo";
			echo " <a href='?$s'>Próxima -></a>";
		}

		echo "</td></tr></table>";
	}else{
		echo "<h2 style='text-align: center;'>Informe um termo há ser pesquisado</h2>";
	}
}
?>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
