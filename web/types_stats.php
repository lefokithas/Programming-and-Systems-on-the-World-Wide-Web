<?php
    include_once 'admin_header.php';

    if ($_SESSION["useruid"] === NULL) {
    header("location: ../index.php?error=nologin");
    exit();
   }

   $con = new mysqli('localhost','root','','web_base');

   $query = $con->query("SELECT v_poi_name FROM visit_by;");
   $v_poi = array();
		if (mysqli_num_rows($query) > 0) {
			while($row = mysqli_fetch_assoc($query)) {
				array_push($v_poi, $row['v_poi_name']);
			}
      echo json_encode($v_poi,true);
		}else{
			// echo 0;
		}
    /*
    for($i = 0; $i <= sizeof($v_poi); $i++){
      $query = $con->query("SELECT types FROM poi WHERE poi = '$v_poi[$i]';");
      $types = array();
		    if (mysqli_num_rows($query) > 0) {
			       while($row = mysqli_fetch_assoc($query)) {
				           array_push($types, $row['types']);
			              }
                    echo json_encode($types,true);
		                }else{
			                   // echo 0;
		                     }
  }*/
?>



   <!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Chart</title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

<div style="width: 700px; position: absolute; ">
  <canvas id="myChart"></canvas>
</div>
<script>

  // === include 'setup' then 'config' above ===
  const labels = ['bar','cafe','food','point_of_interest','establishment','restaurant','convenience_store','grocery_or_supermarket','store','bakery','supermarket','car_rental','car_repair','car_wash','park','tourist_attraction','gym','health','liquor_store','shopping_mall','furniture_store','home_goods_store','lodging','laundry','hardware_store','electronics_store','hair_care','drugstore','ban','atm','finance','accounting','pharmacy','doctor','casino','car_dealer','pet_store','town_square'];
  const data = {
    labels: labels,
    datasets: [{
      label: 'My First Dataset',
      data: <?php echo json_encode($v_poi) ?>,
      backgroundColor: [
        '#047aed',
        '#7fff00',
        '#002240'
      ],
      borderColor: [
        '#b22222',
        '#a9a9a9',
        '#ff0000'
      ],
      borderWidth: 1.5
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

</body>
</html>

<?php
    include_once 'footer.php';
?>
