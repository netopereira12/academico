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
	<h4>Usuário - Cadastro</h4>
    
<?php
if(isset($_POST["salvar"])){
	$nome = utf8_decode(mb_strtoupper(anti_injection($_POST["nome"]), 'UTF-8'));
	$mail = anti_injection($_POST["mail"]);
	$senha = anti_injection($_POST["senha"]);
	$csenha = anti_injection($_POST["csenha"]);
	$nivel = anti_injection($_POST["nivel"]);
	if($nome!="" and $mail!="" and $senha!="" and $nivel!="" and is_numeric($nivel)){
		include("../script/valida_mail.php");
		if(validaemail($mail)){
			include("../script/valida_senha.php");
			if(valida_senha($senha, $csenha)){
				$mail = codic($mail);
				$senha = codic($senha);
				$vuser = read("Select nome FROM s_usuario WHERE mail='$mail'");
				if(read_num_line($vuser)==0){
					$cad = write("INSERT INTO s_usuario (nome, mail, senha, tipo, foto) VALUES ('$nome', '$mail', '$senha','$nivel','default.png')");
					echo "<script>alert('Usuário cadastrado com sucesso.');</script>";
				}else{
					echo "<script>alert('E-mail já cadastrado.'); history.go(-1);</script>";
				}
			}else{
				echo "<script>alert('Confirmação de senha não confere ou senha possui menos de 6 caracteres ou senha possui mais de 12 caracteres.'); history.go(-1);</script>";
			}
		}else{
			echo "<script>alert('E-mail em formato inválido.'); history.go(-1);</script>";
		}
	}else{
		echo "<script>alert('Os campos não podem ser em branco. Informe todos os campos.'); history.go(-1);</script>";
	}
}
?>
<form action="usuario_cad.php" method="post" name="cad">
<table cellpadding="5" cellspacing="0" border="0" align="center">
<tr><td>
<strong>Nome:	</strong>
</td><td><input type="text" name="nome" size="30px" /></td></tr>
<tr><td>
<strong>E-mail:	</strong>
</td><td><input type="text" name="mail" size="30px" /></td></tr>
<tr><td>
<strong>Senha:	</strong>
</td><td><input type="password" name="senha" size="30px" /></td></tr>
<tr><td>
<strong>Confirme a Senha:	</strong>
</td><td><input type="password" name="csenha" size="30px" /></td></tr>
<tr><td>
<strong>Nível:	</strong>
</td><td>
<select name="nivel">
	<?php 
	$v = read("Select tipo, id from s_usuario_tipo ORDER BY tipo");
	while($r = read_list($v)){
		if($tipo_usuario==1){
			echo "<option value='".$r["id"]."'>".htmlentities($r["tipo"],0,"iso-8859-1")."</option>";
		}else{
			if($r["id"]>1){
				echo "<option value='".$r["id"]."'>".htmlentities($r["tipo"],0,"iso-8859-1")."</option>";
			}
		}
	}
	?>
</select>
</td></tr>
<tr><td align="center" colspan="2">
<input type="submit" value="Salvar" name="salvar" class="botao"/>
</td></tr>
</table>
</form>
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
