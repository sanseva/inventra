<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * @author sdas
 *
 */
class Employee_model extends Model {

	public function __construct() {
        parent:: __construct(); 
		$this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
    }


    public function save_data() {
         
        // Prepare data array for insertion
        $data = [
            'fname' => makeSafe($this->request->getPost('fname')),
            'lname' => makeSafe($this->request->getPost('lname')),
            'email_id' => makeSafe($this->request->getPost('email')),
            'phone' => makeSafe($this->request->getPost('phone')),
            'shiftname' => makeSafe($this->request->getPost('shift_name')),
            'shift_start' => makeSafe($this->request->getPost('shiftStart')),
            'shift_end' => makeSafe($this->request->getPost('shiftEnd')),
            'is_active' => makeSafe($this->request->getPost('is_active'))
        ];

        $builder = $this->db->table('employee'); // Set the table name
 
        // Insert data into the database
        $builder->insert($data);


    }

    public function getempdata() {
        $sql   ="SELECT user_id,fname,phone,lname,shiftname,email_id,password,shift_start,shift_end,is_active FROM employee";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }

    public function deleteemp() 
    {
        $id = $this->request->getPost('id');
        // Perform the delete operation

        $builder = $this->db->table('employee'); // Set the table name
        $builder->where('user_id', $id); // Add the condition for duplicate check
        $query = $builder->delete(); // Execute and store the query result

        if($query) 
        {
            // If deletion is successful, send a success response
            $msg = [
                'status' => 'success',
                'message' => 'Employee deleted successfully'
            ];
        } 
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to delete employee. Please try again.'
            ];
        }

        return $msg; 

    }

    public function getdatabyid() {

        $id = $this->request->getPost('id');
        $sql   ="SELECT * FROM employee where user_id = $id";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }

    public function update_data() {   

        $id = $this->request->getPost('idd');

        // Prepare data array for insertion
        $data = [
            'fname' => makeSafe($this->request->getPost('fname')),
            'lname' => makeSafe($this->request->getPost('lname')),
            'email_id' => makeSafe($this->request->getPost('email')),
            'phone' => makeSafe($this->request->getPost('phone')),
            'shiftname' => makeSafe($this->request->getPost('shift_name')),
            'shift_start' => makeSafe($this->request->getPost('shiftStart')),
            'shift_end' => makeSafe($this->request->getPost('shiftEnd')),
            'is_active' => makeSafe($this->request->getPost('is_active'))
        ];

        $builder = $this->db->table('employee'); // Set the table name
        $builder->where('user_id', $id); // Add the condition for duplicate check
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