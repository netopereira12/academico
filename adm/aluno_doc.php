<?php
include("valida_login.php");
if (isset($_GET["id"])) {
	$id = anti_injection($_GET["id"]);
	if($id!=""){
		$qd = read("Select * from s_doc order by doc");
		sleep(1);
		$return = "<h4>Documento Pendentes</h4>
	    <form method=\"get\" action=\"aluno_doc_cad.php\" name=\"cad_doc\">
    	<input type=\"hidden\" name=\"idaluno\" value=\"$id\" />
	    <select name=\"iddoc\">";
		while($respd = read_list($qd)){
			$return.="<option value='".$respd["id"]."'>".htmlentities($respd["doc"],0,"iso-8859-1")."</option>";
		}
		$return.= "</select>
	    <br />
    	<input type=\"submit\" name=\"enviar\" value=\"Cadastrar\" class=\"botao\"/>
	    </form>";
		$sql = read("Select d.id, d.doc FROM aluno_doc_p as a, s_doc as d WHERE a.doc=d.id and a.aluno='$id'");
		if(read_num_line($sql)>0){
			$return.= "<ul>";
			while($re=read_list($sql)){
				$return.= "<li class='doc'>".htmlentities($re["doc"],0,"iso-8859-1")."<a href='aluno_doc_del.php?idaluno=$id&iddoc=".$re["id"]."'>
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