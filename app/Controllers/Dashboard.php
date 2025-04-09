<?php

namespace App\Controllers;

class Dashboard extends BaseController
{ 
    function __construct()
	{
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->inventory_model = model("Inventory_model");
        $this->db = \Config\Database::connect(); 
        $this->common_model = model("Common_model");
	    $this->common_model->isloggedIn();

	}
    public function index()
    {
        $getdata['getdata'] = $this->inventory_model->getdata();
        $getdata['count'] = $this->inventory_model->getVacantCount();
        return view('dashboard',$getdata);
    }
    public function gethistory()
    {
        $data = $this->inventory_model->gethistory();

        $html = '';
        if (empty($data)){
            $html .= '<tr>';   
            $html .= '<td colspan="7" class="text-center">No records found</td>';   
            $html .= '</tr>';    
        
        }

    
        $count = 1;
        foreach ($data as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $count++ . '</td>';
            $html .= '<td>' . htmlspecialchars($row['fname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['lname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['product']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['quantity']) . '</td>';
            $html .= '<td>' . (!empty($row['status'] && $row['status'] == 'A') ? 'ACTIVE' : 'INACTIVE') . '</td>';
            $html .= '<td>' . htmlspecialchars($row['date']) . '</td>';
            $html .= '</tr>';
        }

        echo $html; 
    }
 

}
