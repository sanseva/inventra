<?php

namespace App\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\IOFactory;


$options = new \Dompdf\Options();
$options->set('isRemoteEnabled', true); // Required for local file loading
$dompdf = new \Dompdf\Dompdf($options);

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

        // $data['community'] = $this->community_model->get_all(); // method to fetch list data
        // return view('community/list', $data); // load the view with data

        return view('communitycare');
    }

    public function save_data()
    {
        $savedata = $this->community_model->save_data();
    }

    public function getdata()
    {
        header('Content-Type: application/json');

        $filters = [
            'name' => $this->request->getGet('name'),
            'date' => $this->request->getGet('date'),
            'pname' => $this->request->getGet('pname'),
            'mname' => $this->request->getGet('mname'),
            'claimno' => $this->request->getGet('claimno'),
            'createdby' => $this->request->getGet('createdby'),
        ];

        $data = $this->community_model->getFilteredData($filters);

        $output = [];
        $i = 1;
        foreach ($data as $row) {
            $output[] = [
                '0' => $i++,
                '1' => $row['name'],
                '2' => date('m/d/Y', strtotime($row['date'])),
                '3' => $row['pname'],
                '4' => $row['mname'],
                '5' => $row['claimno'],
                '6' => $row['fname'] . ' ' . $row['lname'],
                'user_id' => $row['id']
            ];
        }

        echo json_encode(['data' => $output]);
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

    public function pdf($userId)
    {
        return view('view_pdf_report',['userId' => $userId]);
    }

    public function generatepdf()
    {
        $id = $this->request->getGet('id');
        $dompdf = new Dompdf();

        $data['data'] = $this->community_model->getcommunitydata($id);    
        $logo_path = 'file://' . realpath(FCPATH . 'assets/images/logo-dark.png');
 
        $data['logo_path'] = $logo_path;
        $html = view('pdf_report', $data);
      
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output the PDF directly in the browser
        $filename = $data['data']['mname'] . date('Y-m-d', strtotime($data['data']['dos'])) . ".pdf";
            $dompdf->stream($filename, ["Attachment" => false]);
        

    }

    public function download_pdf()
    {
        $dompdf = new Dompdf();

        $html = view('pdf_report');
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Force download
        return $dompdf->stream("claim-inquiry.pdf", ["Attachment" => true]);
    }

    public function preview_excel()
    {
        $file = $this->request->getFile('excel_file');
        if ($file && $file->isValid()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $data = $spreadsheet->getActiveSheet()->toArray();

            // Skip header (first row)
            $dataWithoutHeader = array_slice($data, 1);

            return view('preview_excel_view', [
                'sheetData' => $dataWithoutHeader,
                'rawJson'   => json_encode($data) // include full data for submission (optional)
            ]);
        } else {
            return redirect()->back()->with('error', 'Invalid file uploaded.');
        }
    }

    public function save_excel()
    {
        $rawData = $this->request->getPost('excel_data');
        $excelData = json_decode($rawData, true);
        
        $data = $this->community_model->save_excel( $excelData);
        
        return redirect()->to('/communitycare'); 
        
    }

}
