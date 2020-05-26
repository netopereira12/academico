<?php
function validaData($data, $formato, $limite) {
	$data = explode($limite, $data);
    if($formato=="aaaammdd"){
    	if(is_numeric($data[0]) and strlen($data[0])==4){
			if(is_numeric($data[1]) and strlen($data[1])<=2 and strlen($data[1])>0){
				if(is_numeric($data[2]) and strlen($data[2])<=2 and strlen($data[2])>0){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
   	}
}
function conf_zeroesq($dia){
	if($dia<10 and strlen($dia)==1){
		return "0".$dia;
	}else{
		return $dia;
	}
}
?>