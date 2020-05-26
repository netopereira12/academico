<?php
include("../script/codic.php");
include("../script/anti_injection.php");
session_start();
$login = anti_injection(base64_decode(decodic($_SESSION["login_scga-free_pw"])));
include("../script/conecta_banco_delete.php");
$del = erase("DELETE FROM s_usuario_logado WHERE f_usuario_id='$login'");



$_SESSION = array();
session_destroy();
echo "<script>window.location.replace('../')</script>";
?>