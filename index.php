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


    <div align="left">
        <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"
            class="btn btn-warning">เพิ่มสินทรัพย์</button>
    </div>
    <div class="w3-container">

        <br>
        <table style="padding-top:10px">
            <thead>
                <tr>
                    <th>ชื่อสินทรัพย์</th>
                    <th>ราคาทุน</th>
                    <th>ราคาที่ยกมา</th>
                    <th>ค่าซาก</th>
                    <th>หมวดหมู่</th>
                    <th>วันที่เริ่ม</th>
                    <th>วันที่สิ้นสุด</th>
                    <th>จำนวนวัน</th>
                    <th>ข้อมูล</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
                </thesd>
            <tbody id="result"></tbody>
        </table>
        </tr>

    </div>
    </div>

    <div class="container" style="width:700px;">
        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">เพิ่มสินทรัพย์</h4>
                    </div>
                    <div class="modal-body">
                        <div method="post">
                            <label>ชื่อสินทรัพย์</label>
                            <input type="text" name="as_name" id="as_name" class="form-control" />
                            <br />
                            <label>รายละเอียด</label>
                            <input type="text" name="as_detail" id="as_detail" class="form-control" />
                            <br />
                            <label>ราคาทุนของสินทรัพย์</label>
                            <input type="number" name="price" id="price" class="form-control" />
                            <br />
                            <label>ราคาสินทรัพย์ที่ยกมา</label>
                            <input type="number" name="actual" id="actual" class="form-control" />
                            <br />
                            <label>ค่าซาก</label>
                            <input type="text" name="scrap" id="scrap" class="form-control" value="1" placeholder="1"
                                disabled="disabled" />
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
                            <input type="date" name="date_start" id="date_start" class="form-control" />
                            <br />
                            <label>จนถึง</label>
                            <input type="date" name="date_end" id="date_end" class="form-control" />
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








</body>

<script>
function send() {

    //ประกาศตัวแปร
    var as_name = $("#as_name").val();
    var as_detail = $("#as_detail").val();
    var price = $("#price").val();
    var actual = $("#actual").val();
    var scrap = $("#scrap").val();
    var cate = $("#cate").val();
    var date_start = $("#date_start").val();
    var date_end = $("#date_end").val();


    var temp = {};
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
        url: "add_asset.php",
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
            url: "load_assets.php",
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


                    html += `<tr>` +
                        `<td>` + ele.as_name + `</td>` +
                        `<td>` + ele.price + `</td>` +
                        `<td>` + ele.actual + `</td>` +
                        `<td>` + ele.scrap + `</td>` +
                        `<td>` + ele.cate + `</td>` +
                        `<td>` + ele.date_start + `</td>` +
                        `<td>` + ele.date_end + `</td>` +
                        `<td>` + ele.diff + `</td>` + `
                        <td><button onclick='load_info(` + ele.as_id + `);'
                         class='butt w3-blue'  name='id' id='id' >ข้อมูลเพิ่ม
                        </button></td>` +
                        `<td><button onclick='update(` + ele.as_id + `);'
                         class='butt w3-green'  name='id1' id='id1'>แก้ไข
                        </button></td>` +
                        `<td><button onclick='del(` + ele.as_id + `);'
                         class='butt w3-red'  name='id1' id='id1'>ลบ
                        </button></td>` +
                        `<tr>`
                });

                $("#result").html(html);
                // load button

            }

        });

    }





});

function del(as_id) {

    //ประกาศตัวแปร
    var as_id = as_id;


    var temp = {};
    temp["as_id"] = as_id;


    //ประกาศตัวแปรjsonเพื่อเก็บข้อมูลจากtemp
    var json = JSON.stringify(temp);

    $.ajax({
        url: "del_assets.php",
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




function load_info(as_id) {


    var x = "load_info.php?id=" + as_id;


    window.location.href = x;

}

function update(as_id) {

    var as_id = as_id;

    var x = "asset_update.php?id=" + as_id;

    window.location.href = x;


}
</script>

</html>