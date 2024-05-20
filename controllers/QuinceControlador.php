<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS"){
    die();
}

class QuinceControlador
{
    public function index()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $salida = (object) [ 
                "name" => "DuaLipa",
                "gender" => "FeMale",
                "age" => 28,
                "email" => "dualipa@mimadre.com",
                "phone" => "123-456",
                "address" => (object) [
                    "street" => "Calle 123",
                    "number" => 123,
                    "city" => "Bogotá",
                    "country" => "Colombia"
                ],
                "descrip" => "cantante de usa top"
            ];

            $salida = json_encode($salida);
            echo $salida;
        } else {
            throw new Exception ('Debe solicitar este servicio por GET',400);
        }
    }
    //Pepito
    public function pepito($id){
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $tamanio = 'pequenio';
        $status = "Se asusta";
        if ($id == "die") {
            $tamanio = 'grande';
            $status = "Se muere y llega el CTI";
        }
        $history = (object) [
            "tamanio" => $tamanio,
            "status" => $status
        ];

        echo json_encode($history);
    } else {
        throw new Exception('Debe solicitar este servicio por POST',400);
    }
    }
    
}