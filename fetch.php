<?php
//fetch.php


if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "bookexam");
 $output = '';

 if($_POST["action"] == "cmbsbjct")
 {

    $output = trim($_POST['cmbsbjct']);
    $output = strip_tags($output);
    $output = htmlspecialchars($output);
    
 }
 echo $output;
}
?>
