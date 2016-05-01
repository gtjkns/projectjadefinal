var counter = 0;
var limit = 300;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "symptom " + (counter + 1) + " <br><select type='text' name='myInputs[1]'><option value='' selected=''></option>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
    //  <?php 
				// //if(isset($_POST["country"])){				
				// 	$symptom = find_symptom();  

				//   	while ( $symp_arr = mysqli_fetch_assoc($symptom)) {
				// 			 echo "<option value='{".$symp_arr['id']."}'>".$symp_arr['symptom']."</option>";
				// 	}
				// }
				
			 //  ?>
}