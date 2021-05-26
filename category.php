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
<?php include('navbar.php'); ?>
    

<div class="container" style="width:700px;">
<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">เพิ่มหมวดหมู่</h4>
            </div>
            <div class="modal-body">
                <div method="post">
                    <label>ชื่อหมวดหมู่</label>
                    <input type="text" name="name" id="name" class="form-control" />
                    <br />

                    <input onclick="send();" type="submit" name="send" id="send" value="เพิ่มข้อมูล"
                        class="btn btn-success" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<br>
<div align="right">
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"
            class="btn btn-warning w3-blue">เพิ่มหมวดหมู่</button>
</div>





<div class="w3-container">

    <br>

    <table style="padding-top:10px">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อหมวดหมู่</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
            </thesd>
        <tbody id="result"></tbody>
    </table>


</div>

</div>


</body>

<script>
function send() {

//ประกาศตัวแปร
var name = $("#name").val();


var temp = {};
temp["name"] = name;


//ประกาศตัวแปรjsonเพื่อเก็บข้อมูลจากtemp
var json = JSON.stringify(temp);

$.ajax({
    url: "addcate.php",
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
        location.reload();
    }

});
}

$(document).ready(function() {

load_data();




function load_data(query = "") {



    //ประกาศตัวแปร object 
    var data = {};
    data["query"] = query;
    //ประกาศตัวแปรjson ช
    var query = JSON.stringify(data);

    $.ajax({
        url: "load_cate.php",
        method: "POST",
        async: false,
        data: {
            "query": query
        },
        dataType: "json",
        success: function(res) {

            var result = res.result;

            var html = "";
            result.forEach(ele => {

                html += "<tr>" +
                    "<td>" + ele.cate_id + "</td>" +
                    "<td>" + ele.name + "</td>" +
                    `<td><button onclick='update(` + ele.cate_id + `);'
                     class='butt w3-green'  name='up' id='up'>แก้ไข
                    </button></td>`+
                    `<td><button onclick='del(` + ele.cate_id + `);'
                     class='butt w3-red'  name='id' id='id'>ลบ
                    </button></td>`+
                    "<tr>"
            });

            $("#result").html(html);
            // load button

        }

    });

}



});


function del(cate_id) {

//ประกาศตัวแปร
var cate_id = cate_id;


var temp = {};
temp["cate_id"] = cate_id;


//ประกาศตัวแปรjsonเพื่อเก็บข้อมูลจากtemp
var json = JSON.stringify(temp);

$.ajax({
    url: "del_cate.php",
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
        location.reload();
    }

});
}

function update(cate_id) {
    
    var cate_id = cate_id;

    var x = "cate_update.php?id=" + cate_id;

    window.location.href = x;


}




</script>

</html>