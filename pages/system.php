<?php
 include_once "./app/ajax_handler.php";

 $ajax=new ajax_handler();
  if(!isset($_SESSION['system_name'])){
      header("location:/login");
      echo "<div class='app-left app-full'>Redirecting .....</div>";
  }else{
      $user=unserialize($_SESSION['system_name']);
  }
?>
<?php if(isset($_SESSION['system_name'])): ?>
<div class="row app-border-bottom">
    <div class="col-sm-1"></div>
    <div class="col-sm-10 app-padding">
        <div class="body-top">
            <nav class="nav app-padding menus active" id="home"><i class="fas fa-home"></i>Home</nav>
            <nav class="nav app-padding menus" id="discover"> Discover</nav>
            <nav class="nav app-padding menus" id="libary"><i class="fas fa-book-reader"></i> library</nav>
            <div class="form-group nav app-padding">
                <div class="fas fa-search app-left app-padding-top app-padding-left app-padding app-round app-border-left app-border-top app-border-bottom"></div>
                <input placeholder="Search" class="app-round input form-control app-left app-width-80">
            </div>
            <nav class="app-padding menus" id="sets">Settings</nav>
            <nav class="app-padding menus" id="prof"><i class="fas fa-user-cog"></i> <?php echo $user->username ?></nav>
            <nav class="app-padding menus" id="log"><i class="fas fa-power-off app-text-red"></i> </nav>
        </div>
    </div>
    <div class="col-sm-1"></div>
</div>
    <?php

echo $ajax->personalLibrary();

    ?>

<?php endif; ?>