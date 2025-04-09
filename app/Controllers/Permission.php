<?php

namespace App\Controllers;

class Permission extends BaseController
{ 
    protected $permissions;

    function __construct()
	{
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->permission_model = model("Permission_model");
		$this->employee_model = model("Employee_model");
        $this->db = \Config\Database::connect();
        $this->common_model = model("Common_model");
	    $this->common_model->isloggedIn();
        $this->permissions = $this->common_model->checkPermission();
        // echo"<pre>";
        // print_r($permissions);exit;
	}

    // Module 
    public function module()
    {
        // $search_code = "EMP-ADD-011";
 
        // $codes = array_column($this->permissions, 'code');
 
        // if (in_array($search_code, $codes))
        // {
            return view('module');
        // }
        // else 
        // {
        //     return view('accessdenied');
        // }
 
        // return view('module');
    }
     
    public function getmodule()
    { 
        header('Content-Type: application/json');
        $data = $this->permission_model->getmodule();

        $i=1;
        foreach ($data as $row)
        {
            $data['0'] = $i;
            $data['1'] = $row['mname'];
            $data['2'] = $row['mdesc']; 
            $data['3'] = $row['added_by'];
            // $data['5'] = $row['unit_price'];
            $data['id'] = $row['mid'];
            $i++;
            $temp[] = $data;
        }
  
        echo json_encode(['data' => $temp]);

    }

    public function save_data()
    {
        $savedata = $this->permission_model->save_data();
    }

    public function deletedata()
    {
        $data = $this->permission_model->deletedata();
        return $this->response->setJSON($data); 
    }

    public function getdatabyid()
    {           
        $data = $this->permission_model->getdatabyid();
        return $this->response->setJSON($data); 
    }

    public function update_data()
    {
        $data = $this->permission_model->update_data();
        return $this->response->setJSON($data); 
    }
    
    //Submodule

    public function submodule()
    {
        return view('submodule');
    }

    public function submoduledata()
    {
        header('Content-Type: application/json');
        $data = $this->permission_model->submoduledata();

        $i=1;
        foreach ($data as $row)
        {
            $data['0'] = $i;
            $data['1'] = $row['mname'];
            $data['2'] = $row['smname'];
            $data['3'] = $row['smdesc']; 
            $data['4'] = $row['code'];
            $data['id'] = $row['smid'];
            $i++;
            $temp[] = $data;
        }
  
        echo json_encode(['data' => $temp]);

    }

    public function save_submodule_data()
    {
        $savedata = $this->permission_model->save_submodule_data();
    }

    public function deletesubmoduledata()
    {
        $data = $this->permission_model->deletesubmoduledata();
        return $this->response->setJSON($data); 
    }

    public function getsubmoduledatabyid()
    {
        $data = $this->permission_model->getsubmoduledatabyid();
        return $this->response->setJSON($data); 
    }

    public function update_submodule_data()
    {
        $data = $this->permission_model->update_submodule_data();
        return $this->response->setJSON($data); 
    }

    public function getmodulenames()
    {
        $data = $this->permission_model->getmodulenames();

        $html = '<option value="">Select Module</option>'; // Default option

        foreach ($data as $row) {
            $html .= '<option value="' . $row['mid'] . '">' . htmlspecialchars($row['mname'], ENT_QUOTES, 'UTF-8') . '</option>';
        }
    
        echo $html; 
    }
    
    //access
    public function access()
    {
        return view('access');
    }
    public function getaccess()
    {
        $data = $this->permission_model->getaccess();
        
        $emp_id = $this->request->getPost('empid'); 
        $assignedPermissions = $this->permission_model->getempaccess($emp_id);

         

        foreach ($data as $permission) {
            $getaccess[$permission['mname']][$permission['smid']] = [
                'smname' => $permission['smname'],  // Sub-module name
                'mid' => $permission['mid'],        // Module ID
                'code' => $permission['code']       // Code
            ];
        }
 
        // Convert assigned permissions to a lookup array
        $assignedLookup = [];
        foreach ($assignedPermissions as $perm) {
            $assignedLookup[$perm['smid']] = $perm['has_permission']; // Store smid as key
        }
 
        $html = '';
        if(!empty($getaccess))
        {
            foreach ($getaccess as $key => $value) {

                // $isChecked = isset($assignedLookup[$perm['smid']]) && $assignedLookup[$perm['smid']] == 1 ? "checked" : ""; // Check if permission is assigned
 
                $html .= '<tr>
                            <td>1</td>
                            <td><input type="checkbox" name="modules" value="' . htmlspecialchars($key) . '"> ' . htmlspecialchars($key) . '</td>
                            <td>';

                foreach ($value as $key => $perm) {
                    $isChecked = isset($assignedLookup[$key]) && $assignedLookup[$key] == 1 ? "checked" : "";

                    $html .= '<div><input type="checkbox" class="ischecked" name="permission"  '.$isChecked.' onclick="assignaccess(\'' .$perm['mid']. '\',\'' .  $key . '\',\'' .  $perm['code'] . '\',this) ;"  value="' . $key . '" > ' . htmlspecialchars($perm['smname']) . '</div>';
                    // $html .= '<div><input name="checkval" type="checkbox" class="ischecked" name="permission"  '.$isChecked.' onchange="sss(\'' .$perm['mid']. '\',\'' .  $key . '\',\'' .  $perm['code'] . '\');"  value="' . $key . '" > ' . htmlspecialchars($perm['smname']) . '</div>';
                }

                $html .= '</td></tr>';  
            }

        }
        echo ($html);
         
    }

    public function saveaccess()
    {
        $data = $this->permission_model->saveaccess();
        return $this->response->setJSON($data); 
    }
    
    public function getemp()
    {
        $data = $this->permission_model->getemp();

        $html = '<option value="">Select Module</option>'; // Default option

        foreach ($data as $row) {
            $html .= '<option value="' . $row['user_id'] . '">' . htmlspecialchars($row['fname'] .' '.$row['lname']  , ENT_QUOTES, 'UTF-8') . '</option>';
        }

        echo $html;
    }

    public function deleteaccess()
    {
        $data = $this->permission_model->deleteaccess();
        return $this->response->setJSON($data); 
    }
     




}