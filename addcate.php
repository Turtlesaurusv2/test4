<?php 
include('db_conn.php');

$data = json_decode( $_POST["json"], true );

$name = $data['name'];


$response = [];


        //บันทึกข้อมูลเพื่อจัดเก็บรอบหลัก
        $stmt = $conn->prepare("INSERT INTO category SET name = :name"); 
        $stmt->execute([":name" => $name]);

        $response["message"] = "บันทึกข้อมูลเรียบร้อยแล้ว";
        $response["success"] = 1;



exit(json_encode( $response ));
?>