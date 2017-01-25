<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
	if (isset($_REQUEST['type']) && !empty($_REQUEST['type'])){
		$type = $_REQUEST['type'];
		//Delete Products of the particular Type
		$id = getfield('items_type','id','type','sweets');
		$query = "DELETE FROM `items` WHERE `type` = :type";
		$sth = $dbh->prepare($query);
		$sth->bindParam(':type',$type,PDO::PARAM_STR);
		$sth->execute();
		//Delete the type
		$query = "DELETE FROM `items_type` WHERE `type` = :type";
		$sth = $dbh->prepare($query);
		$sth->bindParam(':type',$type,PDO::PARAM_STR);
		$sth->execute();
		if($sth->rowCount() == 1){
			echo 'success';
		} else if ($sth->rowCount() == 0){
			echo 'fail';
		} 
	}
?>