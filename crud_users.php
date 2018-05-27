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
$user = json_decode($content, true);

$action = $user['cmd'];
$user_id = $user['user_id'];
$email = $user['email'];
$password = $user['password'];
$title_name = $user['title'];
$firstname = $user['fname'];
$lastname = $user['lname'];
$number_phone = $user['phone'];

/*
$action = $_GET['cmd'];
$user_id = $_GET['user_id'];
$email = $_GET['email'];
$password = $_GET['password'];
$title_name = $_GET['title'];
$firstname = $_GET['fname'];
$lastname = $_GET['lname'];
$number_phone = $_GET['phone'];
*/

switch ($action){


    case "login" :
    $sql_chk = " SELECT count(email) as num_rows FROM user WHERE email = '".$email."' AND password = '".$password."'";
    $stmt_num_row = $strExe->numRow($sql_chk);
    if ($stmt_num_row > 0 ) {
        $sql = " SELECT * FROM user WHERE email = '".$email."' AND  password = '".$password."' ";
        $stmt = $strExe->populateData($sql);
        $row_count = $strExe->rowCount("user");
        $usersArray = array();
        if($row_count >0) {
            foreach($stmt as $row){
                $usersArray[] = $row;
            }
        }  
        echo json_encode(['status' => 'ok','message' => 'เข้าสู่ระบบเรียบร้อย']);
    
    } 
    else {
        echo json_encode(['status' => 'no','message' => 'เข้าสู่ระบบผิดพลาด']);
    }    
    break;


    case "insert" :
    $sql_chk_email = " SELECT count(email) as num_rows FROM user WHERE email = '".$email."' ";
    $stmt_num_row = $strExe->numRow($sql_chk_email);
    if ($stmt_num_row > 0 ) {
        echo json_encode(['status' => 'no','message' => 'มีอีเมล์นี้ในระบบแล้ว!!!']);
    } 
    else {
        $sql = " INSERT INTO user (email, password,title_name,firstname,lastname,number_phone,status) 
                VALUES ('".$email."', '".$password."','".$title_name."','".$firstname."','".$lastname."','".$number_phone."','2') ";
        $stmt = $strExe->dataTransection($sql);
        if ($stmt == 1) {
            echo json_encode(['status' => 'ok','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว']);
        } else {
            echo json_encode(['status' => 'error','message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
        }
    }    
    break;

    case "delete" :
        $sql = " DELETE FROM user WHERE user_id = '".$user_id."' ";
        $stmt = $strExe->dataTransection($sql);
        if ($stmt == 1) {
            echo json_encode(['status' => 'ok','message' => 'ลบข้อมูลเรียบร้อยเเล้ว']);
        } else {
            echo json_encode(['status' => 'error','message' => 'เกิดข้อผิดพลาดในการลบข้อมูล']);
        }
    break;

    case "select" :
        $sql = " SELECT user.user_id,user.email,user.password,title.title_name,user.firstname,user.lastname,user.number_phone,user_type.status_name FROM `user` LEFT JOIN title ON title.title_id = user.title_name LEFT JOIN user_type ON user_type.status_id = user.status ";
        $stmt = $strExe->populateData($sql);
        $row_count = $strExe->rowCount("user");
        $usersArray = array();
        if($row_count >0) {
            foreach($stmt as $row){
                $usersArray[] = $row;
            }
        }
        echo json_encode($usersArray);
    break;

    case "selectUser" :
    $sql = " SELECT * FROM user WHERE email = '".$email."' ";
    $stmt = $strExe->populateData($sql);
    $row_count = $strExe->rowCount("user");
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