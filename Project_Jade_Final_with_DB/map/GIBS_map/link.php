<?php
session_start();

  require_once("../../include/db_connect.php");
  require_once("../../include/function.php");
 
?>
<html>
<link rel="stylesheet" type="text/css" href="../../profiles/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../profiles/assets/css/ui.css">
<script type="text/javascript" src="../../profiles/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../../profiles/assets/js/ui.js"></script>

<script type="text/javascript" src="coordinate.js"></script>
<style>
  span{
    font-size: 150%;
    color:violet;
  }
  h1{
    color: #fff;
  }
  body{
    background: #bgvid;
  }
  .row{

    width: 10px;
    min-height: 10px;
    background: #bgvid;

  }
  .container{
    width: 360px;
    min-height: 10px;
    font-size: 150%;
    margin:0px auto 20px;
    color:violet;
  }
  .pic{
    font-size: 150%;
    color:white;
    margin:0px auto 20px;
    background-color: transparent;
    width: 500px;
  }
</style>
<body>
	<video autoplay loop poster="Milky_Way_Night_Sky.webm.480p.jpg" id="bgvid">
    <source src="Milky_Way_Night_Sky.webm.480p.webm" type="video/webm">
    <source src="Milky_Way_Night_Sky.webm.480p.mp4" type="video/mp4">
</video>
<style>

video#bgvid { 
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    -ms-transform: translateX(-50%) translateY(-50%);
    -moz-transform: translateX(-50%) translateY(-50%);
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
    background: url(Milky_Way_Night_Sky.webm.480p.jpg) no-repeat;
    background-size: cover; 
}
.comment_box{padding:20px;background:rgba(0,0,0,.2);}
.comment_view{background:rgba(250,250,250,0);}
.comment_area{position:relative;float:right;width:400px;min-height:800px;top:0;right:0;background:rgba(250,250,250,.8);overflow-y:auto;overflow-x:hidden;}
.nopadding{padding:0;}
</style>
<div class="maps pull-left" style="width:850px">
<h1>Nasa Worldview Map for Different Layers</h1>	
<span style="padding-right:270px">Without Layer:</span><span>Dust Layer(day/night):</span><br>
<iframe id="test3"  height="300" width ="400" src="" ></iframe>&nbsp;&nbsp;
<iframe id="test4"  height="300" width ="400" src="" ></iframe><br><br>
<span style="padding-right:70px">Carbon Monoxide Layer(day/night):</span><span>Sulphur Dioxide Layer(day/night):</span><br>
<iframe id="test6"  height="300" width ="400" src="" ></iframe>&nbsp;&nbsp;
<iframe id="test7"  height="300" width ="400" src="" ></iframe><br><br>
<span>Ozone Layer(day/night):</span><br>
<iframe id="test8"  height="300" width ="400" src="" ></iframe><br><br>
<div class="pic">
<h2>Carbon Monoxide</h2>
<input id="id1" type="number" min="1" max="12"><br><br>
<img src="images/carbon_monoxide.png" alt="Carbon monoxide" style="width:360px;height:100px;">
<h2>Dust score</h2>
<input id="id1" type="number" min="1" max="9"><br><br>
<img src="images/Dust_score.png" alt="Dust score" style="width:360px;height:100px;">
<h2>Sulfur dioxide</h2>
<input type="range" name="points" min="0" max="10"><br><br>
<img src="images/Sulfur_dioxide.png" alt="Sulfur dioxide" style="width:360px;height:100px;">
<h2>Ozone layer</h2>
<input type="range" name="points" min="0" max="10"><br><br>
<img src="images/ozone_layer.png" alt="Ozone layer" style="width:360px;height:100px;">
<!--<div style="width: 210px;">
  <iframe style="display: block;" src="http://cdnres.willyweather.com/widget/loadView.html?id=46995" height="300"width="400"  frameborder="0" scrolling="no"></iframe>
  <a style="position: relative;z-index: 1;display: block;margin: -20px 0 0 0;height: 20px;text-indent: -9999em" href="http://www.willyweather.com/pa/northampton-county/east-bangor.html">East Bangor weather info</a>
  </div>-->
  </div>
</div>
<div class="pull-right comment_area" style="width:400px">

