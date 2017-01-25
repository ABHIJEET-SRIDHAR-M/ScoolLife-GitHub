<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';
	if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])){
		//Product id containes delete_id. Remove delete_
		$id = substr($_REQUEST['id'],7);
		//Delete Product based on ID
		$query = "DELETE FROM `items` WHERE `id` = :id";
		$sth = $dbh->prepare($query);
		$sth->bindParam(':id',$id,PDO::PARAM_INT);
		$sth->execute();
		if($sth->rowCount() == 1){
			echo 'success';
		} else if ($sth->rowCount() == 0){
			echo 'fail';
		}
	} else echo 'id not received';
?>