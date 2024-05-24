<?php

	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$uri = explode( '/', $uri );
	
	if ($uri[5] == "usuario"){
		if (!isset($uri[6])){
			$mbd = new PDO('mysql:host=localhost;dbname=cine', 'root', '');
			$usuarios = $mbd->query('SELECT * FROM usuarios');
			$array = $usuarios->fetchAll(PDO::FETCH_ASSOC);
			respuesta(200, "OK", $array);
		}else{
			$mbd = new PDO('mysql:host=localhost;dbname=cine', 'root', '');
			$usuarios = $mbd->query('SELECT * FROM usuarios WHERE id='.$uri[6]);
			$array = $usuarios->fetch(PDO::FETCH_ASSOC);
			respuesta(200, "OK", $array);	
		}		
	}
	
	
    function respuesta($estado, $mensaje_estado, $datos){
		
		header("Content-Type:application/json");
        header("HTTP/1.1 $estado $mensaje_estado");
        $respuesta['estado'] = $estado;
        $respuesta['mensaje_estado'] = $mensaje_estado;
        $respuesta['datos'] = $datos;
        $respuesta_json = json_encode($respuesta);
        echo $respuesta_json;
		
    }
  
?>