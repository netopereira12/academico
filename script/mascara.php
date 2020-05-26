<?php
function RA($val, $zero){
	$i = strlen($val);
	$resp = "";
	if($i==$zero){
		return $val;
	}else{
		$limite = $zero - $i;
		for($x = 1; $x<$limite; $x++){
			$resp = "0".$resp;
		}
		return $resp.$val;
	}
}


function mask_ra($val, $mask)
{
$val = RA($val,13);
 $maskared = '';
 $k = 0;
 for($i = 0; $i<=strlen($mask)-1; $i++)
 {
 if($mask[$i] == '#')
 {
 if(isset($val[$k]))
 $maskared .= $val[$k++];
 }
 else
 {
 if(isset($mask[$i]))
 $maskared .= $mask[$i];
 }
 }
 return $maskared;
}

function mascara($mascara,$string)
{
   $string = str_replace(" ","",$string);
   for($i=0;$i<strlen($string);$i++)
   {
      $mascara[strpos($mascara,"#")] = $string[$i];
   }
   return $mascara;
}
?>