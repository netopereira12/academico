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
	<h4>Perfil</h4>
    <?php
	
	if(isset($_GET["edita"])){
		$edita = anti_injection($_GET["edita"]);
		if($edita!="" and $edita>0 and is_numeric($edita)){
			if(isset($_GET["nome"]) and isset($_GET["nivel"])){
				$nome = utf8_decode(mb_strtoupper(anti_injection($_GET["nome"]), 'UTF-8'));
				$nivel = anti_injection($_GET["nivel"]);
				if($nome!="" and $nivel!=""){
					$sql = write("UPDATE s_usuario SET nome='$nome', tipo='$nivel' WHERE id='$edita'");
				}
			}
			$sql = read("SELECT t.tipo, u.nome, u.foto, u.id FROM s_usuario as u, s_usuario_tipo as t WHERE u.id='$edita' and u.tipo=t.id");
		}
	}else{
		$sql = read("SELECT t.tipo, u.nome, u.foto, u.id FROM s_usuario as u, s_usuario_tipo as t WHERE u.mail='$login' and u.tipo=t.id");
		if(isset($_GET["login"])){
			$sql = read("SELECT t.tipo, u.nome, u.foto, u.id FROM s_usuario as u, s_usuario_tipo as t WHERE u.mail='$login' and u.tipo=t.id");
		}
	}
	$resp = read_list($sql);
	echo "<table cellpadding='0' cellspacing='10' align='center'><tr><td>
	<center><a href='profile_foto.php'><img src='../foto/alu/".$resp["foto"]."' width='200px' alt='Trocar foto' title='Trocar foto'><br>Trocar foto</a></center><br><br><strong>Nome:</strong> ".htmlentities($resp["nome"],0,"iso-8859-1")."<br><br><strong>Nível: </strong>".htmlentities($resp["tipo"],0,"iso-8859-1")."
	</td><td><a href='profile_senha.php'>Trocar Senha</a><br><br>
	<a href='#' onclick=\"document.getElementById('perfil').style.display='block';\">Editar Perfil</a>
	</td></tr></table>
	";
	?>
    <div class="caixa" id="perfil">
    	<div class="bloco">
        	<form action="profile.php" name="editar" method="get">
            <input type="hidden" name="edita" value="<?php echo $resp["id"]?>" />
            <h4>Editar Perfil</h4>
            <strong>Nome: </strong><input type="text" name="nome" value="<?php echo htmlentities($resp["nome"],0,"iso-8859-1") ?>" size="30px"/><br />
            <strong>Nível: </strong><select name="nivel">
            <?php
			 $sql = read("SELECT * FROM s_usuario_tipo order by tipo");
			 while($resp=read_list($sql)){
				 echo '<option value="'.$resp["id"].'">'.htmlentities($resp["tipo"],0,"iso-8859-1").'</option>';
			}
			?>
            </select>
            <br />
            <center>
            <input type="button" name="sair" value="Cancelar" class="botao" onclick="document.getElementById('perfil').style.display='none';" />
            <input type="submit" value="Salvar" class="botao" />
            </center>
            </form>
	    </div>
    </div>
</div>
<div class="rodape">
<?php include("rodape.php"); ?>
</div>

</body>
</html>
