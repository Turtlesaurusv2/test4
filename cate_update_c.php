<?php 
include('db_conn.php');

$data = json_decode( $_POST["json"], true );

$name = $data['name'];
$cate_id = $data['cate_id'];


$response = [];


        //บันทึกข้อมูลเพื่อจัดเก็บรอบหลัก
        $stmt = $conn->prepare("UPDATE category set name = :name WHERE cate_id = $cate_id"); 
        $stmt->execute([":name" => $name]);

        $response["message"] = "แก้ไขข้อมูลเรียบร้อยแล้ว";
        $response["success"] = 1;



exit(json_encode( $response ));
?>