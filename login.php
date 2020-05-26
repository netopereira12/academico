<?php
session_start();
if(isset($_POST["login"])){
	include("script/anti_injection.php");
	$login = anti_injection($_POST["login"]);
	if($_POST["senha"]){
		$senha = anti_injection($_POST["senha"]);
		include("script/codic.php");
		$login = codic($login);
		$senha = codic($senha);
		include("script/conecta_banco_consulta.php");
		$ver = read("SELECT u.mail, u.senha, tu.pasta from s_usuario as u, s_usuario_tipo as tu where u.mail='$login' and u.senha='$senha' and u.tipo=tu.id LIMIT 1");
		$resp = read_list($ver);
		$l = $resp["mail"];
		$s = $resp["senha"];
		$pasta = $resp["pasta"];
		if($l!=$login and $s!=$senha){
			header("Location: index.php?erro=3");
		}else{
			//echo "Usuario ".$_SESSION["login_scga-free_pw"]."</br>".$l." - $login";
			$token = codic(uniqid());
			date_default_timezone_set("Brazil/East");
			$data = date('Y-m-d H:i');
			$_SESSION["login_scga-free_pw"] = codic(base64_encode($l));
			$_SESSION["senha_scga-free_pw"] = codic(base64_encode($s));
			$_SESSION["token_scga-free_pw"] = $token;
			include("script/conecta_banco_escreve.php");
			$sql = write("INSERT INTO s_usuario_logado (f_usuario_id, usuario_token, data) VALUES ('$login', '$token', '$data')");
			
			echo "<script>window.location.replace('$pasta/')</script>";
		}
		
	}else{
		header("Location: index.php?erro=1");
	}
}else{
	header("Location: index.php?erro=1");
}
?>