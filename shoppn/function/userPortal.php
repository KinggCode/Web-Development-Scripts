<?php
header('Access-Control-Allow-Origin: *');
require_once 'db_connection.php';

session_start();
$customerId = $_SESSION['customer_id'];
$customerName = $_SESSION['customer_name'];
// echo($adminId);

$query = "SELECT customer_id,customer_name,customer_email,customer_country,customer_city,customer_contact,customer_image,customer_address FROM customer where customer_id = '$customerId'";
$result = mysqli_query($connect,$query);
$count = mysqli_num_rows($result);

if($count == 0){
    echo("No user found!");
    exit();
}

$data = array();
    while($row_result=mysqli_fetch_object($result)){
       array_push($data, array("customer_id"=> $row_result->customer_id, "customer_name"=> $row_result->customer_name,"customer_email"=> $row_result->customer_email,"customer_country"=> $row_result->customer_country,"customer_city"=> $row_result->customer_city, "customer_contact"=> $row_result->customer_contact, "customer_image"=> $row_result->customer_image, "customer_address"=> $row_result->customer_address,));
    
}


echo(json_encode($data));

// echo json_encode($data);  //encoding php data into json 

?>