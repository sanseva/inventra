<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * @author sdas
 *
 */
class Permission_model extends Model {

	public function __construct() {
        parent:: __construct(); 
		$this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
    }

    //module
    public function getmodule() {
        $sql   ="SELECT mid,mname,mdesc, added_by FROM module";
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }

    public function save_data() {
         
        $emp_id = $this->session->get('user_id');
        // Prepare data array for insertion
        $data = [
            'mname' => makeSafe($this->request->getPost('mname')),
            'mdesc' => makeSafe($this->request->getPost('mdesc')),
            'added_by' => $emp_id 
        ];

        $builder = $this->db->table('module'); // Set the table name
 
        if( $builder->insert($data))
        {
            $msg = [
                'status' => 'success',
                'message' => 'Data Inserted Successfully'
            ];
        }
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to Insert data. Please try again.'
            ];
        }

    }
 
    public function deletedata() 
    {
        $id = $this->request->getPost('id');

        $builder = $this->db->table('module');  
        $builder->where('mid', $id);  
        $query = $builder->delete(); 

        if($query)
        {
            // If deletion is successful, send a success response
            $msg = [
                'status' => 'success',
                'message' => 'Data Deleted Successfully'
            ];
        } 
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to delete. Please try again.'
            ];
        }

        return $msg; 

    }

    public function getdatabyid() {

        $id = $this->request->getPost('id');
        $sql   ="SELECT mid,mname,mdesc,added_by FROM module where mid = $id";
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }

    public function update_data() {
         
        $id = $this->request->getPost('idd');
 
        $data = [
            'mname' => makeSafe($this->request->getPost('mname')),
            'mdesc' => makeSafe($this->request->getPost('mdesc'))
        ];

        $builder = $this->db->table('module'); // Set the table name
        $builder->where('mid', $id); // Add the condition for duplicate check
        $query = $builder->update($data); // Execute and store the query result
        
        if($query)
        {
            $msg = [
                'status' => 'success',
                'message' => 'Data updated Successfully'
            ];
        }
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to update. Please try again.'
            ];
        }

        return $msg; 

    }


    //Submodule


    public function submoduledata() {
        $sql   ="SELECT smid,module.mname as mname,smname,smdesc, code 
                    FROM sub_module
                    left join module on module.mid = sub_module.moduleid";
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }

    public function save_submodule_data() {

        $emp_id = $this->session->get('user_id');
        // Prepare data array for insertion
        $data = [
            'moduleid' => makeSafe($this->request->getPost('moduleid')),
            'smname' => makeSafe($this->request->getPost('smname')),
            'smdesc' => makeSafe($this->request->getPost('smdesc')),
            'code' => makeSafe($this->request->getPost('smcode')),
            'added_by' => $emp_id 
        ];

        $builder = $this->db->table('sub_module'); // Set the table name
 
        if( $builder->insert($data))
        {
            $msg = [
                'status' => 'success',
                'message' => 'Data Inserted Successfully'
            ];
        }
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to Insert data. Please try again.'
            ];
        }

    }
 
    public function deletesubmoduledata()
    {
        $id = $this->request->getPost('id');

        $builder = $this->db->table('sub_module');  
        $builder->where('smid', $id);  
        $query = $builder->delete(); 

        if($query)
        {
            // If deletion is successful, send a success response
            $msg = [
                'status' => 'success',
                'message' => 'Data Deleted Successfully'
            ];
        } 
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to delete. Please try again.'
            ];
        }

        return $msg; 

    }

    public function getsubmoduledatabyid() {

        $id = $this->request->getPost('id');
        $sql   ="SELECT smid,moduleid,smname,smdesc,code FROM sub_module where smid = $id";
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }

    public function update_submodule_data() {

        $id = $this->request->getPost('idd');
 
        $data = [
            'moduleid' => makeSafe($this->request->getPost('moduleid')),
           'smname' => makeSafe($this->request->getPost('smname')),
           'smdesc' => makeSafe($this->request->getPost('smdesc')),
           'code' => makeSafe($this->request->getPost('smcode')),
        ];

        $builder = $this->db->table('sub_module'); // Set the table name
        $builder->where('smid', $id); // Add the condition for duplicate check
        $query = $builder->update($data); // Execute and store the query result

        if($query)
        {
            $msg = [
                'status' => 'success',
                'message' => 'Data updated Successfully'
            ];
        }
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to update. Please try again.'
            ];
        }

        return $msg; 

    }

    public function getmodulenames() {
 
        $sql   ="SELECT * FROM module";
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }


    public function getaccess() {
 
        // $sql   ="SELECT permissions.*,module.mname,sub_module.smname,module.mid as mid,sub_module.code as code FROM permissions 
        //             left join module on module.mid = permissions.mid 
        //             left join sub_module on sub_module.smid = permissions.smid ";

        $sql   ="SELECT sub_module.*, module.mname,sub_module.smname,module.mid as mid,sub_module.code as code FROM sub_module 
                    left join module on module.mid = sub_module.moduleid";

        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }

    public function  saveaccess()
    { 
        $added_by = $this->session->get('user_id');

        $pid  = $this->request->getPost('pid'); 
        $mid  = $this->request->getPost('mid'); 
        $code = $this->request->getPost('code'); 
        $emp_id = $this->request->getPost('empid'); 

        // Prepare data array for insertion
        $data = [
            'emp_id' => $emp_id ,
            'mid' => $mid,
            'smid' => $pid,
            'code' => $code,
            'has_permission' => 1,
            // 'added_by' => $added_by 
        ];

        $builder = $this->db->table('permissions'); // Set the table name

        if( $builder->insert($data))
        {
            $msg = [
                'status' => 'success',
                'message' => 'Data Inserted Successfully'
            ];
        }
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to Insert data. Please try again.'
            ];
        }
    }

    public function getemp()
    {
        $sql = " SELECT * FROM employee where is_active  = 'Y' "; 
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }


    public function getempaccess($empid)
    {
        $sql = " SELECT * FROM permissions where  emp_id = ".$empid; 
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }

    
    public function deleteaccess( )
    { 
        $mid = $this->request->getPost('mid');
        $pid = $this->request->getPost('pid');
        $code = $this->request->getPost('code');
        $empid = $this->request->getPost('empid');

        $builder = $this->db->table('permissions');  
        $builder->where('emp_id', $empid);  
        $builder->where('mid', $mid);  
        $builder->where('smid', $pid);    
        $builder->where('code', $code);    
        $query = $builder->delete();

        if($query)
        {
            // If deletion is successful, send a success response
            $msg = [
                'status' => 'success',
                'message' => 'Data Deleted Successfully'
            ];
        } 
        else 
        {
            // If deletion fails, send an error message
            $msg = [
                'status' => 'error',
                'message' => 'Failed to delete. Please try again.'
            ];
        }

        return $msg; 
  
    }







	 
}//class