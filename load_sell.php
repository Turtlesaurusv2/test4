<?php
include('db_conn.php');

$data = json_decode( $_POST["query"], true );


//select  ข้อมูลรอบหลัก เพื่อเอาไปแสดงผล
$results = $conn->prepare("SELECT * FROM sell_assets ");
$results->execute();

$res["result"] = $results->fetchAll(PDO::FETCH_ASSOC);

exit( json_encode( $res ) );



?>