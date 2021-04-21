<?php
  session_start();

  include ("config.php");

  include ("./app/database_connector.php");

  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

  $uri = explode( '/', $uri );

  $urls=['app','login','register'];

  $back_jump="";

  if(in_array($uri[1],$urls)){
      $back_jump="./../";
  }

?>

<!DOCTYPE HTML>
 <html lang="en-US">
  <head>
      <link rel="stylesheet" href="<?php echo $back_jump; ?>library/bootstrap/main.css">
      <link rel="stylesheet" href="<?php echo $back_jump; ?>library/system/main.css">
      <link rel="stylesheet" href="<?php echo $back_jump; ?>library/system/layout.css">
      <link rel="stylesheet" href="<?php echo $back_jump; ?>library/fnt/css/all.css">

      <script
              src="https://code.jquery.com/jquery-3.6.0.js"
              integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
              crossorigin="anonymous"></script>
      <script src="<?php echo $back_jump; ?>library/bootstrap/main.js"></script>
      <script src="<?php echo $back_jump; ?>library/scripts/main.js"></script>

      <title>Music 101</title>
  </head>
  <body>
  <div id="popwindow"></div>
  <?php
  if(in_array($uri[1],$urls)){
      switch($uri[1]){
          case "login":
              return include_once "./pages/login.php";
          case "register":
              return include_once "./pages/register.php";
          default:
              return include_once "./pages/system.php";
      }

  }else{
      include_once "./pages/system.php";
  }
  ?>
  </body>
</html>
