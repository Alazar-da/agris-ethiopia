<?php
session_start();
$name=$_SESSION["name"];
if (!isset($name)) {
    header('location:login.php');
}
include 'data/conn.php';
//$date=date('y-m-d');

$humd=10;
$temp=10;

$sql = "SELECT * FROM gh_daily_info WHERE customer_id='$name'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $humd=$row['humd'];
        $temp=$row['temp'];
        $moist=$row['moist'];
        $pump=$row['pump'];
        $fan=$row['fan'];
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">






    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
	<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
	<script type="text/javascript">
        FusionCharts.ready(function(){
    var chartObj = new FusionCharts({
type: 'hlineargauge',
renderAt: 'humidity',
width: '400',
height: '190',
dataFormat: 'json',
dataSource: {
"chart": {
    "theme": "fusion",
    "caption": "",
    "subcaption": "",
    "lowerLimit": "0",
    "upperLimit": "100",
    "numberSuffix": "%",
    "chartBottomMargin": "40",
    "valueFontSize": "11",
    "valueFontBold": "0"
},
"colorRange": {
    "color": [{
        "minValue": "0",
        "maxValue": "35",
        "label": "Low",
    }, {
        "minValue": "35",
        "maxValue": "70",
        "label": "Moderate",
    }, {
        "minValue": "70",
        "maxValue": "100",
        "label": "High",
    }]
},
"pointers": {
    "pointer": [{
        "value": "10"
    }]
},
"trendPoints": {
    "point": [
        //Trendpoint
        {
            "startValue": "70",
            "displayValue": " ",
            "dashed": "1",
            "showValues": "0"
        }, {
            "startValue": "85",
            "displayValue": " ",
            "dashed": "1",
            "showValues": "0"
        },
        //Trendzone
        {
            "startValue": "70",
            "endValue": "85",
            "displayValue": " ",
            "alpha": "40"
        }
    ]
},
"annotations": {
    "origw": "400",
    "origh": "190",
    "autoscale": "1",
    "groups": [{
        "id": "range",
        "items": [{
            "id": "rangeBg",
            "type": "rectangle",
            "x": "$chartCenterX-115",
            "y": "$chartEndY-35",
            "tox": "$chartCenterX +115",
            "toy": "$chartEndY-15",
            "fillcolor": "#0075c2"
        }, {
            "id": "rangeText",
            "type": "Text",
            "fontSize": "11",
            "fillcolor": "#ffffff",
            "text": "Recommended Utilization Range : 70% - 85%",
            "x": "$chartCenterX",
            "y": "$chartEndY-25"
        }]
    }]
}
}
}
);
    chartObj.render();
});



