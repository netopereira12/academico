<?php 
include("valida_login.php");
if(isset($_GET["turma"])){
	$turma = anti_injection($_GET["turma"]);
	if($turma!=""){
		$cue = read("Select nome, logo FROM s_ue WHERE id='1'");
		$c = read("SELECT te.cadastro AS tensino, tf.cadastro AS tperiodo, tf.cor, t .serie, t.turma, t.prodesp FROM turma AS t LEFT JOIN s_conf AS te ON te.id = t.tipo_ensino AND te.tipo =  'e' LEFT JOIN s_conf AS tf ON tf.id = t.periodo AND tf.tipo =  'p' WHERE t.id =  '$turma'");
		
		if(read_num_line($c)!=0){
			$vt = read_list($c);
			$vue = read_list($cue);
            include("../script/mascara.php");
			$html='<table cellpadding="10" cellspacing="0" border="0" width="100%">
			<tr><td align="center" colspan="5"><h2>'.htmlentities($vue["nome"],0,"iso-8859-1").'</h2></td></tr>
			<tr><td colspan="5">
				<hr><h5 style="color: #000" align="center">'.$vt["serie"].'&ordf; '.$vt["turma"].' - Ensino '.htmlentities($vt["tensino"],0,"iso-8859-1").'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Per&iacute;odo: <font color="#'.$vt["cor"].'">'.htmlentities($vt["tperiodo"],0,"iso-8859-1").'</font><br>C&oacute;digo Prodesp: '.mask_ra($vt["prodesp"],'###.###.###.###').'</h5>
			</td></tr>';
            /*
			* Criando e exportando planilhas do Excel
			* http://blog.thiagobelem.net/
			*/

			// Definimos o nome do arquivo que será exportado
			$arquivo = $turma.".xls";
            
            $c = read("SELECT s.cadastro, s.cor, t.num, a.id, a.nome, a.ra, a.dg, t.situacao, t.datafim FROM aluno as a, turma_aluno as t, s_conf as s WHERE t.turma='$turma' and t.aluno=a.id and s.id=t.situacao order by t.num");
		$html.= "<tr>
		<td align='center'><strong>N&deg;</strong></td>
		<td align='center' width='450px'><strong>Aluno</strong></td>
		<td align='center' width='120px'><strong>RA</strong></td>
		<td align='center'><strong>Situa&ccedil;&atilde;o</strong></td>
		<td align='center'><strong>Data Fim</strong></td>
		</tr>";
		while($v = read_list($c)){
			$html.= "<tr><td>".$v["num"]."</td>
			<td>".htmlentities($v["nome"],0,"iso-8859-1")."</td>
			<td>".mask_ra($v["ra"], "###.###.###.###")."-".$v["dg"]."</td>
			<td><b><font color='#".$v["cor"]."'>".htmlentities($v["cadastro"],0,"iso-8859-1")."</font></b></td>
			<td>".str_replace("-","/",date("d-m-Y", strtotime($v["datafim"])))."</td></tr>
			";
		}
        $html.= "</table>";
        
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
}




?>