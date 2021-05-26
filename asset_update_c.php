<?php 
include('db_conn.php');

$data = json_decode( $_POST["json"], true );

$as_id = $data['as_id'];
$as_name = $data['as_name'];
$as_detail = $data['as_detail'];
$price = $data['price'];
$actual = $data['actual'];
$scrap = $data['scrap'];
$cate = $data['cate'];
$date_start = $data['date_start'];
$date_end = $data['date_end'];




$response = [];


        //บันทึกข้อมูลเพื่อจัดเก็บรอบหลัก
        $stmt = $conn->prepare("UPDATE assets SET as_name = :as_name, as_detail = :as_detail,price = :price, actual = :actual, scrap = :scrap,
        cate = :cate, date_start = :date_start, date_end = :date_end
        WHERE as_id = $as_id"); 
        $stmt->execute([":as_name" => $as_name, ":as_detail" => $as_detail, ":price" => $price , ":actual" => $actual, ":scrap" => $scrap, ":cate" => $cate, ":date_start" => $date_start,":date_end" => $date_end]);

        $response["message"] = "แก้ไขข้อมูลเรียบร้อยแล้ว";
        $response["success"] = 1;



exit(json_encode( $response ));
?>