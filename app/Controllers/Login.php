<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Login extends BaseController {

	function __construct()
	{
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->login_model = model("Login_model");
	}

	public function index()
	{
		return view('login' );
	}
	
	private function check_ip()
	{
        $this->login_model->check_ip();
    }

	public function check_login()
	{
		$emp_id = $this->request->getPost('user_id');
		$pwd = $this->request->getPost('user_pass');
		$login_type = "A";
 
		$data= $this->login_model->check_login($emp_id,$pwd,$login_type);

		echo json_encode($data);
	}

	public function logout(){
		
		/* $this->common_model->stock_balance(); */
		$this->login_model->logout();
		/* $this->load->dbutil();
		$prefs = array(
        'tables'        => array(),   // Array of tables to backup.
        'ignore'        => array(),                     // List of tables to omit from the backup
        'format'        => 'txt',                       // gzip, zip, txt
        'filename'      => 'backup_'.date('Y-m-d'),              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
		);
		
		$backup = $this->dbutil->backup($prefs);

		$db_name = 'backup-'. date("Y-m-d") .'.zip';
        $save = 'backup/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup);  */
		
		return redirect()->to(base_url().'login');
	}


	public function tettttt()
    {
        return view('empregister');
    }
	public function save_temp_data()
    { 
        $savedata = $this->login_model->save_temp_data();
		return $this->response->setJSON($savedata);
    }
}
