<?php 
require_once 'Database.php';

class DesafioDos {

    public static function retriveLotes(int $loteID):void {

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

DesafioDos::retriveLotes('00148');