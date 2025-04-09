<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Common_controller extends BaseController {

	public function __construct() {
		$this->common_model = model("Common_model");
		$this->common_model->isloggedIn();
	}

	public function suppliers()
	{
		echo json_encode($this->common_model->get_suppliers_selection());
		
	}
	public function retailers()
	{
		echo json_encode($this->common_model->get_retailer_selection());
		
	}
	public function removeSessionVariable()
	{
		 session()->remove('session_work_order_no');
		 session()->remove('session_work_order_type');
	    	return $this->response->setJSON(['status' => 'success', 'message' => 'Session removed successfully']);
	}
	
}
