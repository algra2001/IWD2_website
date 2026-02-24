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
// and from class code
// A function to validate query parameters entered in form
    function validate(form) {
	const taxon = form.taxon.value.trim();
	const protFam = form.prot_fam.value.trim();
	let fail = "";
	if (taxon.length === 0) {
		fail += 'Taxon cannot be empty. '; 
	} else if (taxon.length < 2) {
		fail += 'Taxon must contain at least two letters. ';
	}
	if (protFam.length === 0) {
		fail += 'Protein family cannot be empty. '; 
	} else if (protFam.length < 2) {
		fail += 'Protein family  must contain at least two letters. ';
	}
	// Checking for permitted characters, defining patterns
	// TODO: maybe allow taxon id as well as of taxon name
	const taxPat = /^[a-zA-Z -]{2,}$/;
	// General guidelines for protein names taken from: https://www.ncbi.nlm.nih.gov/genbank/internatprot_nomenguide/#2-formats-for-protein-names
	const protPat = /^[\w '\,\+\/\(\)-]{2,}$/;
	// Alerting error
	if(taxon.length >= 2 && !taxPat.test(taxon)) fail += "Taxon contains illegal characters. ";
	if(protFam.length >= 2 && !protPat.test(protFam)) fail += "Protein contains illegal characters.";
	if(fail === "") {
		return true;
	} else { 
		alert(fail); 
		return false;
	}
}
</script>
<br/>
<!-- form to retrieve query parameters -->
<form action="result_page.php" method="post" onsubmit="return validate(this)">
<p>Enter query parameters: taxonomic group and protein family</p>  
<table>
    <tr>	
      <td>Taxonomic group:</td><td><input type="text" name="taxon" maxlength="100"/></td>
    </tr>
    <tr>
      <td>Protein family:</td><td><input type="text" name="prot_fam"/></td>
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
