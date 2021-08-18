<!DOCTYPE html>
<html lang="en">
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>

    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>


</head>
<body>

    <div id="mapdiv"></div>

    
</body>
<script>

let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("mapdiv"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}

    $(()=>{
        let url = "https://api.thingspeak.com/channels/1458406/feeds.json?results=1"           
        $.getJSON( url, function( data ) {
            console.log(data);
            console.log(data.channel);
            console.log(data.channel.field1);

            initMap();
         });
    })

  
</script>
</html>


