<?php
//Cripitografia
function codic($txt){
	//chave
	$chave = "RxRe4g50fxD33dx049xrg432pp03";
	//cripitografa
	$encriptado = mcrypt_encrypt(MCRYPT_BLOWFISH, $chave, $txt, MCRYPT_MODE_ECB);
	//base64_encode
	$base64codic = base64_encode($encriptado);
	//retorna texto criptografado
	return $base64codic;
}
function decodic($txt){
	$chave = "RxRe4g50fxD33dx049xrg432pp03";
	//base64_decode
	$base64descodic = base64_decode($txt);
	//decriptado
	$decriptado = mcrypt_decrypt(MCRYPT_BLOWFISH, $chave, $base64descodic, MCRYPT_MODE_ECB);
	return trim($decriptado);
}

?>
