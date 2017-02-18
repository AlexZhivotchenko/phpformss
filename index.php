<?php 
    session_start();
    include("includes/header.php"); 
    if (!empty($_SESSION['session_message'])) 
	    {
		   echo "<p class=\"error\">" . "MESSAGE: ".  $_SESSION['session_message'] . "</p>";
		} 
    $con = new PDO('mysql:host=127.0.0.1;dbname=userlistdb', 'root', '') or die("Cannot select DB");
    
    $sql = "SELECT nameCountry FROM country";
    $result_select = $con->query($sql);
?>
<div class="container mregister">
	<div id="login">
		<h3>REGISTER</h3>
		<form name="registerform" id="registerform" action="register.php" method="post">
			<p>
				<label for="confirm_email">Email<em>*</em>
					<br />
					<input type="email" name="email" id="email" class="input" value="" size="32" required/> 
				</label>
			</p>
			<p>
				<label for="user_login">Login<em>*</em>
					<br />
					<input type="text" name="login" id="login" class="input" value="" size="32" required />
				</label>
			</p>
			<p>
			<p>
				<label for="real_name">Real Name<em>*</em>
					<br />
					<input type="text" name="real_name" id="real_name" class="input" size="32" value="" required /> 
				</label>
			</p>
            <p>
				<label for="user_pass">Password<em>*</em>
					<br />
					<input type="password" name="password" id="password" class="input" placeholder="minimum size - 4 characters" size="32"  pattern="[A-Za-zА-Яа-яЁё]{4,}" />
				</label>
			</p>
			<p>
				<label for="age">birth date<em>*</em>
                    <br />
                    <input  id="age" name="age" class="input" type="date" value="02-04-1950" min="1920-01-01" required>
                </label>
			</p>
			<p>
				<label for="country">country<em>*</em>
                    <br />
                   <?php  echo "<select name = 'nameCountry' class='input' required>";

                        while($object = $result_select->fetch(PDO::FETCH_OBJ)){
                           echo "<option value = '$object->nameCountry' > $object->nameCountry </option>";
                        }

                    echo "</select>";

                   ?>
                </label>
			</p>
			<p>
                <label for="agree">
                   <input type="checkbox" name="agree"  onclick="agreeForm(this.form)" required> Я согласен со всеми условиями 
                </label>     
			</p>
			<p class="submit">
				<input type="submit" name="register" id="register" class="button" value="Register"  /> </p>
			<p class="regtext">Already have an account? <a href="login.php">Login Here</a>!</p>
		</form>
		</div>
</div>
	
	<?php include("includes/footer.php"); ?>
