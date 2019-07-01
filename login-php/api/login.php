<?php

include("sql.php");

 $name = $_POST["name"];
 $password= $_POST["password"];
 // $name = 'sush';
 //$password= '123';


$sql = "select * from users where name = '$name' and password='$password' ";


$result = mysqli_query($conn, $sql);


$user_logged = array();
if($result){
  
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result)) { 
            $user_logged['name'] = $row['name'];
            $user_logged['email'] = $row['email'];
            $user_logged['id'] = $row['id'];
        
        }
    // Print_r($user_logged);die;
        $res = array("status" => "success", "data" => $user_logged);
    }
    else{
        $res = array("status" => "failed", "data" => 'unable to login');
    }
}
else{
   $res = array("failed" => true, "data" => mysqli_error($conn)); 
}


$res = json_encode($res);
echo $res;
mysqli_close($conn);

?>