<?php
require '../inc/core_inc.php';
require 'checksession_inc.php';



	if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['price']) && isset($_FILES['file']['name'])){
		$type = $_POST['product_type'];
		$title = $_POST['title'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$location = $_POST['location'];
		if(!empty($title) && !empty($description) && !empty($price)){
			$query = "INSERT INTO `items` (type,name,description,price,location,admin_id) VALUES (:type,:name,:description,:price,:location,:admin_id)";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':type',$type,PDO::PARAM_INT);
			$sth->bindParam(':name',$title,PDO::PARAM_STR);
			$sth->bindParam(':description',$description,PDO::PARAM_STR);
			$sth->bindParam(':price',$price,PDO::PARAM_INT);
			$sth->bindParam(':location',$location,PDO::PARAM_INT);
			$sth->bindParam(':admin_id',$_SESSION['admin_id'],PDO::PARAM_INT);
			$sth->execute();
			
			$item_id = $dbh->lastInsertId();
			$name_pic_received = $_FILES['file']['name'];
			$extension = substr($name_pic_received,strpos($name_pic_received,'.')+1);
			
			if ($extension == 'jpeg' || $extension == 'jpg'){
				$size = $_FILES['file']['size'];
				if($size !=0){
					$name = "img_".$item_id;
					$temp_name = $_FILES['file']['tmp_name'];
					$location = '../pics/'.$name.'.'.$extension;
					$location_save='pics/'.$name.'.'.$extension;
					if (move_uploaded_file($temp_name,$location)){
						$query = "UPDATE `items` SET `pic` = :path WHERE `id` = :id";
						$sth = $dbh->prepare($query);
						$sth->bindParam(':path',$location_save,PDO::PARAM_STR);
						$sth->bindParam(':id',$item_id,PDO::PARAM_INT);
						if ($sth->execute()){
							$_SESSION['item_add'] = 1;
							header('location: admin_productsdashboard.php');
						} else {
							$_SESSION['item_add'] = 0;
							header('location: admin_productsdashboard.php');
						}
					}
				} else {
					$_SESSION['item_add'] = 0;
					header('location: admin_productsdashboard.php');
				}	
			} else {
				$_SESSION['item_add'] = 0;
					header('location: admin_productsdashboard.php');
			}
		}
	} else {
		$_SESSION['item_add'] = 0;
		header('location: admin_productsdashboard.php');
	}
?>