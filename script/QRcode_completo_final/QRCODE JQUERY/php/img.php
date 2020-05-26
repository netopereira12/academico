<?php
	$qrcode = $_POST['campo'];
	include('phpqrcode.php');
    QRcode::png($qrcode, '../img_php/'.$qrcode.'_qrcode.png');
	?>
