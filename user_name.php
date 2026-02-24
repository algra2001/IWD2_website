<?php // Adapted from class code
session_start();
require_once 'login.php';
echo<<<_HEAD1
<html>
<body onload="displayForm()">
_HEAD1;

//TODO: add a nice welcome message
//
echo<<<_WELCOME
<h1>Website name</h1>
<h2>Welcome message to the users, perhaps a short description</h2>
_WELCOME;

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
// and from class code
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
	const pattern = /^[\w]{6,16}$/;
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
<!--TODO: perhaps add an optional choice of cookies instead of username-->
<!--Deciding whether to save resulst-->

<script>
// form to retrieve user name if saving
function displayForm()
{
document.getElementById("save_choice").innerHTML=`<form action="indexp.php" method="post" onsubmit="return validate(this)">
<p>Enter a user name to save results. Can contain letters, numbers and underscores. 
<br/>Must be between 6 and 16 characters long.<p/>  
<table>
    <tr>	
      <td>User name:</td><td><input type="text" name="user_name"/></td>
    </tr>
  </table>
<br/><input type="submit" value="submit" />
</form>`;
}

// deleting form if not saving
function delForm()
{
document.getElementById("save_choice").innerHTML=`<form action="indexp.php" method="post">
<input type="hidden" name="user_name" value="no-save" />
<p><input type="submit" value="continue" /></p>
</form>`;
}
</script>

<!-- displaying options for saving results -->
<p>
<input type="radio" name="save_choice" id="save_yes" value="save" onclick="displayForm()" checked>
<label for="save_yes">Save results</label>
</p>
<p>
<input type="radio" name="save_choice" id="save_no" value="no-save" onclick="delForm()">
<label for="save_no">Don't save results</label>
</p>
<p id="save_choice"></p>
_EOP;

echo <<<_TAIL1
</body>
</html>
_TAIL1;

?>
