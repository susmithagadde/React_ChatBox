<?php


include("sql.php");
//$data = json_decode(file_get_contents('php://input'), true);
 $name = $_POST["name"];
 $email = $_POST["email"];
 $password= $_POST["password"];

//$response = array("success" => true, "name" => $name, "email" => $email, "password" => $password);

//$response = json_encode($response);

//echo $response;



$sql = "INSERT INTO users (name,email,password,image)
VALUES ('$name','$email','$password','dummy-user.png')";

$result = mysqli_query($conn, $sql);
if ( true===$result ) {

    $res = array("success" => true, "data" => 'inserted Successfully');

  
} else {
    $res = array("failed" => true, "data" => mysqli_error($conn));
}

$res = json_encode($res);
echo $res;
mysqli_close($conn);



         
 

?>