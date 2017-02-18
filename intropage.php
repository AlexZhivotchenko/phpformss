<?php 
session_start();
if(!isset($_SESSION["session_username"])) {
	header("location:login.php");
} 
else {

include("includes/header.php"); 
?>
<div id="welcome">	
	<h2>Welcome, <span><?php echo $_SESSION['session_username']; ?>! </span>email: <span><?php echo $_SESSION['session_email']; ?></span></h2>
	<p><a href="logout.php">Logout</a> Here!</p>
</div>

<?php include("includes/footer.php"); 
}
?>
