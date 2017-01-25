<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';

if(isset($_POST['type'])){
	$type = $_POST['type'];
	if (!empty($type)){
		$query = "SELECT `id` FROM `items_type` WHERE `type` = :type";
		$sth = $dbh->prepare($query);
		$sth->bindParam(':type',$type,PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		if($result['id']>0){
			$_SESSION['type_exists'] = 1;
			header('location: admin_dashboard_addtype.php');
		} else {
		$query = "INSERT INTO `items_type` (type,admin_id) VALUES (:type,:admin)";
		$sth=$dbh->prepare($query);
		$sth->bindParam(':type',$type,PDO::PARAM_STR);
		$sth->bindParam(':admin',$_SESSION['admin_id'],PDO::PARAM_INT);
		if ($sth->execute()){
			$_SESSION['type_added'] = 1;
			header('Location: admin_dashboard_addtype.php');
		} else {
			$_SESSION['type_added'] = 20;
			header('Location: admin_dashboard_addtype.php');
		}}
	} else {
			$_SESSION['type_added'] = 20;
			header('Location: admin_dashboard_addtype.php');
	}
	
}
?>