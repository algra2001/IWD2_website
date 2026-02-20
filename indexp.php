<?php // Adapted from class code
// Checking user name is set
session_start();
if(isset($_POST['user_name'])) {
    echo<<<_HEAD1
    <html>
    <body>
_HEAD1;
    include 'menuf.php';
    $_SESSION['user_name'] = $_POST['user_name'];
echo <<<_TAIL1
<pre>
</pre>
</body>
</html>
_TAIL1;
// Otherwise rerouting to get user name
    } else { 
  header('location: https://bioinfmsc8.bio.ed.ac.uk/~s2883992/website/user_name.php');
  }
?>
