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
    if(isset($_POST["senhaold"], $_POST["senhaconfirm"], $_POST["senhanew"])){
		//include("../script/anti_injection.php");
		$senhaold = anti_injection($_POST["senhaold"]);
		$senhanew = anti_injection($_POST["senhanew"]);
		$senhaconfirm = anti_injection($_POST["senhaconfirm"]);
		if($senhaconfirm!="" and $senhanew!="" and $senhaold!=""){
			if($senhanew != $senhaconfirm){
				echo "<script>alert('Nova Senha e Confirmaç&atilde;o de Senha n&atilde;o conferem.');</script>";
			}else{
				//include("../script/codic.php");
				
				if(decodic($senha) != $senhaold){
					echo "<script>alert('Senha antiga nao confere.');</script>";
				}else{
					$senhanew = codic($senhanew);
					$sql = write("UPDATE s_usuario SET senha='$senhanew' WHERE mail='$login'");
					echo "<script>alert('Senha alterada.');</script>";
				}
			}
		}else{
			echo "<script>alert('Todos os Campos devem ser preencidos.');</script>";
		}
	}
	 ?>
	<h4>Perfil - Alterar Senha</h4>
    <form action="profile_senha.php" method="post" name="senha">
    <table cellpadding="0" cellspacing="0">
    <tr><td><strong>Senha Antiga: </strong></td><td><input type="password" name="senhaold" size="40"/></td></tr>
    <tr><td><strong>Nova Senha: </strong></td><td><input type="password" name="senhanew" size="40"/></td></tr>
    <tr><td><strong>Confirme Senha: </strong></td><td><input type="password" name="senhaconfirm" size="40"/></td></tr>
    <tr><td colspan="2" align="center">
    <input type="submit" class="botao" value="Alterar" name="salvar"/>
    </td></tr>
    </table>
    </form>
</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
