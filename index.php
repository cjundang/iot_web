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
        <h1>thingspeak</h1>
        <div class="row">
            <div class="col-6">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    
    
    
        <div class="row">
            <div class="col-3">
                <div class="row">
                    <div class="col-4">
                        <b>Temperature</b>
                    </div>
                    <div class="col-8">
                        <span id="lastTemperature"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <b>Humidity</b>
                    </div>
                    <div class="col-8">
                        <span id="lastHumidity"></span>
                    </div>
                </div>
                <div>
                    Last update <span id="lastupdate"></span>
                </div>
            </div>
        </div>    
    </div>
    


     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-2.2.4.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>

  </body>

  <script>
 
    function loadData(){
        let url = "https://api.thingspeak.com/channels/1458406/feeds.json?results=20"           
        $.getJSON( url, function( data ) {
            console.log(data);
             let feeds = data.feeds;
             console.log(feeds[0]);  
             $("#lastTemperature").text(feeds[0].field2+ " C");
             $("#lastHumidity").text(feeds[0].field1+ " %");
             
             const d = new Date(feeds[0].created_at);
             const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"]
             let dateStr = d.getDate() + " "+ monthNames[d.getMonth()] + " " + d.getFullYear();
             dateStr += " " + d.getHours() + ":" + d.getMinutes();
             $("#lastupdate").text(dateStr);

             var plot_data = Object();
             var xlabel = [];
             var data1 = [];

             $.each(feeds, (k, v)=>{
                var d = new Date(v.created_at);
                xlabel.push(d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds());
                data1.push(v.field1);
             });

             plot_data.xlabel =  xlabel;
             plot_data.data = data1;
             plot_data.label = data.channel.field1;

            showChart(plot_data);
         });
    }

    function showChart(data){
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data:  {
                labels:data.xlabel,
                datasets: [{
                    label: data.label,
                    data: data.data
                    }
                ]
            }
        });
    }

    $(()=>{
        loadData();
        
        
    })

  
</script>


</html>