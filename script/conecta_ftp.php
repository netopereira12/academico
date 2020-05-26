<?php
$vftp = read("Select * from s_ftp where id=1");
$rftp = read_list($vftp);

$servidor_ftp = decodic($rftp["ftp_server"]);
$usuario_ftp = decodic($rftp["ftp_user"]);
$senha_ftp = decodic($rftp["ftp_pass"]);
$ftp_aluno = decodic($rftp["ftp_aluno"]);
$ftp_doc = decodic($rftp["ftp_doc"]);
$ftp_qrcode = decodic($rftp["ftp_qrcode"]);
$ftp_logo = decodic($rftp["ftp_logo"]);

//futebol/prof_img

//echo "<br />$servidor_ftp <br /> $usuario_ftp  <br />$senha_ftp";

$ftp_conecta = ftp_connect($servidor_ftp);
$ftp_login = ftp_login($ftp_conecta, $usuario_ftp, $senha_ftp);

?>