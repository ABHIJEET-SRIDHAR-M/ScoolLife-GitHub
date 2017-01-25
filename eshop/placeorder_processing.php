<?php
include 'inc/core_inc.php';

// Process Sender details. Upload to db and set session variable
if (isset($_POST['name_sender']) && isset($_POST['email_sender']) && isset($_POST['phone_sender'])){
	if (!empty($_POST['name_sender']) && !empty($_POST['email_sender']) && !empty($_POST['phone_sender'])){
		if (isset($_SESSION['sender_details']) && isset($_SESSION['order_id'])){
		$order_id = $_SESSION['order_id'];
		$_SESSION['email_customer'] = $_POST['email_sender'];
		$query = "UPDATE `orders` SET `nameofsender` = :name,`emailofsender` = :email,`phoneofsender` = :phone,`user_ip` = :ip, `user_ip_proxy` = :ip_proxy WHERE `id` = '$order_id'";	
		} else {
		$query = "INSERT INTO `orders` (nameofsender,emailofsender,phoneofsender,user_ip,user_ip_proxy) VALUES (:name,:email,:phone,:ip,:ip_proxy)";
		}
		$sth = $dbh->prepare($query);
		$sth->bindParam(':name',$_POST['name_sender'],PDO::PARAM_STR);
		$sth->bindParam(':email',$_POST['email_sender'],PDO::PARAM_STR);
		$sth->bindParam(':phone',$_POST['phone_sender'],PDO::PARAM_STR);
		$sth->bindParam(':ip', $_SERVER['REMOTE_ADDR'],PDO::PARAM_STR);
		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip_proxy = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip_proxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
				$ip_proxy = "None";
		}
		$sth->bindParam(':ip_proxy', $ip_proxy,PDO::PARAM_STR);
		$sth->execute();
		if(!isset($_SESSION['order_id'])){
		$_SESSION['order_id'] = $dbh->lastInsertId();
		}
		$_SESSION['sender_details'] = 1;
		header('location: placeorder_deliverydetails.php');
	} else {
		header('Location: placeorder.php');
	}
}

if (isset($_POST['name_recipient']) && isset($_POST['address_recipient_line1'])  && isset($_POST['address_recipient_line2']) && isset($_POST['phone_recipient']) && isset($_POST['notify_recipient']) && isset($_POST['pincode_recipient']) && isset($_POST['delivery_date']) && isset($_POST['delivery_time']) && isset($_POST['delivery_message'])){
	if(!empty($_POST['name_recipient']) && !empty($_POST['address_recipient_line1'])&& !empty($_POST['address_recipient_line2']) && !empty($_POST['phone_recipient']) && !empty($_POST['notify_recipient']) && !empty($_POST['pincode_recipient']) && !empty($_POST['delivery_date']) && !empty($_POST['delivery_time']) && !empty($_POST['delivery_message'])){
		if ($_POST['notify_recipient'] == 1){
			$notify = 1;
		} else {
			$notify = 0;
		}
		$location = getfield('locations','location','id',$_SESSION['location']);
		$id = $_SESSION['order_id'];
		$query = "UPDATE `orders` SET `nameofrecipient` = :name, `addressofrecipient_line1` = :address_1,`addressofrecipient_line2` = :address_2, `locationofrecipient`= :location , `pincodeofrecipient` = :pincode,`phoneofrecipient` = :phone, `notifyrecipient` = :notify, `deliverydate` = :date, `deliverytime` = :time, `deliverymessage` = :message, `customize` = :customize WHERE `id` = :id";
		$sth = $dbh->prepare($query);
		$sth->bindParam(':name',$_POST['name_recipient'],PDO::PARAM_STR);
		$sth->bindParam(':address_1',$_POST['address_recipient_line1'],PDO::PARAM_STR);
		$sth->bindParam(':address_2',$_POST['address_recipient_line2'],PDO::PARAM_STR);
		$sth->bindParam(':location',$location,PDO::PARAM_STR);
		$sth->bindParam(':pincode',$_POST['pincode_recipient'],PDO::PARAM_INT);
		$sth->bindParam(':phone',$_POST['phone_recipient'],PDO::PARAM_STR);
		$sth->bindParam(':notify',$notify,PDO::PARAM_INT);
		$sth->bindParam(':date',$_POST['delivery_date'],PDO::PARAM_STR);
		$sth->bindParam(':time',$_POST['delivery_time'],PDO::PARAM_INT);
		$sth->bindParam(':message',$_POST['delivery_message'],PDO::PARAM_STR);
		$sth->bindParam(':customize',$_POST['customize'],PDO::PARAM_STR);
		$sth->bindParam(':id',$id,PDO::PARAM_INT);
		
		$sth->execute();
		$_SESSION['delivery_details'] = 1;
		header('Location: placeorder_confirmation.php');
	} else {
		header('Location: placeorder_deliverydetails.php');
	}
}

?>