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
$emer = json_decode($content, true);

$action = $emer['cmd'];
$emergency_id = $emer['id'];
$emergency_name = $emer['name'];
$emergency_category = $emer['category'];
$emergency_detail = $emer['detail'];
$emergency_location = $emer['location'];
$user_id = $emer['user_id'];
/*
$action = $_GET['cmd'];
$emergency_id = $_GET['id'];
$emergency_name = $_GET['name'];
$emergency_category = $_GET['category'];
$emergency_detail = $_GET['detail'];
$emergency_location = $_GET['location'];
$user_id = $_GET['user_id'];*/

switch ($action){
    case "insert" :
        $sql = " INSERT INTO `emergency` (`emergency_name`, `emergency_category`, `emergency_detail`, `emergency_date`, `emergency_location`, `user_id`, `status`) 
        VALUES ('".$emergency_name."','".$emergency_category."','".$emergency_detail."',NOW(),'".$emergency_location."','".$user_id."','0')";
        $stmt = $strExe->dataTransection($sql);
        if ($stmt == 1) {
            echo json_encode(['status' => 'ok','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว']);
        } else {
            echo json_encode(['status' => 'error','message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    break;

    case "update" :
        $sql = " UPDATE `emergency` SET `status`= 1 WHERE emergency_id = '".$emergency_id."' ";
        $stmt = $strExe->dataTransection($sql);
        if ($stmt == 1) {
            echo json_encode(['status' => 'ok','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว']);
        } else {
            echo json_encode(['status' => 'error','message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    break;

    case "select" :
        $sql = " SELECT emergency.emergency_id,emergency.emergency_name,category.category_name,emergency.emergency_detail,emergency.emergency_date,emergency.emergency_location,status_emergency.status_name FROM emergency LEFT JOIN category ON category.category_id = emergency.emergency_category LEFT JOIN status_emergency ON status_emergency.status_id = emergency.status ORDER BY `emergency`.`emergency_id` DESC";
        $stmt = $strExe->populateData($sql);
        $row_count = $strExe->rowCount("emergency");
        $usersArray = array();
        if($row_count >0) {
            foreach($stmt as $row){
                $usersArray[] = $row;
            }
        }
        echo json_encode($usersArray);
    break;

    case "selectAll" :
        $sql = "SELECT emergency.emergency_id,emergency.emergency_name,category.category_name,emergency.user_id,emergency.emergency_detail,emergency.emergency_date,emergency.emergency_location,status_emergency.status_name FROM emergency LEFT JOIN category ON category.category_id = emergency.emergency_category LEFT JOIN status_emergency ON status_emergency.status_id = emergency.status  WHERE status_emergency.status_id = 0 ORDER BY `emergency`.`emergency_id` DESC";
        $stmt = $strExe->populateData($sql);
        $row_count = $strExe->rowCount("emergency");
        $usersArray = array();
        if($row_count >0) {
            foreach($stmt as $row){
                $usersArray[] = $row;
            }
        }
        echo json_encode($usersArray);
    break;
    
    case "selectAll_his" :
        $sql = " SELECT emergency.emergency_id,emergency.emergency_name,category.category_name,emergency.user_id,emergency.emergency_detail,emergency.emergency_date,emergency.emergency_location,status_emergency.status_name FROM emergency LEFT JOIN category ON category.category_id = emergency.emergency_category LEFT JOIN status_emergency ON status_emergency.status_id = emergency.status LEFT JOIN user ON user.user_id = emergency.user_id WHERE status_emergency.status_id = 1 ORDER BY `emergency`.`emergency_id` DESC ";
        $stmt = $strExe->populateData($sql);
        $row_count = $strExe->rowCount("emergency");
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