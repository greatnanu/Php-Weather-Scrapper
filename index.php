<?php
error_reporting(0);
  $weather='';
  $error = '';
  if($_GET['city']){
  	$city= str_replace('', '', $_GET['city']);
		  	$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		    $error = "the city could not be found";}
		else {
		    $forcast = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		    $pageArray = explode('(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forcast);
		    if(sizeof($pageArray)>1){
		    $secondA = explode("</span></p></td>", $pageArray[1]);
		    if(sizeof($secondA)>1){
		   	 $weather = $secondA[0];
		   	}else{
		   		$error= "The Page could not be found";
		   	}

			}else{
				$error= "The Page could not be found";
			}
		}

}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" >
    <style type="text/css">
      html { 
          background: url(wimage.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
        body{
          background: none;

        }
        .container{
          text-align: center;
          margin-top: 100px;
          width: 450px;


        }
        .input{
          margin: 20px 0;
        }
        #weather{
        	margin-top: 15px;
        }
    </style>

    <title>Weather Scrapper</title>
  </head>
  <body>
    
    <div class="container">
      <h1 class="text-center" style="margin-top: 200px;">What's the Weather?</h1>
      <form>
        <div class="form-group">
          <label for="city"  class="lead font-weight-bold">Enter city</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Eg : Landon, Delhi" name="city" value="<?php echo$_GET['city'];?>"><br>
         
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div id="weather">
      	<?php 
      	if($weather){
      		echo '<div class="alert alert-success">'.$weather.'</div>';
      	}elseif($error){
      		echo '<div class="alert alert-danger">'.$error.'</div>';

      	}
      	?>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  </body>
</html>