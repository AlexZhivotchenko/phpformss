<?php 
    session_start();
    $con = new PDO('mysql:host=127.0.0.1;dbname=userlistdb', 'root', '') or die("Cannot select DB");

if(isset($_POST["register"])){


if(!empty($_POST['email']) && !empty($_POST['login']) && !empty($_POST['real_name']) && !empty($_POST['password']) && !empty($_POST['age']) && !empty($_POST['nameCountry'])) {
	
	$email = $_POST['email'];
	$login = $_POST['login'];
	$real_name = $_POST['real_name'];
	$password = $_POST['password'];
	$age = $_POST['age'];
	$nameCountry = $_POST['nameCountry'];

	$sqlcode = "SELECT * FROM usertbl WHERE login='".$login."' OR email='".$email."'";
	$res = $con->query($sqlcode);
	$numrows = $res->rowcount();
	//var_dump($numrows);
	if($numrows == 0) {
		
	   $dateunix = time();
	   $sql="INSERT INTO usertbl
	   (login, email, real_name, password, age, nameCountry, sessiondate) 
	   VALUES('$login','$email', '$real_name', '$password', '$age', '$nameCountry', '$dateunix')";
	   $result=$con->query($sql);
     
	   if($result) {
		  $_SESSION['session_username'] = $login;
		  $_SESSION['session_email'] = $email;
          header("Location: intropage.php");
	   }  
	} 
	else {
	    $message = "That username or email already exists! Please try another one!";
	    header('Location: index.php'); 
	}

}  
   else {
	   header('Location: index.php'); 
	   $message = "All fields are required!";
		
   }
}
 $_SESSION['session_message'] = $message;
?>
	

	
