<?php
session_start();
$tipo_master = "2";
include("../script/codic.php");
include("../script/anti_injection.php");
include("../script/conecta_banco_consulta.php");
include("../script/conecta_banco_delete.php");
include("../script/conecta_banco_escreve.php");

if(isset($_SESSION["login_scga-free_pw"], $_SESSION["senha_scga-free_pw"])){
	$login = anti_injection(base64_decode(decodic($_SESSION["login_scga-free_pw"])));
	$senha = anti_injection(base64_decode(decodic($_SESSION["senha_scga-free_pw"])));
	$token = anti_injection($_SESSION["token_scga-free_pw"]);
	//include("../script/script.php");
	
	if($login!="" and $senha!="" and $token!=""){
//		echo ($login)." << ".$token." >> ".$senha;
		$r = read("Select t.data, u.mail, u.senha, t.usuario_token, u.tipo FROM s_usuario_logado as t, s_usuario as u WHERE u.mail='$login' and u.senha='$senha' and t.f_usuario_id=u.mail");
//		echo  mysql_num_rows($r);
		$line_num=read_num_line($r);
		if($line_num==1){
			$v = read_list($r);
			if($v["mail"]==$login and $v["senha"]==$senha and $v["usuario_token"]==$token and $v["tipo"]<=$tipo_master){
				$tipo_usuario=$v["tipo"];
				date_default_timezone_set("Brazil/East");	
				$dataexp = strftime("%m/%d/%Y %I:%M %p", strtotime($v["data"]."+ 30 minutes"));
				$datalog = strftime("%m/%d/%Y %I:%M %p", strtotime($v["data"]));
				$datacont = date("m/d/Y h:i A");
				//echo "$datacont $dataexp";
				if(strtotime($datacont) > strtotime($dataexp )){
					
					$sql = erase("DELETE FROM s_usuario_logado WHERE f_usuario_id='$login'");
					echo "<script>
						alert('Sessão Expirou, entre novamente.');
						location.href='logout.php';
					</script>";
				}else{
					$new_data = date("Y-m-d H:i:s");
					$sql = write("UPDATE s_usuario_logado SET data='$new_data' WHERE f_usuario_id='$login'");
					$dataexp = strftime("%m/%d/%Y %I:%M %p", strtotime($new_data."+ 30 minutes"));
				}
					//echo "$datacont $dataexp $datalog";
			}else{
				session_start();
				$_SESSION = array();
				session_destroy();
				$del = erase("DELETE FROM s_usuario_logado WHERE f_usuario_id='$login'");
				echo "<script>alert('Login não efetuado.'); location.href='index.php';</script>";
			}
		}else{
			echo "<script>alert('ERRO FATAL.'); location.href='logout.php';</script>";
		}
	}else{
		echo "<script>alert('Login não efetuado.'); location.href='logout.php';</script>";
	}
}else{
	echo "<script>alert('Login não efetuado.'); location.href='logout.php';</script>";
}
?>