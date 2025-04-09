<?php
namespace App\Models;
use CodeIgniter\Model;

class Common_model extends Model {

	function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();
		$this->request = \Config\Services::request();

	}

	public function isloggedIn()
	{
		if (!$this->session->get('user_id')) 
		{
			header('Location: ' . base_url('/login'));
			exit();
		}
	}

	public function checkPermission()
	{
		$emp_id = $this->session->get('user_id');
		$sql = " SELECT code FROM permissions where emp_id = ".$emp_id; 
        $query = $this->db->query($sql)->getResultArray();
        return $query;
	}
	 
}//class