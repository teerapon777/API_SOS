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
$task = json_decode($content, true);

$action = $task['cmd'];
$acknowledge_id = $task['id'];
$emergency_id = $task['emer_id'];
$detail = $task['detail'];
$user_id = $task['user_id'];
/*
$action = $_GET['cmd'];
$acknowledge_id = $_GET['id'];
$emergency_id = $_GET['emer_id'];
$detail = $_GET['detail'];
$user_id = $_GET['user_id'];*/

switch ($action){
    case "insert" :
        $sql = "INSERT INTO `task_history` (`acknowledge_id`, `emergency_id`, `user_id`, `date`, `detail`) 
        VALUES (NULL, '".$emergency_id."', '".$user_id."', NOW(), '".$detail."'); ";
        $sql_up = " UPDATE `emergency` SET `status`= 2 WHERE emergency_id = '".$emergency_id."' ";
        $stmt_up = $strExe->dataTransection($sql_up);
        $stmt = $strExe->dataTransection($sql);
        if ($stmt == 1) {
            echo json_encode(['status' => 'ok','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว']);
        } else {
            echo json_encode(['status' => 'error','message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    break;

    case "select" :
        $sql = " SELECT emergency.emergency_name,user.firstname,user.lastname,task_history.date,task_history.detail FROM `task_history` LEFT JOIN emergency ON emergency.emergency_id = task_history.emergency_id LEFT JOIN user ON user.user_id = task_history.user_id ";
        $stmt = $strExe->populateData($sql);
        $row_count = $strExe->rowCount("task_history");
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