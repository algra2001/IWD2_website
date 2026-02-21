<?php
session_start();
require_once 'login.php';
//include 'redir.php';
echo<<<_HEAD1
<html>
<body>
_HEAD1;
include 'menuf.php';
// THE CONNECTION AND QUERY SECTIONS NEED TO BE MADE TO WORK FOR PHP 8 USING PDO... //
try {
        $dsn = "mysql:host=127.0.0.1;dbname=$database;charset=utf8mb4";
        $conn = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
        echo "<br/><br/><b><font color=\"red\">Connection failed</font></b>:<br/>" . $e->getMessage();
}

//$smask = $_SESSION['supmask'];
//$firstmn = False;
// Checking for query parameters

echo <<<_MAIN1
<!--
    <pre>
This is the catalogue retrieval Page  
    </pre>
-->
_MAIN1;
// Parameters for preparing the statement
// Building SQL query based on parameters
$compsel = "LOAD DATA LOCAL INFILE 'downloaded_sequences/example_record.csv' INTO TABLE sequences FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' (accession, organism, sequence);";
$stmt = $conn->prepare($compsel);
$stmt->execute(); 

//  echo "</pre>";

echo <<<_TAIL1
<!--
   <form action="p2.php" method="post"><pre>
       Max Atoms      <input type="text" name="natmax"/>    Min Atoms    <input type="text" name="natmin"/>
       Max Carbons    <input type="text" name="ncrmax"/>    Min Carbons  <input type="text" name="ncrmin"/>
       Max Nitrogens  <input type="text" name="nntmax"/>    Min Nitrogens<input type="text" name="nntmin"/>
       Max Oxygens    <input type="text" name="noxmax"/>    Min Oxygens  <input type="text" name="noxmin"/>
                   <input type="submit" value="list" />
</pre></form>
-->
</body>
</html>
_TAIL1;
?>
