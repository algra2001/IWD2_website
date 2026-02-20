<?php // Adapted from class code
session_start();
require_once 'login.php';
echo<<<_HEAD1
<html>
<body>
_HEAD1;

// Checking connection to database using details from login.php
try {
	$dsn = "mysql:host=127.0.0.1;dbname=$database;charset=utf8mb4";
	$conn = new PDO($dsn, $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "\nConnected successfully to the database!<br/>";
} catch(PDOException $e) {
	echo "<br/><br/><b><font color=\"red\">Connection failed</font></b>:<br/>" . $e->getMessage();
}
   echo <<<_EOP
<script>
// Adapted from: https://www.geeksforgeeks.org/javascript/username-validation-in-js-regex/
// and from class
// A function to validate user name entered at form
    function validate(form) {
	let fail = "";
	const userName = form.user_name.value.trim();
	if(userName === "") {
// Checking for value
	fail = "Username cannot be empty.";
// Checking for length
	} else if(userName.length < 6) {
	fail = "Username is too short.";
	} else if(userName.length > 16) {
	fail = "Username is too long.";
// Checking for permitted characters
	} else {
	const pattern = /^[a-zA-Z0-9_]{6,16}$/;
// Alerting error
	if(!pattern.test(userName)) fail = "Username contains illegal characters";
	}
	if(fail === "") {
		return true;
	} else { 
		alert(fail); 
		return false;
	}
}
</script>
<br/>
<!-- form to retrieve user name -->
<form action="indexp.php" method="post" onsubmit="return validate(this)">
<p>Enter a user name to save results. Can contain letters, numbers and underscores. 
<br/>Must be between 6 and 16 characters long.<p/>  
<table>
    <tr>	
      <td>User name:</td><td><input type="text" name="user_name"/></td>
    </tr>
  </table>
<br/><input type="submit" value="submit" />
</form>
_EOP;

echo <<<_TAIL1
</body>
</html>
_TAIL1;

?>
