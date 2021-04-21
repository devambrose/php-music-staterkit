<?php

ini_set('display_errors','1');

include "ajax_handler.php";
$data=new appManager();

class appManager{
    private $helper;
    function __construct(){
        $this->helper=new ajax_handler();
     if(isset($_GET['sq'])){
         switch ($_GET['sq']){
             case 1:
                 return $this->generate(true,$this->helper->menuManager());
             case 2:
                 return $this->generate(true,$this->helper->handleAlbumManagement());
         }

     }else{
         return $this->generate(false,"Please assign a function");
     }
    }
    function generate($status,$content){
        echo json_encode(array("status"=>$status,"content"=>$content));
    }
}
