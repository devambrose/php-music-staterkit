<?php
class database{

    function __construct(){
        $this->config=new config();

        while(!$this->con=mysqli_connect($this->config->host,$this->config->user,$this->config->password)){

            if($count>2000){

                echo "Could not connect to the database";

                exit;

            }

            $count++;

        }

        mysqli_select_db($this->con,$this->config->name);
    }
    function selectQuery(/*fields array*/$fields,$table,$where){

        $columns=implode(",",$fields);

        $mysqli_query= "select $columns from $table $where";

        $resource= mysqli_query($this->con,$mysqli_query) or die(mysqli_error($this->con));

        return $resource;
    }
    function insertQuery($fields,$table,$data){
        $columns=implode(",",$fields);
        $information=implode(",",$data);



        $resource= mysqli_query($this->con,"insert into $table ($columns) values ($information)") or die(mysqli_error($this->con));

        echo mysqli_error($this->con);

        return mysqli_insert_id($this->con);

    }

}