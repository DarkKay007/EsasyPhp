<?php
class ModifyQueriesController {
    public $name = "https://pokeapi.co/api/v2/pokemon/";

    public function index() {
        $queries = $_GET;
        $top = isset($queries['limit']) ? $queries['limit'] : 1;
        $pagina = isset($queries['offset']) ? $queries['offset'] : 1;

        $url = "https://pokeapi.co/api/v2/pokemon?limit=" . (string) $top . "&offset=" . (string) $pagina;
        $salida  = file_get_contents($url);

        $ending = (object) json_decode($salida);
        $contenido = [];

        foreach ($ending->results as $key => $value){
            $contenido[$key] = (object) [
                "url" => "/easyapiphp/views/pokemon.html?Pokemon=" . $value->name,
                "name" => $value->name
            ];  
        }
        echo json_encode($contenido);
    }

    public function only(){
        $queries = $_GET;
        $name = isset($queries['name']) ? $queries['name'] : "";

        $url = $this->name . $name;
        $salida  = file_get_contents($url);
        $ending = json_decode($salida);
        
        $ab = []; 
        $mov = []; 
        $ty = [];
        

        foreach ($ending->abilities as $key => $value){
            $ab[$key] = (object) [
                'id' => (int) $key +1,
                'ability' => $value->ability->name
            ];
        }
        foreach ($ending->moves as $key => $value){
            $mov[$key] = (object) [
                'id' => (int) $key +1,
                'move' => $value->move->name
            ];
        }
        foreach ($ending->types as $key => $value){
            $ty[$key] = (object) [
                'id' => (int) $key +1,
                'type' => $value->type->name
            ];
        }
        $finalInfo = (object) [
            'id' => $ending->id,
            'name' => $ending->name,
            'sprite' => $ending->sprites->front_shiny,
            'abilities' => $ab,
            'moves' => $mov,
            'types' => $ty,
        ];
        echo json_encode($finalInfo);
    }
}
?>
