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

$cate_id = $_GET["id"];

$results = $conn->prepare("SELECT * FROM category WHERE cate_id = $cate_id ");
$results->execute();

$row = $results->fetch(PDO::FETCH_ASSOC);

echo $row["name"];


echo $cate_id;
?>
    

<div class="w3-center">
  <label for="fname">name:</label>
  <input type="text" id="name" name="name" value="<?= $row["name"] ?>"><br>
  <br>
  <input type="hidden" name="cate_id" id="cate_id"  value="<?= $row["cate_id"] ?>" />

  <input onclick="send();" type="submit" name="send" id="send" value="update"
  class="btn btn-success" />

</div> 
</body>

<script>

function send() {

//ประกาศตัวแปร
var name = $("#name").val();
var cate_id = $("#cate_id").val();


var temp = {};
temp["name"] = name;
temp["cate_id"] = cate_id;


//ประกาศตัวแปรjsonเพื่อเก็บข้อมูลจากtemp
var json = JSON.stringify(temp);

$.ajax({
    url: "cate_update_c.php",
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

        var x = "category.php?";
        window.location.href = x;
    }

});
}

</script>


</html>