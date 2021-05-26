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
    <title>test4</title>
</head>
<body>
<?php 
include('navbar.php'); 
include('db_conn.php');

$as_id = $_GET["id"];

$results = $conn->prepare("SELECT * FROM assets WHERE as_id = $as_id ");
$results->execute();

$row1 = $results->fetch(PDO::FETCH_ASSOC);




echo $as_id;
?>
    

<div class="w3-center">
<div class="modal-body">
                        <div method="post">
                            <input type="hidden" name="as_id" id="as_id" value="<?= $row1["as_id"] ?>" class="form-control" />
                            <label>ชื่อสินทรัพย์</label>
                            <input type="text" name="as_name" id="as_name" value="<?= $row1["as_name"] ?>" class="form-control" />
                            <br />
                            <label>รายละเอียด</label>
                            <input type="text" name="as_detail" id="as_detail" value="<?= $row1["as_detail"] ?>" class="form-control" />
                            <br />
                            <label>ราคาทุนของสินทรัพย์</label>
                            <input type="number" name="price" id="price" value="<?= $row1["price"] ?>" class="form-control" />
                            <br />
                            <label>ราคาสินทรัพย์ที่ยกมา</label>
                            <input type="number" name="actual" id="actual" value="<?= $row1["actual"] ?>" class="form-control" />
                            <br />
                            <label>ค่าซาก</label>
                            <input type="text" name="scrap" id="scrap" class="form-control" value="1" placeholder="1" disabled="disabled" />
                            <br />
                            <label>หมาดหมู่</label>
                            <select name="cate" id="cate" class="form-control">
                                <?php
                                 include('db_conn.php');
                                 $stmt = $conn->prepare("SELECT name FROM category");
                                 $stmt->execute();
                                 $num_rows = 0;
                                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                <option value="<?= $row["name"] ?>"><?= $row["name"]; ?></option>
                                <?php } ?>
                            </select>
                            <br />
                            <label>กำหนดวันที่ตั้งแต่</label>
                            <input type="date" name="date_start" id="date_start" value="<?= $row1["date_start"] ?>" class="form-control" />
                            <br />
                            <label>จนถึง</label>
                            <input type="date" name="date_end" id="date_end" value="<?= $row1["date_end"] ?>" class="form-control" />
                            <br />

                            <input onclick="send();" type="submit" name="send" id="send" value="update"
                                class="btn btn-success" />
                        </div>
                    </div>


</div> 
</body>

<script>

function send() {

    //ประกาศตัวแปร
    var as_id = $("#as_id").val();
    var as_name = $("#as_name").val();
    var as_detail = $("#as_detail").val();
    var price = $("#price").val();
    var actual = $("#actual").val();
    var scrap = $("#scrap").val();
    var cate = $("#cate").val();
    var date_start = $("#date_start").val();
    var date_end = $("#date_end").val();


    var temp = {};
    temp["as_id"] = as_id;
    temp["as_name"] = as_name;
    temp["as_detail"] = as_detail;
    temp["price"] = price;
    temp["actual"] = actual;
    temp["scrap"] = scrap;
    temp["cate"] = cate;
    temp["date_start"] = date_start;
    temp["date_end"] = date_end;


//ประกาศตัวแปรjsonเพื่อเก็บข้อมูลจากtemp
var json = JSON.stringify(temp);

$.ajax({
    url: "asset_update_c.php",
    method: "POST",
    data: {
        "json": json
    },
    dataType: "json",
    success: function(response) {

        if (response.success == 1) {
            alert(response.message);
            
        } else {
            alert(response.message);

        }

        var x = "index.php?";
        window.location.href = x;
    }

});
}

</script>


</html>