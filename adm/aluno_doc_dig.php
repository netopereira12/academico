<?php
include("valida_login.php");
if (isset($_GET["id"])) {
	$id = anti_injection($_GET["id"]);
	if($id!=""){
		$return = "<h4>Documentos Digitalizados</h4>
    <form method='post' action='upload_arquivo.php' name='upload' enctype='multipart/form-data'>
    <input type='file' name='arquivo' />
	<br>
	<strong>Descrição</strong>
	<input type='text' name='descricao' size='30'/>
    <input type='hidden' name='tipo' value='1' />
    <input type='hidden' name='idaluno' value='$id'/>
    <br />
    <input type='submit' name='enviar' value='Enviar' class='botao'/>
    </form>
";
		$sql = read("Select * FROM aluno_doc WHERE aluno='$id' and tipo='1' order by descricao");
		if(read_num_line($sql)>0){
			$return.= "<ul>";
			while($re=read_list($sql)){
				$return.= "<li class='doc'><a href='../foto/doc/".$re["doc"]."'>".htmlentities($re["descricao"],0,"iso-8859-1")."</a><a href='aluno_doc_dig_del.php?idaluno=$id&iddoc=".$re["doc"]."' onclick=\"return confirm('Deseja mesmo deletar esse documento?')\">
				<img src='img/delete.png' alt='Excluir documento' title='Excluir documento' width='30px' valign='middle' border='0'>
				</a></li>";
			}
			$return.= "</ul>";
		}else{
			$return.= "<h4>Não há registro de documentos</h4>";	
		}
		echo $return;
	}else{
		echo "<h4>Não há registro de documentos</h4>";
	}
}else{
	echo "<h4>Não há registro de documentos</h4>";
}
?>