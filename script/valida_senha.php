<?php
function valida_senha($s, $c){
	if($s!=$c){
		return false;
	}else{
		$t = strlen($s);
		if($t>=6 and $t<=12){
			return true;
		}else{
			return false;
		}
	}
}
?>