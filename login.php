<?php
session_start();
?>
<?php
if(isset($_SESSION["session_username"])) {
// echo "Session is set"; // for testing purposes
header("Location: intropage.php");
} 

$con = new PDO('mysql:host=127.0.0.1;dbname=userlistdb', 'root', '') or die("Cannot select DB");

if(isset($_POST["logins"])) {

if(!empty($_POST['login']) && !empty($_POST['password'])) {
    $login=$_POST['login'];
    $password=$_POST['password'];

    $sql ="SELECT * FROM usertbl WHERE login='".$login."' OR email='".$login."' AND password='".$password."'";
    $numrows = $con->query($sql);
    $row = $numrows->fetchAll(PDO::FETCH_ASSOC);
	
    if($numrows!=0)
    
    {

	extract($row);
	$rows = $row[0];
    $dblogin = $rows['login'];	
    $dbpassword = $rows['password'];
	$dbemail = $rows['email'];
	
       if(($login == $dblogin || $login == $dbemail) && $password == $dbpassword) {

         $_SESSION['session_username'] = $dblogin;
		 $_SESSION['session_email'] = $dbemail;
         /* Redirect browser */
         header("Location: intropage.php");
       }
   
	   else {
        $messages =  "Invalid username or password!";
       }
    }
   }
	 else {
        $messages = "All fields are required!";
     }
	 
  
}

?>
<?php include("includes/header.php"); ?>
<?php if (!empty($messages)) {echo "<p class=\"error\">" . "MESSAGE: ". $messages . "</p>";} ?>

<div class="container mlogin">
	<div id="login">
		<h3>LOGIN</h3>
		<form name="loginform" id="loginform" action="" method="POST">
			<p>
				<label for="user_login">Username/email
					<br />
					<input type="text" name="login" id="username" class="input" value="" size="20" />
				</label>
			</p>
			<p>
				<label for="user_pass">Password
					<br />
					<input type="password" name="password" id="password" class="input" value="" size="20" />
				</label>
			</p>
			<p class="submit">
				<input type="submit" name="logins" class="button" value="Log In" /> </p>
			<p class="regtext">No account yet? <a href="index.php">Register Here</a>!</p>
		</form>
	</div>
</div>
	
	<?php include("includes/footer.php"); ?>
	

	