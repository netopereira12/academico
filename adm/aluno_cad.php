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
if(isset($_POST["cad"])){
	$nome = utf8_decode(mb_strtoupper(anti_injection($_POST["nome"]), 'UTF-8'));
	$pai = utf8_decode(mb_strtoupper(anti_injection($_POST["pai"]), 'UTF-8'));
	$mae = utf8_decode(mb_strtoupper(anti_injection($_POST["mae"]), 'UTF-8'));
	$caixa = utf8_decode(anti_injection($_POST["caixa"]));
	$rm = anti_injection($_POST["rm"]);
	$ra = anti_injection($_POST["ra"]);
	$dg = utf8_decode(mb_strtoupper(anti_injection($_POST["dg"]), 'UTF-8'));
	$dia = anti_injection($_POST["dia"]);
	$mes = anti_injection($_POST["mes"]);
	$ano = anti_injection($_POST["ano"]);
	$ingresso = anti_injection($_POST["ingresso"]);
	if($nome!="" and $pai!="" and $mae!="" and $caixa!="" and $rm!="" and is_numeric($rm) and $ra!="" and is_numeric($ra) and $dg!="" and strlen($dg)==1 and $ingresso!="" and strlen($ingresso)==4 and is_numeric($ingresso) and $dia!="" and $mes!="" and $ano!=""){
		include("../script/valida_data.php");
		$data = $ano."-".conf_zeroesq($mes)."-".conf_zeroesq($dia);
		if(validaData($data, "aaaammdd", "-")){
			//verifica se existe o aluno no sistema
			$q = read("Select id from aluno WHERE cx='$caixa' and rm='$rm' and ra='$ra' and dg='$dg'");
			if(read_num_line($q)==0){
				$id = uniqid();
			$q = write("INSERT INTO aluno () VALUES ('$id', '$nome', '$pai', '$mae', '$caixa', '$rm', '$ra', '$dg', '$data', '$ingresso')");
			echo "<script>alert('Aluno cadastrado com sucesso'); location.href='aluno_perfil.php?id=$id';</script>";
			}else{
				echo "<script>alert('Aluno já cadastrado'); history.go(-1);</script>";
			}
		}
	}else{
		echo "<script>alert('Erro nos dados informados, clique em ajuda para obter mais informações. Item: Cadastro de Aluno'); history.go(-1);</script>";
	}
	
}
?>
	<h4>Alunos - Cadastro</h4>
<form method="post" action="aluno_cad.php" name="cad">
<table cellpadding="5px" cellspacing="0px" border="0" align="center">
	<tr><td width="98"><strong>Aluno: </strong></td><td colspan="4"><input type="text" name="nome" size="47px" /></td></tr>
    <tr><td><strong>Pai: </strong></td><td colspan="4"><input type="text" name="pai" size="47px" /></td></tr>
    <tr><td><strong>Mãe: </strong></td><td colspan="4"><input type="text" name="mae" size="47px" /></td></tr>
    <tr><td><strong>Caixa: </strong></td><td width="62"><input name="caixa" type="text" value="0" size="10px" /></td>
      <td colspan="2"><strong>RM: </strong></td>
      <td width="174"><input type="text" name="rm" size="22px" /></td>
    </tr>
    <tr><td><strong>R.A.: </strong></td><td colspan="4"><input type="text" name="ra" size="30px" />
      <strong>Dígito: 
        <input type="text" name="dg" size="2px" />
      </strong></td>
      </tr>
    <tr>
      <td><strong>Nascimento*: </strong></td><td colspan="4">
    <select name="dia">
    	<?php
        for($x=1; $x<32; $x++){
			echo "<option value='$x'>$x</option>";
		}
		?>
    </select> / 
    <select name="mes">
    	<?php
        for($x=1; $x<13; $x++){
			echo "<option value='$x'>$x</option>";
		}
		?>
    </select> / 
    <select name="ano">
    	<?php
		$y = date("Y");
        for($x=1700; $x<=$y; $x++){
			echo "<option value='$x'>$x</option>";
		}
		?>
    </select>
    <strong>Ano de Ingresso**:</strong>    <select name="ingresso">
      <?php
		$y = date("Y");
        for($x=1700; $x<=$y; $x++){
			echo "<option value='$x'>$x</option>";
		}
		?>
    </select>
    
    <tr><td colspan="5" align="center">
      <input type="submit" name="cad" value="Cadastrar" class="botao" />
    </td></tr>
    <tr>
      <td colspan="5" align="left"><p style="color:#930">* - Data no formato dd/mm/aaaa<br />
        ** - Ano no formato aaaa
      </p></td>
    </tr>
</table>
</form>
  
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
