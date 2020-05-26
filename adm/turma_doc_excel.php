<?php 
include("valida_login.php");
if(isset($_GET["turma"])){
	$turma = anti_injection($_GET["turma"]);
	if($turma!=""){
		$arquivo = $turma.".xls";
		$html="";
		$q = read("Select * from s_ue WHERE id='1' ");
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		if(read_num_line($c)!=0){
			$vt = read_list($c);
			$ve = read_list($q);
			include("../script/mascara.php");
			$c = read("SELECT t.num, a.id, a.nome, a.ra, a.dg, sdoc.doc, t.situacao FROM aluno as a, turma_aluno as t, aluno_doc_p as doc, s_doc as sdoc WHERE t.turma='$turma' and t.aluno=a.id and a.id=doc.aluno and doc.doc=sdoc.id and t.situacao=0 order by t.num");
			$aluno ="";
				while($v = read_list($c)){
					if($aluno!=$v["id"]){
						$html.="
                        <br />
                        <hr />
						<table cellpadding='5' cellspacing='0' border='0' align='center' width='1600px'>
                        <tr>
                        <td align='center' colspan='8'>
                        <strong>".htmlentities($ve["nome"],0,"iso-8859-1")."</strong><br />
                        <strong>".htmlentities($ve["rua"],0,"iso-8859-1")."</strong>, 
                        <strong>".$ve["num"]."</strong> - 
                        <strong>".htmlentities($ve["cidade"],0,"iso-8859-1")."</strong>/
                        <strong>".$ve["uf"]."</strong> - 
                        <strong>CEP: ".$ve["cep"]."</strong><br />
                        <strong>Telefone: ".mascara("(##)-####-####", $ve["tel"])."</strong><br />
                        </td>
                        </tr>
                        </table>
						<h5 style='color: #000' align='center'>".$vt["serie"]."&ordf; ".$vt["turma"]." - Ensino ".htmlentities($vt["tensino"],0,"iso-8859-1")."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Per&iacute;odo: <font color='#".$vt["cor"]."'>".htmlentities($vt["tperiodo"],0,"iso-8859-1")."</font></h5>";
						$html.= "<p><strong>Aluno(a): &nbsp;&nbsp;&nbsp;</strong>".htmlentities($v["nome"],0,"iso-8859-1")." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>N&deg;:</strong> ".$v["num"]." &nbsp;&nbsp;&nbsp;<strong>R.A.: </strong>".mask_ra($v["ra"], "###.###.###.###")."-".$v["dg"]."</p>";
						$aluno=$v["id"];
						$html.= "<p><strong>Providenciar os seguintes documentos:</strong></p>";
						$html.= "<p><strong>Regularize a sua situa&ccedil;&atilde;o, pois a n&atilde;o apresenta&ccedil;&atilde;o da documenta&ccedil;&atilde;o prejudicar&aacute; a sua vida escola.</strong></p>";
						$html.= "<p>Campinas, ".date("d/m/Y")."</p><br>";
					}
					$html.= "<big><strong>&nbsp;&nbsp;&nbsp;&nbsp;".htmlentities($v["doc"],0,"iso-8859-1")."</strong></big><br>";
				}
		}
	
	
    //    $html.= "</table>";
        
        // Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );

		// Envia o conteúdo do arquivo
		echo $html;
		exit;
            
		}else{	
			$html= "Turma não localizada";
            echo $html;
		}
	}





?>