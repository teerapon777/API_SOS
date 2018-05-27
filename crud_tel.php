<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

require_once("config/db.php");
require_once("cmd/exec.php");

$db = new Database();
$strConn = $db->getConnection();
$strExe = new ExecSQL($strConn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$content = file_get_contents('php://input');
$tel = json_decode($content, true);
$action = $tel['cmd'];


//$action = $_GET['cmd'];
                              


switch ($action){


    case "select" :
        $sql = " SELECT * FROM department_tel ";
        $stmt = $strExe->populateData($sql);
        $row_count = $strExe->rowCount("department_tel");
        $usersArray = array();
        if($row_count >0) {
            foreach($stmt as $row){
                $usersArray[] = $row;
            }
        }
        echo json_encode($usersArray);
    break;
    }
}
?>