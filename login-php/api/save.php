<?php

include("sql.php");

$image = $_POST["image_url"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$email = $_POST["email"];

//$image = 'IMG_20170611_140500420.jpg';
//$phone = '8374873847';
//$address = 'sahbs Street, California';
//$email = 'sush@gmail.com';

 $sql = "UPDATE users SET image = '$image', phone = '$phone', address = '$address' WHERE email = '$email'";

$result = mysqli_query($conn, $sql);

$data = array();
$data1 = array();

if(true===$result){
    
      $sql1 = "select * from users";
    $result1 = mysqli_query($conn, $sql1);
    if($result1){
    if(mysqli_num_rows($result1) > 0){
    while($row= mysqli_fetch_row($result1)){
       
        $data['id']=$row[0];
        $data['name']=$row[1];
        $data['email']=$row[2];
        $data['image']=$row[4];
       array_push($data1, $data);
       
    }
  
   //echo "<pre>";Print_r($data1);die;
   $res = array("status" => "success", "data" => array_values($data1));    
    }
    }
}
else{
   $res = array("status" => "failed", "data" => mysqli_error($conn));  
}

$res = json_encode($res);
echo $res;
mysqli_close($conn);


?>
