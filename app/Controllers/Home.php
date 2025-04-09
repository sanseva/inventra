<?php  
// namespace App\Controllers; 

// class Home extends BaseController
// {
    // function __construct()
	// {
	// 	$this->request = \Config\Services::request();
	// 	$this->session = \Config\Services::session();
	// 	$this->Home_model = model("Home_model");
    //     $this->db = \Config\Database::connect(); 

	// }

//     public function index()
//     {
//         return view('home');
//     }
    // public function getcounts()
    // {
    //     echo"sss";exit;
    //     $savedata = $this->Home_model->getcounts();
        
    // }
// }
?>
<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
	{
		$this->request = \Config\Services::request();
		$this->session = \Config\Services::session();
		$this->Home_model = model("Home_model");
        $this->db = \Config\Database::connect(); 

	}
    public function index()
    {
        return view('home');
    }
    public function getcounts()
    {
        $savedata = $this->Home_model->getcounts();
        echo json_encode($savedata);  // Respond with JSON data
    }
    



    


    


        

    

}