<?php  if(isset($_SESSION['id']) && $_SESSION['user_type'] == 'environment') {?>
<div class="col-xs-12 comment_box">
<div class="text-right col-xs-12"><a href="../../profiles/logout.php" class="btn btn-primary">Log out</a></div>
  <form action="model.php" method="post">
  <div class="col-xs-12">
    <p>&nbsp;</p>
    <textarea class="form-control" name="comment_box" placeholder="Write here ..."></textarea>
    <p>&nbsp;</p>
    <button class="btn btn-warning" style="width:100%" name="comment_btn">Comment</button>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </form>
  </div>

  </div>
<?php } ?>
   <div class="col-xs-12 comment_view">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
      <div class="col-xs-12">
      <?php
        $result_3 = mysqli_query($connection,"select * from comment_text left join pdhp_environmentalist on pdhp_environmentalist.id = comment_text.e_id order by comment_text.id desc ");
            while($row_3 = mysqli_fetch_assoc($result_3)) 
            {
                echo '
                <div class="col-xs-12">
                <p>&nbsp;</p>
                <p style="font-weight:bold;font-size:120%;">'.$row_3['first_name'].' '.$row_3['last_name'].' </p>
                <p>'.nl2br($row_3['comment']).'</p>
                <p class="text-right">'.$row_3['date_time'].'</p>
                <hr></hr>
                </div>
                ';
            }
      ?>
      </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
   </div>
</div>
<!-- <section id="contact" class="one">
            <div class="container">

              <header>
                <h2>Add Comment</h2>
              </header>
              <form method="post" action="#">
                <div class="row">
                    <textarea name="Comment" placeholder="Comment"></textarea>
                  </div>
                  <div class="12u$">
                    <br><br><input type="submit" value="Send Comment" />
                  </div>
                </div>
              </form>

            </div>
          </section> -->
          </body>
<script>


function getParams(){
  var idx = document.URL.indexOf('?');
  var params = new Array();
  if (idx != -1) {
    var pairs = document.URL.substring(idx+1, document.URL.length).split('&');
  for (var i=0; i<pairs.length; i++){
    nameVal = pairs[i].split('=');
    params[nameVal[0]] = nameVal[1];
    }
  }
  return params;
 }
  var test5;
  params = getParams();
  test1 = unescape(params["country"]);
  test2 = unescape(params["date"]);
   
    for(var i=0;i<List.length;i++){
      if(test1==List[i]["country"]){
          test5=List[i]["coordinate"];
          
      }
    }
    
    var url1 ="https://worldview.earthdata.nasa.gov/?p=geographic&l=VIIRS_SNPP_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Aqua_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Terra_CorrectedReflectance_TrueColor,Reference_Labels,Reference_Features%28hidden%29,Coastlines&t=";
      url1 +=test2; 
      url1+="&v=";
      url1+=test5;
      document.getElementById("test3").src=url1;

    var url2 ="https://worldview.earthdata.nasa.gov/?p=geographic&l=VIIRS_SNPP_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Aqua_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Terra_CorrectedReflectance_TrueColor,AIRS_Dust_Score%28palette=rainbow_1%29,Aqua_Orbit_Dsc,Aqua_Orbit_Asc,Reference_Labels,Reference_Features%28hidden%29,Coastlines&t=";
    	url2 +=test2;
      url2+="&v=";
      url2+=test5;
      document.getElementById("test4").src=url2;
    var url3 ="https://worldview.earthdata.nasa.gov/?p=geographic&l=VIIRS_SNPP_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Aqua_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Terra_CorrectedReflectance_TrueColor,AIRS_CO_Total_Column_Night,AIRS_CO_Total_Column_Day,Reference_Labels,Reference_Features%28hidden%29,Coastlines&t=";
      url3 +=test2;
      url3+="&v=";
      url3+=test5;
      document.getElementById("test6").src=url3;
    var url4 ="https://worldview.earthdata.nasa.gov/?p=geographic&l=VIIRS_SNPP_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Aqua_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Terra_CorrectedReflectance_TrueColor,AIRS_Prata_SO2_Index_Night,AIRS_Prata_SO2_Index_Day,Reference_Labels,Reference_Features%28hidden%29,Coastlines&t=";
      url4 +=test2;
      url4+="&v=";
      url4+=test5;
      document.getElementById("test7").src=url4;
    var url5 ="https://worldview.earthdata.nasa.gov/?p=geographic&l=VIIRS_SNPP_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Aqua_CorrectedReflectance_TrueColor%28hidden%29,MODIS_Terra_CorrectedReflectance_TrueColor,MLS_O3_46hPa_Night,MLS_O3_46hPa_Day,Reference_Labels,Reference_Features%28hidden%29,Coastlines&t=";
      url5 +=test2;
      url5+="&v=";
      url5+=test5;
      document.getElementById("test8").src=url5;
      

</script>

</html>