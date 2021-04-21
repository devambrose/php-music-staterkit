<?php

 include_once "./app/database_connector.php";

 if(isset($_POST['password']) & isset($_POST['cpassword']) )
     if($_POST['password']==$_POST['cpassword'] & $_POST['password'] !=''){
        $db= new database();

       $id= $db->insertQuery(['username','usergender','password','email'],'user',
            ["'".$_POST['fullname']."'","'".$_POST['social']."'","md5('".$_POST['password']."')","'".$_POST['email']."'"]);


          echo "<div class='app-padding app-green'>User Added Succesfully</div>";

     }else{
         echo "<div class='app-padding app-red'>Please make sure that your passwords match</div>";
     }

 //if($_POST[''])

?>

<div class="app-grid app-center main-container">
    <form method="post" action="/register" name="login" id="login" class="app-border app-round app-padding">
        <div class="form-group">
            <label class="app-left app-full">Full name</label>
            <input class="form-control" id="fullname" name="fullname"/>
        </div>
        <div class="form-group">
            <label class="app-left app-full">Email address</label>
            <input class="form-control" id="email" name="email"/>
        </div>
        <div class="form-group">
            <label class="app-left app-full">Social</label>
            <input class="form-control" id="social" name="social"/>
        </div>
        <div class="form-group">
            <label class="app-left app-full">password</label>
            <input class="form-control" type="password" id="password" name="password"/>
        </div>
        <div class="form-group">
            <label class="app-left app-full">Confirm password</label>
            <input class="form-control" type="password" id="cpassword" name="cpassword"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary app-right">Submit</button>
        </div>
    </form>
</div>
