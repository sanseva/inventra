<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * @author sdas
 *
 */
class Community_model extends Model {

	public function __construct() {
        parent:: __construct(); 
		$this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
    }


    public function save_data() {
         
        $user_id = $this->session->get('user_id'); // Example key
             // Prepare data array for insertion

        $data = [
            'name' => makeSafe($this->request->getPost('Name')),
            'date' => makeSafe($this->request->getPost('sdate')),
            'pname' => makeSafe($this->request->getPost('Pname')),
            'taxno' => makeSafe($this->request->getPost('taxno')),
            'mname' => makeSafe($this->request->getPost('mname')),
            'memberid' => makeSafe($this->request->getPost('memberid')),
            'claimno' => makeSafe($this->request->getPost('claimno')),
            'dos' => makeSafe($this->request->getPost('dos')),
            'createdby' =>  $user_id
        ];

        $builder = $this->db->table('community'); // Set the table name
 
        // Insert data into the database
        $builder->insert($data);


    }

    public function getdata(){

        $user_id = $this->session->get('user_id'); // Example key
        $user_type = $this->session->get('user_type'); // Assuming you store user type in session

        $sql   ="SELECT `id`, `name`, `date`, `pname`, `mname`, `claimno` FROM `community` WHERE 1";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }

    public function deletedata()
    {
        $id = $this->request->getPost('id');

        $builder = $this->db->table('community'); // Set the table name
        $builder->where('id', $id); // Add the condition for duplicate check
        $query = $builder->delete(); // Execute and store the query result

        if($query) 
        {
            // If deletion is successful, send a success response
            $msg = [
                'status' => 'success',
                'message' => 'Data deleted successfully'
            ];
        } 
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to delete data. Please try again.'
            ];
        }

        return $msg; 

    }

    public function getdatabyid() {

        $id = $this->request->getPost('id');
        $sql   ="SELECT * FROM community where id = $id";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }

    public function update_data() {      

        $id = $this->request->getPost('idd');
        $user_id = $this->session->get('user_id'); // Example key
         // Prepare data array for insertion
        $data = [
            'name' => makeSafe($this->request->getPost('Name')),
            'date' => makeSafe($this->request->getPost('sdate')),
            'pname' => makeSafe($this->request->getPost('Pname')),
            'taxno' => makeSafe($this->request->getPost('taxno')),
            'mname' => makeSafe($this->request->getPost('mname')),
            'memberid' => makeSafe($this->request->getPost('memberid')),
            'claimno' => makeSafe($this->request->getPost('claimno')),
            'dos' => makeSafe($this->request->getPost('dos')),
            'updateby' =>  $user_id
        ];

        $builder = $this->db->table('community'); // Set the table name
        $builder->where('id', $id); // Add the condition for duplicate check
        $query = $builder->update($data); // Execute and store the query result
  

    }

    public function getInactiveempdata() 
    {
        $sql   ="SELECT user_id,fname,phone,lname,shiftname,email_id,shift_start,shift_end,is_active,desk_no FROM employee where is_active = 'N' ";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }
     
    public function getactiveemp() 
    {
        $sql   ="SELECT user_id,fname,phone,lname,shiftname,email_id,shift_start,shift_end,is_active,desk_no FROM employee where is_active = 'Y' ";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }
    
   

	
	 
}//class