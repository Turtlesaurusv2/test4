<!DOCTYPE html>
<html lang="en">
<head>
<style>

div {

margin: auto;
}

table {
margin: auto;
width: 100%;
height: 100%;
}

.butt {
width: 100%;
height: 100%;
}

.ss {
text-align: left;
padding: 8px;
width: 300px;
}

th,
td {
text-align: left;
padding: 8px;
height: 50px;
border: 1px solid;
}

.sf {
text-align: left;
padding: 8px;
width: 300px;
}

tr:nth-child(even) {
background-color: white;
}
</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Document</title>
</head>
<body>
<?php 
include('navbar.php'); 
include('db_conn.php');

$as_id = $_GET["id"];

$DateResultNow=date("Y-m-d");
date("d")+0 ;// วัน
date("m")+0; // เดือน
date("Y")+0 ;// ปี



//select  ข้อมูลรอบหลัก เพื่อเอาไปแสดงผล
$results = $conn->prepare("SELECT as_id,as_name, price, actual, scrap, cate, date_start, date_end, (date_end - date_start) as diff FROM assets WHERE as_id = $as_id ");
$results->execute();
$row = $results->fetch(PDO::FETCH_ASSOC);


$scraptotal = ($row["actual"] - 1) / $row["diff"];

$current = $row["actual"] - $scraptotal;


//สร้าง temporary tableเพื่อเอาใว้เก็บข้อมูลชั่วคราว
$result1 = $conn->prepare("CREATE TEMPORARY TABLE Temp_assets(
    date_now date,
    date_end date,
    date_start date
    )
    ");
$result1->execute();


$date_end = $row["date_end"];
$date_start = $row["date_start"];


$stmt = $conn->prepare("INSERT INTO Temp_assets SET date_now = :date_now, date_end = :date_end, date_start = :date_start"); 
$stmt->execute([":date_now" => $DateResultNow,":date_end" => $date_end,"date_start" => $date_start]);


$result2 = $conn->prepare("SELECT (date_end - date_now) as as_left , (date_now - date_start) as as_lift FROM temp_assets");
$result2->execute();
$row1 = $result2->fetch(PDO::FETCH_ASSOC);





?>

<div class="w3-container">

<br>

<table style="padding-top:10px">
    <thead>
        <tr>
            <th>ชื่อสินทรัพย์</th>
            <th>ราคาทุน</th>
            <th>ราคาที่ยกมา</th>
            <th>ราคาปัจุบัน</th>
            <th>วันที่เริ่ม</th>
            <th>วันที่สิ้นสุด</th>
            <th>จำนวนวัน</th>
            <th>วันที่เหลีอ</th>
            <th>วันที่ใช้ไป</th>
            <th>ค่าเสื่อมสะสม</th>
        </tr>
        <tr>
        <td><?= $row["as_name"]; ?></td>
        <td><?= $row["price"]; ?></td>
        <td><?= $row["actual"]; ?></td>
        <td><?php echo $current; ?></td>
        <td><?= $row["date_start"]; ?></td>
        <td><?= $row["date_end"]; ?></td>
        <td><?= $row["diff"]; ?></td>
        <td><?= $row1["as_left"]; ?></td>
        <td><?= $row1["as_lift"]; ?></td>
        <td><?php echo $scraptotal; ?></td>
        </tr>
        </thesd>
</table>
<br>
<input class="w3-btn w3-blue w3-border w3-border-indigo w3-text-white w3-round-large" type="button" value=" ยกเลิก " onclick="window.location='index.php' " />

</div>

    
</body>
</html>