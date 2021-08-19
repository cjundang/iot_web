<?php
header('Access-Control-Allow-Origin: *');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">

        <div class="row">
            <div class="col-8">
                IP Addess <input type="text" id="ipaddress" value="192.168.0.156"/>
                <button id="btnLoad" class="btn btn-primary"> Start </button>
            </div>
        </div>

        <div class="row" >
            <div class="col-6" style="border: 1px solid;text-align:center; margin:30px ">
                <span style="font-size: 50pt" id="temperature"></span> <br/>
                <span id="lastupdate"></span>
            </div>
        </div>
        
    </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  </body>

<script>

    var temp_list = [];
    var idx = 0;
    var QLEN = 20;
  
    
    function loadData(){
        var ipaddress = $("#ipaddress").val();
        var url = "http://"+ipaddress;
        $.getJSON(url)
            .done(function(data){
                console.log(data);
                $("#temperature").text(data);
                temp_list[idx%QLEN] = data;
                idx++;
                console.log(temp_list);

                const d = new Date();
                const monthNames = ["January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"]
                let dateStr = d.getDate() + " "+ monthNames[d.getMonth()] + " " + d.getFullYear();
                dateStr += " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
                $("#lastupdate").text(dateStr);
             }).
            fail(function(err){
                console.log(err);
            });
        setTimeout(loadData, 2000);
    }

    function btnLoad_Click(){
        //alert("Hello");
        loadData();
    }
    $(()=>{
        $("#btnLoad").click(btnLoad_Click);           
    })
</script>


</html>