<?php
exit;
ini_set('max_execution_time', 0);

require_once("con.php");

$sql = "SELECT RetCode from retailersinformation"; 
$res = mysql_query($sql);
if(mysql_num_rows($res)){
	while($singleComp = mysql_fetch_assoc($res)){
		$sql = "insert into vendor_organization_relation (vendor_id,organization_id) values ('".$singleComp['RetCode']."','2')"; 
		mysql_query($sql);
	}
}
?>