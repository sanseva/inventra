<?php
namespace App\Models;
use CodeIgniter\Model;
use DateTime;

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
            'createdon'=> date('Y-m-d H:i:s'),
            'createdby' =>  $user_id
        ];

        $builder = $this->db->table('community'); // Set the table name
 
        // Insert data into the database
        $builder->insert($data);


    }

    public function getFilteredData($filters = [])
    {
    $builder = $this->db->table('community as c');
    $builder->select('c.id, c.name, c.date, c.pname, c.mname, c.claimno, e.fname, e.lname');
    $builder->join('employee as e', 'c.createdby = e.user_id', 'left');

    if (!empty($filters['name'])) {
        $builder->like('c.name', $filters['name']);
    }
    if (!empty($filters['date'])) {
        $builder->where('c.date', $filters['date']);
    }
    if (!empty($filters['pname'])) {
        $builder->like('c.pname', $filters['pname']);
    }
    if (!empty($filters['mname'])) {
        $builder->like('c.mname', $filters['mname']);
    }
    if (!empty($filters['claimno'])) {
        $builder->like('c.claimno', $filters['claimno']);
    }
    if (!empty($filters['createdby'])) {
        $builder->groupStart()
                ->like('e.fname', $filters['createdby'])
                ->orLike('e.lname', $filters['createdby'])
                ->groupEnd();
    }

    $builder->orderBy('c.id', 'DESC');
    return $builder->get()->getResultArray();
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
    
    public function getcommunitydata($id) 
    {
        $sql   ="SELECT `id`, `name`, `date`, `pname`, `taxno`, `mname`, `memberid`, `claimno`, `dos`, `createdon`, `createdby`, `updatedon`, `updateby` FROM `community` WHERE id = ".$id;
        $query = $this->db->query($sql)->getRowArray();
        return $query; 
    }

    public function save_excel($excelData ) {
         
        $user_id = $this->session->get('user_id'); // Example key
             // Prepare data array for insertion


            foreach ($excelData as $index => $row) {
                if ($index === 0) continue; // Skip header row
                // Save each row, e.g.:
                $excelDate = $row[1];
                if (is_numeric($excelDate)) {
                    $date = Date::excelToDateTimeObject($excelDate)->format('Y-m-d');
                } else {
                    // If it's a string like "10/30/2025", we parse it into the correct MySQL format
                    $date = DateTime::createFromFormat('m/d/Y', $excelDate)->format('Y-m-d');
                }
                // echo $date;exit;
                $excelDate1 = $row[7]; 
                if (is_numeric($excelDate)) {
                    $date1 = Date::excelToDateTimeObject($excelDate1)->format('Y-m-d');
                } else {
                    // If it's a string like "10/30/2025", we parse it into the correct MySQL format
                    $date1 = DateTime::createFromFormat('m/d/Y', $excelDate1)->format('Y-m-d');
                }

                $data = [
                    'name' => $row[0],
                    'date' => $date,
                    'pname' => $row[2],
                    'taxno' => $row[3],
                    'mname' => $row[4],
                    'memberid' => $row[5],
                    'claimno' => $row[6],
                    'dos' => $date1,
                   
                ];

                $builder = $this->db->table('community'); 
  
                $builder->insert($data);


            }
            


        

    }

   

	
	 
}//class