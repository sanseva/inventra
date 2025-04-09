<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author sdas
 *
 */
class Home_model extends CI_Model {

	
	
	public function home_details()
	{
		$data=array();
		$data['success']=false;
		$data['msg']="Problem during saving data";
		
		$sql="select count(BillNo) as BillCount  from billednodetails ";
		$query = $this->db->query($sql);
	   	$row= $query->row();
	  	$data['sales_count']= $row->BillCount;          	
								   
	    $sql="select count(PurchaseEntryNo) as pCount  from purchasemaster ";
		$query = $this->db->query($sql);
	   	$row= $query->row();
	  	$data['purchase_count']= $row->pCount;          	
								               
						
		return $data;
	}
	public function getcounts()
	{
		$sql="select count(BillNo) as BillCount from billednodetails";
		$query = $this->db->query($sql);
		$row = $query->row();
		$data['sales_count'] = $row->BillCount;

		$sql = "select count(PurchaseEntryNo) as pCount from purchasemaster";
		$query = $this->db->query($sql);
		$row = $query->row();
		$data['purchase_count'] = $row->pCount;

		return $data;  // Return the data to the controller
	}


}//class