FusionCharts.ready(function(){
    var chartObj = new FusionCharts({
type: 'thermometer',
renderAt: 'temprature',
width: '240',
height: '310',
dataFormat: 'json',
dataSource: {
"chart": {
    "caption": "Temperature Monitor",
    "subcaption": " Central cold store",
    "lowerLimit": "-10",
    "upperLimit": "0",

    "decimals": "1",
    "numberSuffix": "¡ÆC",
    "showhovereffect": "1",
    "thmFillColor": "#008ee4",
    "showGaugeBorder": "1",
    "gaugeBorderColor": "#008ee4",
    "gaugeBorderThickness": "2",
    "gaugeBorderAlpha": "30",
    "thmOriginX": "100",
    "chartBottomMargin": "20",
    "valueFontColor": "#000000",
    "theme": "fusion"
},
"value": "24",
//All annotations are grouped under this element
"annotations": {
    "showbelow": "0",
    "groups": [{
        //Each group needs a unique ID
        "id": "indicator",
        "items": [
            //Showing Annotation
            {
                "id": "background",
                //Rectangle item
                "type": "rectangle",
                "alpha": "50",
                "fillColor": "#AABBCC",
                "x": "$gaugeEndX-40",
                "tox": "$gaugeEndX",
                "y": "$gaugeEndY+54",
                "toy": "$gaugeEndY+72"
            }
        ]
    }]

},
},
"events": {
"rendered": function(evt, arg) {
    evt.sender.dataUpdate = setInterval(function() {
        var value,
            prevTemp = evt.sender.getData(),
            mainTemp = (Math.random() * 10) * (-1),
            diff = Math.abs(prevTemp - mainTemp);

        diff = diff > 1 ? (Math.random() * 1) : diff;
        if (mainTemp > prevTemp) {
            value = prevTemp + diff;
        } else {
            value = prevTemp - diff;
        }

        evt.sender.feedData("&value=" + value);

    }, 3000);
    evt.sender.updateAnnotation = function(evtObj, argObj) {
        var code,
            chartObj = evtObj.sender,
            val = chartObj.getData(),
            annotations = chartObj.annotations;

        if (val >= -4.5) {
            code = "#00FF00";
        } else if (val < -4.5 && val > -6) {
            code = "#ff9900";
        } else {
            code = "#ff0000";
        }
        annotations.update("background", {
            "fillColor": code
        });
    };
},
'renderComplete': function(evt, arg) {
    evt.sender.updateAnnotation(evt, arg);
},
'realtimeUpdateComplete': function(evt, arg) {
    evt.sender.updateAnnotation(evt, arg);
},
'disposed': function(evt, arg) {
    clearInterval(evt.sender.dataUpdate);
}
}
}
);
    chartObj.render();
});







    function myFunction(){ 
     document.getElementByClass('change').setAttribute('id', 'temprature');
      //var x = document.getElementById("temp");
      //var y = document.getElementById("humi");

  //x.style.display = "block";

  //y.style.display = "none";

      }
      function myFun(){
    document.getElementByClass('change').setAttribute('id', 'humidity'); 
      //var x = document.getElementById("temp");
      //var y = document.getElementById("humi");

  //y.style.display = "block";
  //x.style.display = "none";
      }
      </script>



    <title>Dashboard</title>
    <style >
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
      a{
        color: white;
      }
      a:hover{
        color: black;
        border-color:white ;
      }
      #pump{
        color: white;
        background-color: #007A7B;
      }
      
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#007A7B;">
    <a class="navbar-brand" href="#"><img src="../ecommerce/Agris.png" style="height: 50px; width: 100px;" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          
         
            <a class="nav-link active" href="#">Dashboard</a> <span class="sr-only">(current)</span></a>
            <a class="nav-link" href="stastics.php">Stastics</a>
            <a class="nav-link" href="#">Wether</a>
            <a class="nav-link mr-auto" href="#">Messages</a>

           
        <a class="nav-link" href="account.php"><i style="font-size: 1.5rem;" class="bi bi-person-fill"></i></a>
        <a class="nav-link" href="logout.php"><i style="font-size: 1.5rem;" class="bi bi-box-arrow-left"></i></a>
          
        </div>
       
    </nav>



    <main class="mt-5 mb-5 pb-5">

        <!--
            <div class="container mb-3">
                    <div class="row">
                        <div class="col-3">
                            <form action="index.php" method="post">
                                <input type="date" name="date" id="">
                                <button name="calendar" style="background-color: #00ACAB;" class="btn btn-outline-light" type="calendar"><i class="bi bi-calendar-check-fill"></i></button>
                
                            </form>
                        </div>
                    </div>
                </div>
        -->        

      <div class="container" style="border:#007A7B 1px solid;">
        <div class="row" style="background-color:#007A7B;">
            <div class="col px-0">
                <button onclick="temp()" class="font-weight-light btn btn-lg btn-outline-light w-100">Temprature</button>
            </div>
            <div class="col px-0">
                <button onclick="humd()" class="font-weight-light btn btn-lg btn-outline-light w-100">Humidity</button>
            </div>
            <div class="col px-0">
                <button onclick="moist()" class="font-weight-light btn btn-lg btn-outline-light w-100">Moisture</button>
            </div>
            <div class="col px-0">
                <button onclick="pump()" class="font-weight-light btn btn-lg btn-outline-light w-100">Pump</button>
            </div>
            <div class="col px-0">
                <button onclick="fan()" class="font-weight-light btn btn-lg btn-outline-light w-100">Fan</button>
            </div>
        </div>
        <div class="row justify-content-center bg-white mb-5 mt-3">
            <div class="col-4" id="temp">
                <div id="temprature"></div>
            </div>
            <div class="col-4" id="humi" style="display:none;">
                <div id="humidity"></div>
            </div>
            <div class="col-4" id="moist" style="display:none;">
                <?php echo $moist;  ?>
            </div>
            <div class="col-4" id="pump" style="display:none;">
                
                <div class="row justify-content-center bg-white">
                    <?php
                    if($pump==0){
                        echo '
                        <div class="col text-dark border">
                            <h6>ON</h6>
                        </div>
                        <div class="col border" id="pump">
                            <h6>OFF</h6>
                        </div>';
                    }
                    else if($pump==1){
            
                        echo '<div class="col border" id="pump">
                            <h6>ON</h6>
                        </div>
                        <div class="col text-dark border">
                            <h6>OFF</h6></div>';
                            
                    }
                    ?>
                </div>
            </div>
              
            <div class="col-4" id="fan" style="display:none;">
                <div class="row justify-content-center bg-white">
                    <?php
                    if($fan==0){
                        echo '
                        <div class="col text-dark border">
                            <h6>ON</h6>
                        </div>
                        <div class="col border" id="pump">
                            <h6>OFF</h6>
                        </div>';
                    }
                    else if($fan==1){
            
                        echo '<div class="col border" id="pump">
                            <h6>ON</h6>
                        </div>
                        <div class="col text-dark border">
                            <h6>OFF</h6></div>';
                            
                    }
                    ?>
                </div>
            </div>
        </div>    
      </div>
    </main>
    


    <footer style="background-color: #00ACAB;

    bottom: 0;
        left: 0;
        width: 100%;
        height:auto;
        position: absolute;
    ">
        <div class="container-fluid text-white">
            <div class="row justify-content-center pt-3">
                <div class="col-md-4 col-10 text-center">
                    <h5>Important links</h5>
                    <ul style="list-style-type: none;">
                        <li><a href="aboutus.html">About us</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="aboutus.html">Terms and Condition</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-10 text-center">
                    <h5>Catagories</h5>
                    <ul style="list-style-type: none;">
                        <li><a class="nav-link active" href="#">Dashboard</a></li>
                        <li><a class="nav-link" href="stastics.php">Stastics</a></li>
                        <li><a class="nav-link" href="#">Wether</a></li>
                        <li><a class="nav-link" href="#">Messages</a></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-9 text-center">
                    <a class="nav-link d-inline" href="#"><i style="font-size: 1.5rem;" class="bi bi-facebook"></i></a>
                    <a class="nav-link d-inline" href="#"><i style="font-size: 1.5rem;" class="bi bi-instagram"></i></a>
                    <a class="nav-link d-inline" href="#"><i style="font-size: 1.5rem;" class="bi bi-envelope-at-fill"></i></a>
                    <a class="nav-link d-inline" href="#"><i style="font-size: 1.5rem;" class="bi bi-twitter"></i></a>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-8">
                    <p class="text-center"><i class="bi bi-c-circle"></i> 2023 Agris.et E-Commerce</p>
                </div>
            </div>
        </div>
    </footer>  

    <script>
        function temp()
        { 
        //document.getElementsByClassName("change").setAttribute("id", "temprature");
            var t = document.getElementById("temp");
            var h = document.getElementById("humi");
            var m = document.getElementById("moist");
            var p = document.getElementById("pump");
            var f = document.getElementById("fan");
            
            t.style.display = "block";
            h.style.display = "none";
            m.style.display = "none";
            p.style.display = "none";
            f.style.display = "none";
        }

        function humd(){
            //document.getElementsByClassName("change").setAttribute("id", "humidity"); 
            var t = document.getElementById("temp");
            var h = document.getElementById("humi");
            var m = document.getElementById("moist");
            var p = document.getElementById("pump");
            var f = document.getElementById("fan");
            
            t.style.display = "none";
            h.style.display = "block";
            m.style.display = "none";
            p.style.display = "none";
            f.style.display = "none";
         }

         function moist(){
            //document.getElementsByClassName("change").setAttribute("id", "humidity"); 
            var t = document.getElementById("temp");
            var h = document.getElementById("humi");
            var m = document.getElementById("moist");
            var p = document.getElementById("pump");
            var f = document.getElementById("fan");
            
            t.style.display = "none";
            h.style.display = "none";
            m.style.display = "block";
            p.style.display = "none";
            f.style.display = "none";
         }

         function pump(){
            //document.getElementsByClassName("change").setAttribute("id", "humidity"); 
            var t = document.getElementById("temp");
            var h = document.getElementById("humi");
            var m = document.getElementById("moist");
            var p = document.getElementById("pump");
            var f = document.getElementById("fan");
            
            t.style.display = "none";
            h.style.display = "none";
            m.style.display = "none";
            p.style.display = "block";
            f.style.display = "none";
         }

         function fan(){
            //document.getElementsByClassName("change").setAttribute("id", "humidity"); 
            var t = document.getElementById("temp");
            var h = document.getElementById("humi");
            var m = document.getElementById("moist");
            var p = document.getElementById("pump");
            var f = document.getElementById("fan");
            
            t.style.display = "none";
            h.style.display = "none";
            m.style.display = "none";
            p.style.display = "none";
            f.style.display = "block";
         }
         
         </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>