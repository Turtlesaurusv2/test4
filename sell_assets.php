<?php 
include('db_conn.php');

$data = json_decode( $_POST["json"], true );

$as_id = $data['as_id'];




$response = [];


        //บันทึกข้อมูลเพื่อจัดเก็บรอบหลัก
        $stmt = $conn->prepare("INSERT INTO sell_assets(as_name,as_detail, price, actual, scrap,cate, date_start, date_end) 
        SELECT  as_name,as_detail, price, actual, scrap,cate, date_start, date_end FROM assets 
        WHERE as_id = $as_id
        "); 
        $stmt->execute();

        $response["message"] = "ขายสินค้าเรียบร้อย";
        $response["success"] = 1;


        if($stmt){

            $stmt1 = $conn->prepare("DELETE FROM assets
            WHERE as_id = $as_id
            "); 
            $stmt1->execute();



        };



exit(json_encode( $response ));
?>