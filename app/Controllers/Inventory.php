<?php

namespace App\Controllers;

class Inventory extends BaseController
{ 
    function __construct()
	{
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->inventory_model = model("Inventory_model");
		$this->employee_model = model("Employee_model");
        $this->db = \Config\Database::connect();
        $this->common_model = model("Common_model");
	    $this->common_model->isloggedIn();
        $this->permissions = $this->common_model->checkPermission();

	}
    public function index()
    {
        $search_code = "INV-VIEW-04";
 
        $codes = array_column($this->permissions, 'code');
 
        if (in_array($search_code, $codes))
        {
            return view('inventory');
        }
        else 
        {
            return view('accessdenied');
        }


        // return view('inventory');
    }

    public function save_data()
    {
        $savedata = $this->inventory_model->save_data();
    }

    public function getdata()
    {
        header('Content-Type: application/json');
        $data = $this->inventory_model->getdata();

        $i=1;
        foreach ($data as $row)
        {
            $data['0'] = $i;
            $data['1'] = $row['product'];
            $data['2'] = $row['prod_desc'];
            $data['3'] = $row['total'];
            $data['4'] = $row['current_quantity'];
            // $data['5'] = $row['unit_price'];
            $data['id'] = $row['id'];
            $i++;
            $temp[] = $data;
        }
  
        echo json_encode(['data' => $temp]);

    }

    public function deletedata()
    {
        $data = $this->inventory_model->deletedata();
        return $this->response->setJSON($data); 
    }

    public function getdatabyid()
    {
        $data = $this->inventory_model->getdatabyid();
        return $this->response->setJSON($data); 
    }

    public function update_data()
    {
        $data = $this->inventory_model->update_data();
        return $this->response->setJSON($data); 
    }

    //inventory_status
    public function inventory_status()
    {
        $search_code = "INVS-VIEW-04";
 
        $codes = array_column($this->permissions, 'code');
 
        if (in_array($search_code, $codes))
        {
            return view('inventory_status');
        }
        else 
        {
            return view('accessdenied');
        }



        // return view('inventory_status');
    }

    public function getinvstatusdata()
    { 
        header('Content-Type: application/json');
        $data = $this->inventory_model->getinvstatusdata();

        $i=1;
        foreach ($data as $row)
        {
            $data['0']  = $i;
            $data['1']  = $row['item_name'];
            $data['2']  = $row['fname'].' '.$row['lname'] ;
            $data['3']  = $row['quantity']; 
            $data['4']  = $row['status'];
            $data['id'] = $row['transaction_id'];
            $data['item_id'] = $row['item_id'];
            $i++;
            $temp[] = $data;
        }
  
        echo json_encode(['data' => $temp]);

    }
    public function getbyid()
    {
        $data = $this->inventory_model->getbyid();
        return $this->response->setJSON($data); 
    }

    public function saveinvdata()
    {
        $savedata = $this->inventory_model->saveinvdata();
    }

    public function updateinvdata()
    {
        $data = $this->inventory_model->updateinvdata();
        return $this->response->setJSON($data);
    }

    public function deleteinvdata()
    {
        $data = $this->inventory_model->deleteinvdata();
        return $this->response->setJSON($data); 
    }

    
    public function getitems()
    {
        $data = $this->inventory_model->getitems();
        $html = '<option value="">Select Item</option>'; // Default option

        foreach ($data as $row) {
            $html .= '<option value="' . $row['id'] . '">' . htmlspecialchars($row['product'], ENT_QUOTES, 'UTF-8') . '</option>';
        }
    
        echo $html; //
    }

    public function getactiveemp()
    {   

        $data = $this->employee_model->getactiveemp(); 
        $html = '<option value="">Select Employee</option>'; // Default option

        foreach ($data as $row) {
            $html .= '<option value="' . $row['user_id'] . '">' . htmlspecialchars($row['fname'].' '.$row['lname'], ENT_QUOTES, 'UTF-8') . '</option>';
        }
    
        echo $html;
    }

    public function chagestatus()
    {
        $data = $this->inventory_model->chagestatus(); 
         
    }

    
     
    

}
