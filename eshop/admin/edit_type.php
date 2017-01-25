<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
	if (isset($_REQUEST['type_old']) && !empty($_REQUEST['type_old']) && isset($_REQUEST['type_new']) && !empty($_REQUEST['type_new'])){
		$type_old = $_REQUEST['type_old'];
		$type_new = $_REQUEST['type_new'];
		$query = "SELECT `id` FROM `items_type` WHERE `type` = :type";
		$sth = $dbh->prepare($query);
		$sth->bindParam(':type',$type_new,PDO::PARAM_STR);
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		if ($result['id'] > 0){
			echo 'exists';
		} else {
			$query = "UPDATE `items_type` SET `type` = :typenew WHERE `type` = :typeold";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':typenew',$type_new,PDO::PARAM_STR);
			$sth->bindParam(':typeold',$type_old,PDO::PARAM_STR);
			$sth->execute();
			if($sth->rowCount() == 1){
				echo 'success';
			} else if ($sth->rowCount() == 0){
				echo 'fail';
			}
		} 
	} else echo 'fail';
?>