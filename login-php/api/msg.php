<?php
include("sql.php");

$to_id = $_POST["to_id"];
$message = $_POST["message"];
$from_id = $_POST["from_id"];
$datetime = $_POST["datetime"];

//$to_id = 1;
//$message = "hey11";
//$from_id = 4;
//$datetime = "2019-5-25 9:21:14";


$data = array();
$data1 = array();

if( !$message &&  !$datetime){
    //$sql1 = "(select * from chat_list cl join users u on u.id = cl.to_id  ORDER BY datetime DESC LIMIT 10)ORDER BY datetime ASC";
    $sql1 = "(select * from chat_list cl join users u on u.id = cl.from_id where (cl.to_id='$to_id' and cl.from_id='$from_id') or (cl.to_id='$from_id' and cl.from_id='$to_id') ORDER BY datetime DESC LIMIT 10)ORDER BY datetime ASC";
    $result1 = mysqli_query($conn, $sql1);
    if($result1){
    if(mysqli_num_rows($result1) > 0){
    while($row= mysqli_fetch_row($result1)){
       
        $data['to_id']=$row[1];
        $data['message']=$row[2];
        $data['from_id']=$row[3];
        $data['datetime']=$row[4];
        $data['name']=$row[6];
        $data['image']=$row[9];
       array_push($data1, $data);
       
    }
  
   //echo "<pre>";Print_r($data);die;
       $res = array("status" => "success", "data" => array_values($data1));    
    }
    }
    else{
        
       $res = array("failed" => true, "data" => mysqli_error($conn)); 
    }
    
}
else{

$sql = "INSERT INTO chat_list (to_id,message,from_id,datetime)
VALUES ('$to_id','$message','$from_id','$datetime')";

$result = mysqli_query($conn, $sql);
if ( true===$result ) {

   $sql1 = "(select * from chat_list cl join users u on u.id = cl.from_id where (cl.to_id='$to_id' and cl.from_id='$from_id') or (cl.to_id='$from_id' and cl.from_id='$to_id') ORDER BY datetime DESC LIMIT 10)ORDER BY datetime ASC";
    $result1 = mysqli_query($conn, $sql1);
    if($result1){
    if(mysqli_num_rows($result1) > 0){
    while($row= mysqli_fetch_row($result1)){
       
        $data['to_id']=$row[1];
        $data['message']=$row[2];
        $data['from_id']=$row[3];
        $data['datetime']=$row[4];
        $data['name']=$row[6];
        $data['image']=$row[9];
       array_push($data1, $data);
       //print_r($row);
    }
  //die;
   //echo "<pre>";Print_r($data);die;
   $res = array("status" => "success", "data" => array_values($data1));    
    }
    }

  
} else {
    $res = array("failed" => true, "data" => mysqli_error($conn));
}
 }

$res = json_encode($res);
echo $res;
mysqli_close($conn);

?>