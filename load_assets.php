<?php
include('db_conn.php');

$data = json_decode( $_POST["query"], true );



//select  ข้อมูลรอบหลัก เพื่อเอาไปแสดงผล
$results = $conn->prepare("SELECT as_id,as_name, price, actual, scrap, cate, date_start, date_end, (date_end - date_start) as diff FROM assets 
WHERE date_end > CURDATE()
");
$results->execute();

$res["result"] = $results->fetchAll(PDO::FETCH_ASSOC);

exit( json_encode( $res ) );



?>