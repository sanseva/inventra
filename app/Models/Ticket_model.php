<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * @author sdas
 *
 */
class Ticket_model extends Model {

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
            'subject' => makeSafe($this->request->getPost('subject')),
            'description' => makeSafe($this->request->getPost('description')),
            'user_id' =>  $user_id
        ];

        $builder = $this->db->table('tickets'); // Set the table name
 
        // Insert data into the database
        $builder->insert($data);


    }

    public function getempdata(){

        $user_id = $this->session->get('user_id'); // Example key
        $user_type = $this->session->get('user_type'); // Assuming you store user type in session
        // $user_type = 'U'; // Assuming you store user type in session

        $sql   ="SELECT 
                            tickets.id,
                            tickets.user_id,
                            tickets.subject,
                            tickets.description,
                            tickets.status,
                            tickets.priority,
                            tickets.created_at,
                            employee.fname,
                            employee.lname 
                        FROM tickets 
                        LEFT JOIN employee ON tickets.user_id = employee.user_id ";

        if ($user_type == 'U') 
        {
            $sql .= " WHERE tickets.user_id = " . $this->db->escape($user_id);
        }

        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }

    public function deletedata() 
    {
        $id = $this->request->getPost('id');

        $builder = $this->db->table('tickets'); // Set the table name
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
        $sql   ="SELECT * FROM tickets where id = $id";
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