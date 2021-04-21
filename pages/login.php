<?php

ini_set('display_errors','1');

include_once "./app/database_connector.php";

 if(isset($_SESSION['system_name'])){
     header("location:/");
 }
  if(isset($_POST['password']) & isset($_POST['username'])){
      $db= new database();

      $res=$db->selectQuery(['*'],'user',"where email='".$_POST['username']."' and password=md5('".$_POST['password']."')");

      $obj=mysqli_fetch_object($res);

      if(isset($obj)){

          $_SESSION['system_name']=serialize($obj);

          echo "<div class='app-left app-green app-full app-padding'>Login Successfull</div>";

          header("location:/");
      }else{
          echo "<div class='app-left app-red app-full app-padding'>User doesnt exist</div>";
      }
  }else{
    //  echo "<div class='app-left app-red app-full app-padding'>User doesnt exist</div>";
  }
?>
 <div class="app-grid app-center main-container">
     <form method="post" action="/login" name="login" id="login" class="app-border app-round app-padding">
         <div class="form-group">
             <label class="app-left app-full">Email</label>
             <input class="form-control" id="username" name="username"/>
         </div>
         <div class="form-group">
             <label class="app-left app-full">Password</label>
             <input class="form-control" id="password" name="password"/>
         </div>
         <div class="form-group">
             <button type="submit" class="btn btn-primary app-right">Submit</button>
         </div>
     </form>
 </div>