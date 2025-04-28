<?php

namespace App\Controllers;
use TCPDF;

class CommunityCare extends BaseController
{ 
    function __construct()
	{
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->community_model = model("Community_model");
        $this->db = \Config\Database::connect(); 
        $this->common_model = model("Common_model");
	    $this->common_model->isloggedIn();
        $this->permissions = $this->common_model->checkPermission();

	}
    public function index()
    {
        
 
        // $codes = array_column($this->permissions, 'code');
 
        // if (in_array($search_code, $codes))
        // {
        //     return view('communitycare');
        // }
        // else 
        // {
        //     return view('accessdenied');
        // }


        return view('communitycare');
    }

    public function save_data()
    {
        $savedata = $this->community_model->save_data();
    }

    public function getdata()
    {
        header('Content-Type: application/json');
        $data = $this->community_model->getdata();
        // echo"<pre>";
        // print_r($data);
        // exit;
        $i=1;
        foreach ($data as $row)
        {
            $data['0'] = $i;
            $data['1'] = $row['name'];
            $data['2'] = $row['date'];
            $data['3'] = $row['pname'];
            $data['4'] = $row['mname'];
            $data['5'] = $row['claimno'];
            $data['user_id'] = $row['id'];

            $i++;
            $temp[] = $data;
        }
  
        echo json_encode(['data' => $temp]);

    }

    // Delete a shift
    public function deletedata()
    {
        $data = $this->community_model->deletedata();
        return $this->response->setJSON($data); 
    }

    public function getdatabyid()
    {
        $data = $this->community_model->getdatabyid();
        return $this->response->setJSON($data); 
    }
    
    public function update_data()
    { 
        $data = $this->community_model->update_data();
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


    public function pdf()
    {
        return view('pdf_report');
    }


    public function downloadPdf()
    {
        // Create a new PDF instance
        $pdf = new TCPDF();

        // Set document info
        $pdf->SetCreator('CodeIgniter');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Sample PDF');
        $pdf->SetSubject('PDF Generation');

        // Add a page
        $pdf->AddPage();

        // Set some content for the PDF
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'This is a sample PDF created in CodeIgniter.', 0, 1, 'C');

        // Output the PDF to the browser
        return $pdf->Output('sample_pdf.pdf', 'D'); // 'D' for download
    }



}
