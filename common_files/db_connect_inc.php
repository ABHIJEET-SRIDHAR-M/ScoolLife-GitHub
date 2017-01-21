<?php
$user = "mukundan";
$pswd = "kalavathi";

try{
$dbh = new PDO('mysql:host=localhost;dbname=gifts', $user,$pswd);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Sorry.. Couldnt connect to database';
	file_put_contents('PDOErrors.txt',$e->message(),FILE_APPEND);
}

?>