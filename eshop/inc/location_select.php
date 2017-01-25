<?php
include '../../common_files/core_inc.php';
if (isset($_REQUEST['loc_id'])){
	$_SESSION['location'] = $_REQUEST['loc_id'];
}
?>