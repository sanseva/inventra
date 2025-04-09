<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * @author sdas
 *
 */
class Login_model extends Model {

	public function __construct() {
        parent:: __construct();
		// $this->permission_model = model('employee/Permission_model');
		$this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
    }
	
	public function index()
	{
		
	}
	
	public function check_ip()
    {
        $ip = $this->request->getIPAddress();
        $sql="select COUNT(*) as count from ip_range where ip_address='".$ip."' and is_active='1'";
		$query = $this->db->query($sql);
		$dataRes = $query->getRow();
    }
    	 
	/**
	 * 
	 * Checks login  ...
	 * @param $emp_id
	 * @param $pwd
	 */
	public function check_login($emp_id,$pwd,$login_type)
	{
	
		$data=array();

		$sql="select user_id,fname,user_type,email_id,is_active from employee where user_name='".makeSafe($emp_id)."' and password='".makeSafe($pwd)."'";

		$query = $this->db->query($sql);

		if($query->getNumRows() > 0 ){

			$row= $query->getRow();
			if($row->is_active=="N")
			{
				$data['true']=false;
				$data['msg']="Your account has been deactivated,Please contact admin";
			}
			else
			{
				$sessionData = array(
									
									'user_id' => $row->user_id,
									'user_name' => $row->fname,
									'user_email'=>$row->email_id,
									'user_type'=>$row->user_type,
									'isLoggedIn' => 'Y'
								);
 
				$this->session->set($sessionData);
				$data['success']=true;
				$data['msg']="";
			}
			 
		}else{
			$data['success']=false;
			$data['msg']="Invalid Username or password";
		}
	
		return $data;
	}
	public function logout() {
		
		$this->session->destroy();
	}

	public function save_temp_data() {

		$builder = $this->db->table('employee');

		// Check if email already exists
		$existing = $builder->where('email_id', makeSafe($this->request->getPost('email')))->get()->getRowArray();
 
		if ($existing) {
			return ['success' => false, 'message' => 'Email already exists!'];
		}
        // Prepare data array for insertion
        $data = [
            'fname' => makeSafe($this->request->getPost('fname')),
            'lname' => makeSafe($this->request->getPost('lname')),
            'email_id' => makeSafe($this->request->getPost('email')),
            'phone' => makeSafe($this->request->getPost('phone')),
            'shiftname' => makeSafe($this->request->getPost('shift_name')),
            'shift_start' => makeSafe($this->request->getPost('shiftStart')),
            'shift_end' => makeSafe($this->request->getPost('shiftEnd')),
            'is_active' => 'Y'
        ]; 
        $builder = $this->db->table('employee'); // Set the table name
		  
        // Insert data into the database
        
		// $builder->insert($data);
  
		if ($builder->insert($data)) {
			return ['success' => true, 'message' => 'Data saved successfully'];
        } else {
			return ['success' => false, 'message' => 'Insert failed'];
        }


		

    }


}//class