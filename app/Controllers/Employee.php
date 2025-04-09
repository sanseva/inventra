<?php

namespace App\Controllers;

class Employee extends BaseController
{ 
    protected $permissions;
    function __construct()
	{
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->employee_model = model("Employee_model");
        $this->db = \Config\Database::connect(); 
        $this->common_model = model("Common_model");
	    $this->common_model->isloggedIn(); 
        $this->permissions = $this->common_model->checkPermission();

	}
    public function index()
    {
        $search_code = "EMP-VIEW-02";
 
        $codes = array_column($this->permissions, 'code');
 
        if (in_array($search_code, $codes))
        {
            return view('employee');
        }
        else 
        {
            return view('accessdenied');
        }

        // return view('employee');
    }

    public function save_data()
    {
        $savedata = $this->employee_model->save_data();
    }

    public function getempdata()
    {
        header('Content-Type: application/json');
        $data = $this->employee_model->getempdata();

        $i=1;
        foreach ($data as $row)
        {
            $data['0'] = $i;
            $data['1'] = $row['fname'];
            $data['2'] = $row['email_id'];
            $data['3'] = $row['phone'];
            $data['4'] = $row['shiftname'];
            $data['5'] = $row['shift_start'];
            $data['6'] = $row['shift_end'];
            $data['user_id'] = $row['user_id'];

            $i++;
            $temp[] = $data;
        }
  
        echo json_encode(['data' => $temp]);

    }

    // Delete a shift
    public function deleteemp()
    {
        $data = $this->employee_model->deleteemp();
        return $this->response->setJSON($data); 
    }

    public function getdatabyid()
    {
        $data = $this->employee_model->getdatabyid();
        return $this->response->setJSON($data); 
    }
    
    public function update_data()
    {
        $data = $this->employee_model->update_data();
        return $this->response->setJSON($data); 
    }
 
    // inactive users vacant system 

    public function vacantSystem()
    {
        $search_code = "VCS-VIEW-04";

        $codes = array_column($this->permissions, 'code');
 
        if (in_array($search_code, $codes))
        {
            return view('vacant_system');
        }
        else 
        {
            return view('accessdenied');
        }

        // return view('vacant_system');
    }


    public function getInactiveempdata()
    {
        header('Content-Type: application/json');
        $data = $this->employee_model->getInactiveempdata();

        $i=1;
        foreach ($data as $row)
        {
            $data['0'] = $i;
            $data['1'] = $row['desk_no'];
            $data['2'] = $row['fname'] .' '.$row['lname'];
            $data['3'] = $row['phone'];
            $data['4'] = $row['shiftname'];
            $data['5'] = $row['shift_start'];
            $data['6'] = $row['shift_end'];
            $data['user_id'] = $row['user_id'];

            $i++;
            $temp[] = $data;
        }
  
        echo json_encode(['data' => $temp]);

    }






}
