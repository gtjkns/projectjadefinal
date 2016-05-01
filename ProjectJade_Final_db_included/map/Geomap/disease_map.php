<?php
session_start();
  require_once("../../include/db_connect.php");
  require_once("../../include/function.php");
if(!isset($_SESSION['id']))
header("location:../../public/Login_form.php");

        $d_id = $_POST['d_id'];
        $date_from = date($_POST['date_from'].' 00:00:00');
        $date_to = date($_POST['date_to'].' 23:59:59');
        
        $record = array();
        $count_2 = 0;
        $result = mysqli_query($connection,"select * from pdhp_country order by id asc");
        while($row = mysqli_fetch_assoc($result))
        {
          $count_2++;
          $count = 0;
          $result_2 = mysqli_query($connection,"select * from pdhp_doctor where cid = ".$row['id']);
          while($row_2 = mysqli_fetch_assoc($result_2)) 
          {
            
            $result_3 = mysqli_query($connection,"select * from doc_disease_count where doc_id = ".$row_2['id']." and d_id = ".$d_id." and date_time >= '$date_from' and  date_time <= '$date_to' ");
            while($row_3 = mysqli_fetch_assoc($result_3)) 
            {
              $count = $count + $row_3['num_patient'];
            }
          }
          
          $result_4 = mysqli_query($connection,"select * from pdhp_pharmacy where cid = ".$row['id']);
          while($row_4 = mysqli_fetch_assoc($result_4)) 
          {
            
            $result_5 = mysqli_query($connection,"select * from pharmacy_disease_count where p_id = ".$row_4['id']." and d_id = ".$d_id);
            while($row_5 = mysqli_fetch_assoc($result_5)) 
            {
              $temp = $row_5['num_cus'] - $row_5['num_pre_cus'];
              $count = $count + $temp;
            }
          }

          $record[] = "['".$row['country']."', $count]";
        }
        $record_str = implode(",",$record);
        
 ?>
<html>
  <head>
    <style>
#dialogoverlay{
    display: none;
    opacity: .8;
    position: fixed;
    top: 0px;
    left: 0px;
    background: #FFF;
    width: 100%;
    z-index: 10;
}
#dialogbox{
    display: none;
    position: fixed;
    background: #000;
    border-radius:7px; 
    width:300px;
    z-index: 10;
}
#dialogbox > div{ background:#FFF; margin:8px; }
#dialogbox > div > #dialogboxhead{ background: #666; font-size:19px; padding:10px; color:#CCC; }
#dialogbox > div > #dialogboxbody{ background:#333; padding:20px; color:#FFF; }
#dialogbox > div > #dialogboxfoot{ background: #666; padding:10px; text-align:right; }
</style>
    <script type="text/javascript" src="loader.js"></script>
    <script type="text/javascript" src="jsapi.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['geochart']});
      google.charts.setOnLoadCallback(drawRegionsMap);

        
      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country',   'Frequency'],
          <?php echo $record_str; ?>
         ]);

       var options = {
          colorAxis: {colors: [ '#00ff00','#ff99ff', '#ff3300']},
          backgroundColor: '#00001a',
          datalessRegionColor: '#ffff99',
          defaultColor: '#f5f5f5',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
        var s;
        google.visualization.events.addListener(chart, 'select', function () {
        var selection = chart.getSelection();
      
        if (selection.length) {
        s=data.getValue(selection[0].row, 0);
        $.getJSON("http://api.openweathermap.org/data/2.5/weather?q="+s+"&units=metric&APPID=0d7cd1f1072b8ddba373acea9e1d64cd",function(json){
            var data=(JSON.stringify(json));
            var sony=JSON.parse(data);
            
            Alert.render(s+":<br><br>Temperature = "+sony.main["temp"]+"\xB0C"+
            "<br>Humidity = "+sony.main["humidity"]+"%"+
            "<br>Clouds = "+sony.clouds["all"]+"%"+
            "<br>Pressure = "+sony.main["pressure"]+" kPa"+
            "<br>Wind Direction = "+sony.wind["deg"]+"\xB0"+
            "<br>Wind Speed = "+sony.wind["speed"]+" m/s");
             });
       
      }
    });
        chart.draw(data, options);
      };
      function CustomAlert(){
         
    this.render = function(dialog){
        var winW = window.innerWidth;
        var winH = window.innerHeight;
        var dialogoverlay = document.getElementById('dialogoverlay');
        var dialogbox = document.getElementById('dialogbox');
        dialogoverlay.style.display = "block";
        dialogoverlay.style.height = winH+"px";
        dialogbox.style.left = (winW/2) - (550 * .5)+"px";
        dialogbox.style.top = "100px";
        dialogbox.style.display = "block";
        document.getElementById('dialogboxhead').innerHTML = "Weather Update";
        document.getElementById('dialogboxbody').innerHTML = dialog;
        document.getElementById('dialogboxfoot').innerHTML = '<button onclick="Alert.ok()">OK</button>';
        

    }
    this.ok = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
    }
  }
  var Alert = new CustomAlert();
    </script>
  </head>
  <body>
    <div id="geochart-colors" style="width: 1350px; height: 600px;">
      <!-- <iframe src="http://www.weatherfor.us/load.php?" scrolling="no" frameborder="0" allowtransparency="true" style="background: transparent; width: 720px; height: 250px; overflow: hidden;"></iframe> -->

    </div>
    <div id="dialogoverlay"></div>
    <div id="dialogbox">
    <div>
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
    </div>
    </div>
  </body>
</html>

        <!--ctg@112233-->