<?php
include("connect/conn.php");
$sql = "SELECT * FROM amphures WHERE province_id={$_GET['province_id']}";
$query = mysqli_query($con, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);