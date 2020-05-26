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
	<h4>Usuário - Visualizar</h4>
<?php
if(isset($_GET["delete"])){
	$delete = anti_injection($_GET["delete"]);
	if($delete!="" and $delete>0){
		$vdel = read("Select mail, tipo from s_usuario WHERE id='$delete'");
		$rdel = read_list($vdel);
		if($rdel["tipo"]==1){
			echo "<script>alert('Usuário ADMINISTADOR não pode ser deletado, mude o perfil para que possa ser feita a exclusão do usuário.');</script>";
		}else{
			$dmail = $rdel["mail"];
			$vdel = erase("DELETE FROM s_usuario WHERE id='$delete'");
			$vdel = erase("DELETE FROM s_usuario_logado WHERE f_usuario_id='$dmail'");
		}
	}else{
		echo "<script>alert('Informe um usuário válido a ser deletado.');</script>";
	}
}
$v = read("Select u.mail, u.id, u.nome, t.tipo, u.senha as pass FROM s_usuario as u, s_usuario_tipo as t WHERE u.tipo=t.id ORDER BY u.nome");
echo '<table cellpadding="5" cellspacing="0" border="1" bordercolor="#000000" align="center" width="700px"><tr>
<td align="center"><strong>Nome</strong></td>
<td align="center"><strong>Tipo</strong></td>
<td align="center"><strong>Opções</strong></td></tr>';
while($r=read_list($v)){
	$del=$edita=$lembra_senha="";
	if($tipo_usuario==1){
		$del = '<a href="usuario_view.php?delete='.$r["id"].'" onclick="return confirm(\'Deseja realmente deletar esse usuário?\');"><img src="img/delete.png" alt="Deletar usuário" width="30px" border="0"></a>';
		$edita = '<a href="profile.php?edita='.$r["id"].'"><img src="img/edit.png" alt="Editar" width="30px" border="0"></a>';
		$lembra_senha=" <div class='caixa' id='perfil".$r["id"]."'>
    	<div class='bloco'>
		<strong>Usuário: </strong>".$r["nome"]."<br>
		<strong>Senha:</strong>".decodic($r["pass"])."
		<input type='button' name='sair' value='Fechar' class='botao' onclick=\"document.getElementById('perfil".$r["id"]."').style.display='none';\" />
		</div></div><a href='#' onclick=\"document.getElementById('perfil".$r["id"]."').style.display='block';\"><img src='img/password.png' alt='Ver senha' title='Ver senha' width='30px' border='0'></a>";
	}else{
		if($r["mail"]==$login){
			$del = '<a href="usuario_view.php?delete='.$r["id"].'" onclick="return confirm(\'Deseja realmente deletar esse usuário?\');"><img src="img/delete.png" alt="Deletar usuário" width="30px" border="0"></a>';
			$edita = '<a href="profile.php?edita='.$r["id"].'"><img src="img/edit.png" alt="Editar" width="30px" border="0"></a>';
			$lembra_senha="";
		}
	}
		echo '<tr><td>'.htmlentities($r["nome"],0,"iso-8859-1").'</td><td>'.htmlentities($r["tipo"],0,"iso-8859-1").'</td><td align="center">'.$del.'&nbsp;&nbsp;&nbsp;'.$edita.'&nbsp;&nbsp;&nbsp;'.$lembra_senha.'</td></tr>';
	}
echo '</table>';
?>

</div>

<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
