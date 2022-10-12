<?php

$weather="";
if(isset($_GET['city'])){

  
  $appId='f4bc7ee781e436e3957f99104c497477';
  
  $apiContent = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.urlencode($_GET["city"]).'&appid='.$appId);
  
  $weatherArray = json_decode($apiContent, true);
  
  $tempratureInCelcius = intval($weatherArray['main']['temp']-273.15);
  
  $weather='In <strong>'.$_GET["city"].'</strong> the weather is currently'.'<img src="http://openweathermap.org/img/wn/'.urlencode($weatherArray['weather'][0]['icon']).'.png" style="height:40px; width:auto;"><strong>'.$weatherArray['weather'][0]['description'].'</strong> ';
  
  $weather .='with Temprature: <strong>'.$tempratureInCelcius.'&deg;C</strong>, Humidity: '.$weatherArray['main']['humidity'].' and Wind Speed: '.$weatherArray['wind']['speed'].'m/s.';
  

}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Weather Scraper</title>
    
    <style type="text/css">
      html { 
        background: url(background-image.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
      body{
        background: none;
      }
      .container{
        margin-top: 100px;
        text-align: center;
        width: 45%;
      }
      #submit{
        margin-bottom: 10px;
      }
      @media (max-width: 665px) {
        .container{
            width:90%;
        }
      }
      @media (max-width: 915px) and (min-width: 666px) {
        .container{
            width:60%;
        }
      }
    </style>
    
  </head>
  <body>
    
    <div class="container">
      
      <h1>What's The Weather?</h1>
      
      <form>
        <fieldset class="form-group">
          <label for = "city">Enter the name of a city</label>
          <input type="search" id="city" placeholder="Eg. London, Tokyo" class="form-control" name="city" value = "<?php 
                                                                                                                   if($_GET){
                                                                                                                     echo $_GET['city'];
                                                                                                                   }
                                                                                                                   ?>">
        </fieldset>
        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        
        
        <?php
        $result = "";
        if(isset($weatherArray['cod']) && $weatherArray['cod']==200){
          $result='<div class="alert alert-success" role="alert">'.$weather.'</div>';
        }
        else if(isset($_GET['city'])){
          $result='<div class="alert alert-danger" role="alert">Couldn\'t locate the city.</div>';
        }
        
        
        ?>
        
        <div><?php echo $result; ?></div>
        
      </form>
      
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
