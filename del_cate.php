<?php 
include('db_conn.php');

$data = json_decode( $_POST["json"], true );

$cate_id = $data['cate_id'];


$response = [];


        //บันทึกข้อมูลเพื่อจัดเก็บรอบหลัก
        $stmt = $conn->prepare("DELETE FROM category WHERE cate_id = $cate_id"); 
        $stmt->execute();

        $response["message"] = "ลบข้อมูลเรียบร้อยแล้ว";
        $response["success"] = 1;



exit(json_encode( $response ));
?>