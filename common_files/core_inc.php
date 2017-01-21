<?php
ob_start();
session_start();

require 'db_connect_inc.php';
$current_file = $_SERVER['SCRIPT_NAME'];

/* function getfield_admin($field){
	global $dbh;
	$id =$_SESSION['admin_id'];
	$query = "SELECT $field FROM `admin` WHERE `id` = :id";
	$sth=$dbh->prepare($query);
	$sth->bindParam(':id',$id,PDO::PARAM_INT);
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	return $result[$field];
}
 */
function getfield($table,$field,$field_search,$field_value){
	global $dbh;
	$query = "SELECT $field FROM $table WHERE $field_search = '$field_value'";
	$sth = $dbh->query($query);
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	return $result[$field];
}
?>