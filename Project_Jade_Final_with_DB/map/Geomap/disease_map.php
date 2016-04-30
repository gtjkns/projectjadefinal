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
    <script type="text/javascript" src="loader.js"></script>
    <script type="text/javascript" src="jsapi.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['geochart']});
      google.charts.setOnLoadCallback(drawRegionsMap);
/*
 ['Country',   'Frequency'],
          ['Algeria', 36], ['Angola', 8], ['Benin', 6], ['Botswana', 24],
          ['Burkina Faso', 12], ['Burundi', 3], ['Cameroon', 3],
          ['Canary Islands', 28], ['Cape Verde', 15],
          ['Central African Republic', 4], ['Ceuta', 35], ['Chad', 12],
          ['Comoros', 12], ['Ivory Coast', 6],
          ['Democratic Republic of the Congo', 3], ['Djibouti', 12],
          ['Egypt', 26], ['Equatorial Guinea', 3], ['Eritrea', 15],
          ['Ethiopia', 9], ['Gabon', 0], ['Gambia', 13], ['Ghana', 5],
          ['Guinea', 10], ['Guinea-Bissau', 12], ['Kenya', 1],
          ['Lesotho', 29], ['Liberia', 6], ['Libya', 32], ['Madagascar', null],
          ['Madeira', 33], ['Malawi', 14], ['Mali', 12], ['Mauritania', 18],
          ['Mauritius', 20], ['Mayotte', 13], ['Melilla', 35],
          ['Morocco', 32], ['Mozambique', 25], ['Namibia', 22],
          ['Niger', 14], ['Nigeria', 8], ['Republic of the Congo', 1],
          ['Réunion', 21], ['Rwanda', 2], ['Saint Helena', 16],
          ['São Tomé and Principe', 0], ['Senegal', 15],
          ['Seychelles', 5], ['Sierra Leone', 8], ['Somalia', 2],
          ['Sudan', 15], ['South Africa', 30], ['South Sudan', 5],
          ['Swaziland', 26], ['Tanzania', 6], ['Togo', 6], ['Tunisia', 100],
          ['Uganda', 1], ['Western Sahara', 25], ['Zambia', 15],
          ['Zimbabwe', 18],['Bangladesh',67],['India',12],['Pakistan',23],['United States',24],['Canada',45],['Russia',55],['United Arab Emirates',34],['Cocos Islands',100]
        
        */
        
      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country',   'Frequency'],
          <?php echo $record_str; ?>
         ]);

        var options = {
           //region:'034',
          colorAxis: {colors: [ '#00ff00','#ff99ff', '#ff3300']},
          backgroundColor: '#123',
          datalessRegionColor: '#ffff99',
          defaultColor: '#f5f5f5',
        };

        var chart = new google.visualization.GeoChart(document.getElementById('geochart-colors'));
        chart.draw(data, options);
      };
    </script>
  </head>
  <body>
    <div id="geochart-colors" style="width: 1350px; height: 600px;">
      <!-- <iframe src="http://www.weatherfor.us/load.php?" scrolling="no" frameborder="0" allowtransparency="true" style="background: transparent; width: 720px; height: 250px; overflow: hidden;"></iframe> -->

    </div>
  </body>
</html>

        <!--ctg@112233-->