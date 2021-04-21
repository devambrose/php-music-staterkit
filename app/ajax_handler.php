<?php

include_once ("./../config.php");
include_once "./../app/database_connector.php";
 class ajax_handler{
     function __construct()
     {
         $this->db=new database();
     }
     public function menuManager(){
        switch ($_POST['bt']){
            case "discover":
                return $this->showDiscovery();
            case "prof":
                return $this->profileManager();
                break;
            case "libary":
                return $this->libraryView();
            default:
                return $_POST['bt'];
        }

     }
     function showHome(){

 }
     function showDiscovery(){
         $cont= new stringManager();

         $tracks=$this->getTracks(' ');

         $cont->generalTags("<div class='app-left app-full app-grid' style='grid-template-columns:20% 20% 20% 20% 20%'>");

         for($i=0;$i<count($tracks);$i++){
             $cont->generalTags("<div class='tracks app-round app-left app-padding-large'>".$tracks[$i]->name."</div>");
         }

         $cont->generalTags("</div>");

         return $cont->toString();
     }
     public function libraryView(){
         $cont= new stringManager();

         $tracks=$this->getTracks(' ');

         $cont->generalTags("<div class='app-left app-full app-grid' style='grid-template-columns:80% 19%'>");

         $cont->generalTags("<div class='app-left app-full'>");

         for($i=0;$i<count($tracks);$i++){
             $cont->generalTags("<div class='tracks app-round app-left app-padding-large'>".$tracks[$i]->name."</div>");
         }

         $cont->generalTags("</div>");

         $cont->generalTags("</div>");

         return $cont->toString();
     }
     function handleAlbumManagement(){

         switch ($_POST['ip']){
             case 1:
                $this->db->insertQuery(['genre','name','artist','date_created'],'albums',["'".$_POST['sel']."'","'".$_POST['name']."'","'".$_POST['artist']."'","'".$_POST['date']."'"]);

                return $this->showTableUi();
             case 2:
                 $this->db->insertQuery(['album','name'],'tracks',["'".$_POST['id']."'","'".$_POST['name']."'"]);

                 return "working";
         }
     }
     private function profileManager(){
         $cont= new stringManager();

         $cont->generalTags("<div class='app-left app-full app-grid container' style='grid-template-columns: 80% 20%;display: grid'>");

         $cont->generalTags("<div class='app-left'>");

         //$cont->generalTags($this->personalLibrary());

         $cont->generalTags($this->showSellersLibrary());

         $cont->generalTags("</div>");

         $cont->generalTags("<div class='app-left app-border-left'>");

         $cont->generalTags("<h4 class='app-left app-full app-border-bottom'>Following</h4>");

         $cont->generalTags("<div class='app-left app-full app-padding app-border-bottom app-hover-light-blue'>Ambrose Mwangi</div>");

         $cont->generalTags("<div class='app-left app-full app-padding app-border-bottom app-hover-light-blue'>James olson</div>");

         $cont->generalTags("<div class='app-left app-full app-padding app-border-bottom app-hover-light-blue'>Muine Kanyuira</div>");

         $cont->generalTags("</div>");

         $cont->generalTags("</div>");

         return $cont->toString();
     }
     function personalLibrary(){// show the user interface for a personal user
         $cont= new stringManager();

         $music=$this->getTracks(" ");

         $cont->generalTags("<h3>My Library</h3>");

         $cont->generalTags("<div class='app-left app-full '>");

         for($i=0;$i<count($music);$i++){
             $cont->generalTags("<div class='app-left app-flex detail'>");

             $cont->generalTags("<div id='' style='background:url(./../images/recorder.png)'></div>");

             $cont->generalTags("<p>".$music[$i]->name."</p>");

             $cont->generalTags("</div>");
         }



         $cont->generalTags("</div>");

         return $cont->toString();
     }
     function getLibrary(){
         $res=$this->db->selectQuery(['*'],'albums','');

         $data=array();

         while($row=mysqli_fetch_row($res)){

             $album=new stdClass();

             $album->id=$row[0];
             $album->name=$row[1];
             $album->genre=$row[2];
             $album->artist=$row[3];
             $album->dateOf=$row[4];
             $album->tracks=$this->getTracks("where album=".$row[0]);
             $data[]=$album;
         }
         return $data;
     }
     function getTracks($whereclause){
         $res=$this->db->selectQuery(["*"],"tracks",$whereclause);

         $data=array();

         while($row=mysqli_fetch_row($res)){
             $track=new stdClass();

             $track->id=$row[0];
             $track->name=$row[1];

             $data[]=$track;
         }
         return $data;
     }
     function showSellersLibrary(){//show the music producers laypout
         $cont= new stringManager();

         $cont->generalTags("<h3>My Galore</h3>");

         $cont->generalTags("<div class='app-left app-full app-grid' style='grid-template-columns: 79% 20%'>");

         $cont->generalTags("<div class='app-left '>");

         $cont->generalTags("</div>");

         $cont->generalTags("<div class='app-left app-margin-bottom '>");

         $cont->generalTags("<div class='btn btn-primary' id='createAlbum'>Create Album</div>");

         $cont->generalTags("</div>");

         $cont->generalTags("</div>");

         $cont->generalTags("<div id='album-container'>");

         $cont->generalTags($this->showTableUi());

         $cont->generalTags("</div>");
         return $cont->toString();
     }
     function showTableUi(){
         $cont= new stringManager();

         $data=$this->getLibrary();

         for($i=0;$i<count($data);$i++){
             $cont->generalTags("<div class='app-left album'>");

             $cont->generalTags("<div class='app-left cont app-margin-bottom'>");

             $cont->generalTags('<div class="app-left album-image" style="background: url(/../images/logo.jpg);background-size: cover"></div>');

             $cont->generalTags("<p>".ucfirst($data[$i]->name)."</p>");

             $cont->generalTags("</div>");

             $cont->generalTags("<div class='app-left app-flex details'>");

             $cont->generalTags("<div class='app-left app-full app-padding'>");

             $cont->generalTags("<div class='app-left record app-full'>");

             $cont->generalTags("<div class='app-padding app-light-gray  app-right tracksAdd' id='".$data[$i]->id."'>+ add track</div>");
             
             $cont->generalTags("<p>".ucfirst($data[$i]->artist)."</p>");

             $cont->generalTags("</div>");

             $cont->generalTags("</div>");

             $cont->generalTags("<div class='app-left app-full'>");

             for($k=0;$k<count($data[$i]->tracks);$k++){
                 $cont->generalTags("<div class='app-left app-round app-padding tracks' id=''>".$data[$i]->tracks[$k]->name."</div>");
             }

             $cont->generalTags("</div>");

             $cont->generalTags('<audio controls>  <source src="./../images/aha.mp3" type="audio/mpeg">Your browser does not support the audio element.</audio> ');

             $cont->generalTags("</div>");
             $cont->generalTags("</div>");
         }

         return $cont->toString();
     }
 }