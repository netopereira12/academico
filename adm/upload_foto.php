<?php
include("valida_login.php");
//configurações
$tammax = 5242880; // 5MB
$extencao = array('.jpg','.jpeg','.gif','.png','.bmp');
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
					if($codigo==1){
						$destino = $ftp_logo."/".$arquivo['name'];
						$novo = $ftp_logo."/".$nome.$ext;
						$cad_foto = "UPDATE s_ue SET logo='$new' WHERE id='1' ";
						$pagina = "<script>alert('Upload concluido.'); location.href='conf_ue.php'</script>";
						$cadimg = read("Select logo FROM s_ue WHERE logo!='default.png'");
						if(read_num_line($cadimg)==1){
							$resp = read_list($cadimg);
							$del  = "log/".$resp["logo"];
							$deleta = ftp_delete($ftp_conecta,$del);
						}
					}else{
						if($codigo==2){
							$idaluno = $_POST["idaluno"];
							$destino = $ftp_aluno."/".$arquivo['name'];
							$novo = $ftp_aluno."/".$nome.$ext;
							$cad_foto = "INSERT INTO aluno_foto () VALUES ('$idaluno', '$nome$ext')";
							$cadimg = read("Select  foto FROM aluno_foto WHERE aluno='$idaluno'");
							$pagina = "<script>alert('Upload concluido.'); location.href='aluno_perfil.php?id=$idaluno'</script>";
							if(read_num_line($cadimg)==1){
								$resp = read_list($cadimg);
								$del  = "alu/".$resp["foto"];
								$deleta = ftp_delete($ftp_conecta,$del);
							}
						}else{
							//inserção de foto usuario
							$idaluno = decodic($_POST["idaluno"]);
							$destino = $ftp_aluno."/".$arquivo['name'];
							$novo = $ftp_aluno."/".$nome.$ext;
							$cad_foto = "UPDATE s_usuario SET foto='$new' WHERE mail='$idaluno' ";
							$cadimg = read("Select foto FROM s_usuario WHERE mail='$idaluno'");
							$idaluno=codic($idaluno);
							$pagina = "<script>alert('Upload concluido.'); location.href='profile.php?login=$idaluno'</script>";
							if(read_num_line($cadimg)==1){
                            	$resp = read_list($cadimg);
								if($resp["foto"]!="default.png"){
									$del  = "alu/".$resp["foto"];
									//echo $del;
									$deleta = ftp_delete($ftp_conecta,$del);
								}
							}
					}
				}
				//echo $destino." - ".$novo;
				$upload = ftp_put($ftp_conecta, $destino, $arquivo['tmp_name'], FTP_BINARY);
				$renomeia = ftp_rename($ftp_conecta, $destino, $novo);
						
					
					ftp_close($ftp_conecta);
					$cadimg = erase("DELETE FROM aluno_foto WHERE aluno='$idaluno' ");
					$cadimg = write($cad_foto);
				}
				//direciona pagina
				echo $pagina;
				
		}
	}
}
?>