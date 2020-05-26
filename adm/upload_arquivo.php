<?php
include("valida_login.php");
//configurações
$tammax = 5242880; // 5MB
$extencao = array('.jpg','.jpeg','.gif','.png','.bmp','.xls','.xlsx','.doc','.docx','.pdf');
//pega arquivo
$arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
$tamanho_arquivo = $arquivo['size'];
$erro = 0;
if($tamanho_arquivo> $tammax){
	$t = $tammax/1024/1024;
	$ok=0;
	echo "<script>alert('Tamanho máximo do arquivo deve ser de $t MB. o seu arquivo tem $tamanho_arquivo'); history.go(-1);</script>";
	$erro=1;
}else{
	$ext = strtolower(strrchr($arquivo['name'], '.'));
	if(!in_array($ext, $extencao)){
		$ok=0;
		echo "<script>alert('Tipo de arquivo inválido.'); history.go(-1);</script>";
		$erro=1;
    }else{
		$codigo = $_POST["tipo"];
		$idaluno = $_POST["idaluno"];
		$descricao = utf8_decode(mb_strtoupper(anti_injection($_POST["descricao"]),'UTF-8'));
		if($descricao==""){
			echo "<script>alert('A Descrição do arquivo não pode ser vazio'); history.go(-1);</script>";
		}else{
			if($erro==1){
				echo" <script>alert('Insira uma imagem, ou tamanho não suportado.'); history.go(-1);</script>";
			}else{
				include("../script/conecta_ftp.php");
					if((!$ftp_conecta) || (!$ftp_login)){
						echo "ERRO DE CONEXÃO FTP";
						$ok=0;
					}else{
						$nome = uniqid();
						$new = $nome.$ext;
						if($codigo==1 or $codigo==2){
							$destino = $ftp_doc."/".$arquivo['name'];
							$novo = $ftp_doc."/".$nome.$ext;
							$cad_foto = "INSERT INTO aluno_doc () VALUES ('$idaluno', '$new', '$descricao', '$codigo')";
							//echo $destino." - ".$novo;
							$upload = ftp_put($ftp_conecta, $destino, $arquivo['tmp_name'], FTP_BINARY);
							$renomeia = ftp_rename($ftp_conecta, $destino, $novo);
							
					
							ftp_close($ftp_conecta);
							$cadimg = write($cad_foto);
							$pagina = "<script>alert('Upload concluido.'); location.href='aluno_perfil.php?id=$idaluno'</script>";
						}else{
							echo "<script>alert('Erro no Upload'); history.go(-1);</script>";
						}
					}
					//direciona pagina
					echo $pagina;
					
			}
		}
	}
}
?>