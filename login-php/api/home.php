<?php

include("sql.php");

$name = $_POST["name"];
//$name = 'sush';
$data = array();
$data1 = array();
$sql = "select * from users where name!='$name'";

$result = mysqli_query($conn, $sql);

if($result){
    if(mysqli_num_rows($result) > 0){
    while($row= mysqli_fetch_row($result)){
        //array_push($data, $row);
        $data['id']=$row[0];
        $data['name']=$row[1];
        $data['email']=$row[2];
        $data['image']=$row[4];
       array_push($data1, $data);
        
    }
        //echo "<pre>";Print_r($data1);die;
        $res = array("status" => "success", "data" => array_values($data1));
    }
    else{
        $res = array("status" => "failed", "data" => 'failed');
    }
    
}
else{
   $res = array("failed" => true, "data" => mysqli_error($conn)); 
}

$res = json_encode($res);

echo $res;
mysqli_close($conn);

?>