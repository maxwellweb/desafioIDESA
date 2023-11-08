<?php

// Servicio de busqueda lote id basado en la estructura de los desafios. 

require_once 'Database.php'; 

class Service {
    public static function searchLotes(int $loteID):void {

        Database::setDB(); 

        echo(json_encode(self::getLotes($loteID)));
    }


    private static function getLotes (int $loteID){
        $lotes = [];
        $cnx = Database::getConnection();
        $stmt = $cnx->query("SELECT * FROM debts WHERE lote LIKE '%$loteID%' LIMIT 5");
        while($rows = $stmt->fetchArray(SQLITE3_ASSOC)){
            $lotes[] = (object) $rows;
        }
        return $lotes;
    }
}

// Comprueba si se ha proporcionado un ID de lote en la solicitud
if (isset($_GET['loteID'])) {
    $clientID = (int)$_GET['loteID'];

    // Llama al método searchLotes de la clase Service
    Service::searchLotes($clientID);
} else {
    // En caso de no proporcionar el ID del lote, devuelve un mensaje de error
    echo json_encode([
        "status" => false,
        "message" => "ID del lote no proporcionado"
    ]);
}