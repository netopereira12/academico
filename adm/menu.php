<style>
ul#css3menu1,ul#css3menu1 ul{
	margin:0;list-style:none;padding:0;background-color:#dedede;border-width:1px;border-style:solid;border-color:#5f5f5f;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}
ul#css3menu1 ul{
	display:none;position:absolute;left:0;top:100%;-moz-box-shadow:3.5px 3.5px 5px #000000;-webkit-box-shadow:3.5px 3.5px 5px #000000;box-shadow:3.5px 3.5px 5px #000000;background-color:#FFFFFF;border-radius:6px;-moz-border-radius:6px;-webkit-border-radius:6px;border-color:#d4d4d4;padding:0 10px 10px;}
ul#css3menu1 li:hover>*{
	display:block;}
ul#css3menu1 li{
	position:relative;display:block;white-space:nowrap;font-size:0;float:left;vertical-align:middle;}
ul#css3menu1 li:hover{
	z-index:1;}
ul#css3menu1{
	font-size:0;z-index:999;position:relative;display:inline-block;zoom:1;padding:0;
	*display:inline;}
* html ul#css3menu1 li a{
	display:inline-block;}
ul#css3menu1>li{
	margin:0;}
ul#css3menu1 a:active, ul#css3menu1 a:focus{
	outline-style:none;}
ul#css3menu1 a{
	display:block;vertical-align:middle;text-align:left;text-decoration:none;font:bold 14px Trebuchet MS;color:#000000;text-shadow:#FFF 0 0 1px;cursor:pointer;padding:10px;background-color:#c1c1c1;background-image:url("img/mainbk.png");background-repeat:repeat;background-position:0 0;border-width:0 0 0 1px;border-style:solid;border-color:#C0C0C0;}
ul#css3menu1 ul li{
	float: none;
	margin-right: 0;
	margin-bottom: 0;
	margin-left: 0;
	margin-top: 0px;
}
ul#css3menu1 ul a{
	text-align:left;padding:4px;background-color:#FFFFFF;background-image:none;border-width:0;border-radius:0px;-moz-border-radius:0px;-webkit-border-radius:0px;font:14px Tahoma;color:#000;text-decoration:none;}
ul#css3menu1 li:hover>a,ul#css3menu1 li a.pressed{
	background-color:#f8ac00;border-color:#C0C0C0;border-style:solid;color:#000000;text-shadow:#FFF 0 0 1px;background-image:url("img/mainbk.png");background-position:0 100px;text-decoration:none;}
ul#css3menu1 span{
	display:block;overflow:visible;background-position:right center;background-repeat:no-repeat;padding-right:0px; text-align:center; vertical-align:middle;}
ul#css3menu1 ul li:hover>a,ul#css3menu1 ul li a.pressed{
	background-color: #FFF;background-image:none;color: #900;text-decoration:none; font-weight:bold;}
ul#css3menu1 li.topfirst>a{
	border-radius: 5px 0 0 5px;
	-moz-border-radius: 5px 0 0 5px;
	-webkit-border-radius: 5px;
	-webkit-border-top-right-radius: 0;
	-webkit-border-bottom-right-radius: 0;
	vertical-align: middle;
}
ul#css3menu1 li.toplast>a{
	border-radius:0 5px 5px 0;-moz-border-radius:0 5px 5px 0;-webkit-border-radius:0;-webkit-border-top-right-radius:5px;-webkit-border-bottom-right-radius:5px;}
</style>
<ul id="css3menu1" class="topmenu">
	<li class="topfirst"><a href="index.php" style="height:18px;line-height:18px;"><img src="img/icon_house.png" border="0" width="25px" valign="middle" align="center">Início</a></li>

	<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span><img src="img/icon_cliente.png" border="0" width="24px" align="center" valign="middle"> Usu&aacute;rios</span></a>
	<ul>
		<li><a href="usuario_cad.php">Cadastrar</a></li>
        <li><a href="usuario_view.php">Visualizar</a></li>
	</ul></li>

	<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span><img src="img/icon_conf.png" border="0" width="24px" align="center" valign="middle"> Configuraç&otilde;es</span></a>
	<ul>
		<li><a href="conf_ano.php">Ano Letivo</a></li>
        <li><a href="conf_documento.php">Documentaç&atilde;o</a></li>
        <li><a href="conf_sistema.php">Sistema</a></li>
		<li><a href="conf_ftp.php">FTP</a></li>
        <li><a href="conf_ue.php">Unidade de Ensino</a></li>
	</ul></li>


	<li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span><img src="img/icon_box.png" border="0" width="24px" align="center" valign="middle"> Turmas</span></a>
	<ul>
		<li><a href="turma_cada.php">Cadastrar Turma</a></li>
        <li><a href="turma_view.php">Visualizar Turma</a></li>
	</ul></li>
    
  <li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><span><img src="img/icon_class.png" border="0" width="24px" align="center" valign="middle"> Alunos</span></a>
    <ul>
    	<li><a href="aluno_proc.php?tipo=1">Procurar por Nome</a></li>
        <li><a href="aluno_proc.php?tipo=2">Procurar por Nome da Mãe</a></li>
        <li><a href="aluno_proc.php?tipo=3">Procurar por RA</a></li>
        <li><a href="aluno_proc.php?tipo=4">Procurar por RM</a></li>
        <li><a href="aluno_cad.php">Cadastro</a></li>
    </ul>
  </li>
    
    <li class="topmenu"><a href="#" style="height:18px;line-height:18px;"><img src="img/icon_profile.png" width="25px" valign="middle" align="center" border="0"> Perfil</a>
    <ul>
    	<li><a href="profile.php">Meus Dados</a></li>
        <li><a href="profile_senha.php">Trocar Senha</a></li>
    </ul>
    </li>
    <li class="topmenu"><a href="favorito.php" style="height:18px;line-height:18px;"><img src="img/icon_star.png" width="25px" valign="middle" align="center" border="0"> Favoritos</a></li>
	<li class="toplast"><a href="logout.php" style="height:18px;line-height:18px;"><img src="img/icon_exit.png" width="25px" valign="middle" align="center" border="0"> Sair</a></li>
</ul>