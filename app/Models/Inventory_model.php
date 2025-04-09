<?php
namespace App\Models;
use CodeIgniter\Model;
/**
 * @author sdas
 *
 */
class Inventory_model extends Model {

	public function __construct() {
        parent:: __construct(); 
		$this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
    }


    public function save_data() {
         
        
        // Prepare data array for insertion
        $data = [
            'product' => makeSafe($this->request->getPost('productname')),
            'total' => makeSafe($this->request->getPost('total')),
            'prod_desc' => makeSafe($this->request->getPost('productdesc')),
            'unit_price' => makeSafe($this->request->getPost('price'))
        ];

        $builder = $this->db->table('inventory'); // Set the table name
        // Insert data into the database
        // $builder->insert($data);

        if( $builder->insert($data))
        {
            $insertedId = $this->db->insertID(); // Get the last inserted ID
            $quantity = makeSafe($this->request->getPost('total')); // Sanitize input
             
            $builder = $this->db->table('inventory'); // Table name
            $builder->set('current_quantity', "current_quantity + {$quantity}", false); // Ensure arithmetic operation
            $builder->set('total_qty', "total_qty + {$quantity}", false); // Ensure arithmetic operation
            $builder->where('id', $insertedId); // Assuming item_id is also dynamic
            $query = $builder->update();    
        }

    }

    public function getdata() {
        $sql   ="SELECT id,product,prod_desc,total,current_quantity,unit_price,total_qty FROM inventory";
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }

    public function deletedata() 
    {
        $id = $this->request->getPost('id');
        // Perform the delete operation

        $builder = $this->db->table('inventory'); // Set the table name
        $builder->where('id', $id); // Add the condition for duplicate check
        $query = $builder->delete(); // Execute and store the query result

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
                'message' => 'Failed to delete employee. Please try again.'
            ];
        }

        return $msg; 

    }

    public function getdatabyid() {

        $id = $this->request->getPost('id');
        $sql   ="SELECT id,product,prod_desc,total,unit_price FROM inventory where id = $id";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }

    public function update_data() {

        $id = $this->request->getPost('idd');

        $data = [
            'product' => makeSafe($this->request->getPost('productname')),
            'total' => makeSafe($this->request->getPost('total')), 
            'prod_desc' => makeSafe($this->request->getPost('productdesc')),
            'unit_price' => makeSafe($this->request->getPost('price')),
        ];

        $builder = $this->db->table('inventory'); // Set the table name
        $builder->where('id', $id); // Add the condition for duplicate check
        $query = $builder->update($data); // Execute and store the query result
        
        if($query)
        {
            $quantity = makeSafe($this->request->getPost('total')); // Sanitize input 
             
            $builder = $this->db->table('inventory'); // Table name
            $builder->set('current_quantity', "current_quantity + {$quantity}", false); // Ensure arithmetic operation
            $builder->set('total_qty', "total_qty + {$quantity}", false); // Ensure arithmetic operation
            $builder->where('id', $id); // Assuming item_id is also dynamic
            $query = $builder->update();  
        }

    }

    //Inventory Status

    public function getinvstatusdata()
    {
        $sql   ="SELECT inventorystatus.item_id,inventorystatus.quantity,inventorystatus.status, inventorystatus.transaction_id, inventory.product AS item_name , employee.fname as fname,employee.lname
                as lname FROM inventorystatus 
                LEFT JOIN employee ON inventorystatus.emp_id = employee.user_id
                LEFT JOIN inventory ON inventorystatus.item_id = inventory.id";
        $query = $this->db->query($sql)->getResultArray();
        return $query;
    }
    public function getbyid() {

        $id = $this->request->getPost('id');
        $sql   ="SELECT * FROM inventorystatus where transaction_id  = $id";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }
    
    public function saveinvdata() {
 
        $item = $this->request->getPost('item_id');
        $qty = $this->request->getPost('quantity');
 
        $mergedArray = [];

        foreach ($item as $key => $value) {

            $quantity  = $qty[$key];

            for ($i = 0; $i < $quantity ; $i++) {

                $data  = [
                    'emp_id' => makeSafe($this->request->getPost('employee_id')),
                    'item_id' => $value,
                    'quantity' => 1
                ];

                $builder = $this->db->table('inventorystatus'); 
                $builder->insert($data);

            }

                $builder = $this->db->table('inventory'); // Table name
                $builder->set('current_quantity', "current_quantity - {$quantity}", false); // Ensure arithmetic operation
                $builder->where('id', $value); // Assuming item_id is also dynamic
                $query = $builder->update();

            // $mergedArray[$key] = [
            //     'item' => $value,

            //     'qty' => $array2[$key] ?? 0 // Use 0 if index is missing in $array2

            // ];
        }

        // echo"<pre>";
        // print_r($mergedArray);
        exit;

        $quantity = makeSafe($this->request->getPost('quantity'));

        $data = [
            'item_id' => makeSafe($this->request->getPost('item_id')),
            'quantity' => 1,
            'emp_id' => makeSafe($this->request->getPost('employee_id'))
        ];

        for($i=0;$i<$quantity;$i++)
        {
            $builder = $this->db->table('inventorystatus'); 
            $builder->insert($data);
        }

        // UPDATE Items SET current_quantity = current_quantity - 5 WHERE item_id = 1;

        $builder = $this->db->table('inventory'); // Table name
        $builder->set('current_quantity', "current_quantity - {$quantity}", false); // Ensure arithmetic operation
        $builder->where('id', $this->request->getPost('item_id')); // Assuming item_id is also dynamic
        $query = $builder->update();   
        
            

        exit;









        // recent code

        // $quantity = makeSafe($this->request->getPost('quantity'));

        // $data = [
        //     'item_id' => makeSafe($this->request->getPost('item_id')),
        //     'quantity' => 1,
        //     'emp_id' => makeSafe($this->request->getPost('employee_id'))
        // ];

        // for($i=0;$i<$quantity;$i++)
        // {
        //     $builder = $this->db->table('inventorystatus'); 
        //     $builder->insert($data);
        // }

        // // UPDATE Items SET current_quantity = current_quantity - 5 WHERE item_id = 1;

        // $builder = $this->db->table('inventory'); // Table name
        // $builder->set('current_quantity', "current_quantity - {$quantity}", false); // Ensure arithmetic operation
        // $builder->where('id', $this->request->getPost('item_id')); // Assuming item_id is also dynamic
        // $query = $builder->update();   
        
            

        // exit;



        // //old code
        // // Prepare data array for insertion
        // $data = [
        //     'item_id' => makeSafe($this->request->getPost('item_id')),
        //     'quantity' => makeSafe($this->request->getPost('quantity')),
        //     'emp_id' => makeSafe($this->request->getPost('employee_id'))
        // ];

        // $builder = $this->db->table('inventorystatus'); 
        // // $builder->insert($data);



        // if($builder->insert($data))
        // {
        //     $quantity = makeSafe($this->request->getPost('quantity')); // Sanitize input

        //     // UPDATE Items SET current_quantity = current_quantity - 5 WHERE item_id = 1;

        //     $builder = $this->db->table('inventory'); // Table name
        //     $builder->set('current_quantity', "current_quantity - {$quantity}", false); // Ensure arithmetic operation
        //     $builder->where('id', $this->request->getPost('item_id')); // Assuming item_id is also dynamic
        //     $query = $builder->update();    
        // }

    }

    public function updateinvdata() {

        $id = $this->request->getPost('idd');

        $data = [
            'item_id' => makeSafe($this->request->getPost('item_id')),
            'quantity' => makeSafe($this->request->getPost('quantity')),
            'emp_id' => makeSafe($this->request->getPost('employee_id'))
        ];

        $builder = $this->db->table('inventorystatus');
        $builder->where('transaction_id', $id);
        $query = $builder->update($data);

        if($query)
        {
            $quantity = makeSafe($this->request->getPost('quantity')); // Sanitize input
 
            $builder = $this->db->table('inventory'); // Table name
            $builder->set('current_quantity', "current_quantity - {$quantity}", false); // Ensure arithmetic operation
            $builder->where('id', $this->request->getPost('item_id')); // Assuming item_id is also dynamic
            $query = $builder->update();    
        }

    }
    public function deleteinvdata()
    {
        $id = $this->request->getPost('id');
        // Perform the delete operation

        $builder = $this->db->table('inventorystatus'); // Set the table name
        $builder->where('transaction_id', $id); // Add the condition for duplicate check
        $query = $builder->delete(); // Execute and store the query result

        if($query) 
        {
            // $quantity = makeSafe($this->request->getPost('quantity')); // Sanitize input
            $quantity = 1; // Sanitize input
            $item_id = $this->request->getPost('item_id');
 
            $builder = $this->db->table('inventory'); // Table name
            $builder->set('current_quantity', "current_quantity + {$quantity}", false); // Ensure arithmetic operation
            $builder->where('id', $item_id); // Assuming item_id is also dynamic
            $query = $builder->update();

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
                'message' => 'Failed to delete employee. Please try again.'
            ];
        }

        return $msg; 

    }

    public function getitems() {
 
        $sql   ="SELECT id,product FROM inventory ";
        $query = $this->db->query($sql)->getResultArray();
        return $query; 
    }
    
    public function getVacantCount()
    {
        $sql   ="SELECT count(*) as vms FROM `employee` WHERE is_active='N' and `shiftname` = 'M'";
        $query['vms'] = $this->db->query($sql)->getRowArray()['vms'];

        $sql   ="SELECT count(*) as vns FROM `employee` WHERE is_active='N' and `shiftname` = 'N'";
        $query['vns']  = $this->db->query($sql)->getRowArray()['vns'];

        return $query; 


    }

    public function chagestatus()
    {
        $id = $this->request->getPost('id');

        // Fetch current status (Use binding to prevent SQL injection)
        $sql = "SELECT status FROM inventorystatus WHERE transaction_id = ?";
        $query = $this->db->query($sql, [$id]);
        $result = $query->getRowArray();
        
        // Check if result is valid
        if (!$result) {
            echo json_encode(["success" => false, "message" => "No record found for transaction_id: $id"]);
            exit;
        }
        
        $currentStatus = $result['status'];
        
        // Toggle status
        $newStatus = ($currentStatus == "A") ? "N" : "A";

        // Update database
        $builder = $this->db->table('inventorystatus');
        $update = $builder->set('status', $newStatus)
                          ->where('transaction_id', $id)
                          ->update();
        
        if ($update) {
            echo json_encode(["success" => true, "newStatus" => $newStatus]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update record."]);
        }
        
    

    }

    public function gethistory()
    {
        $id = $this->request->getPost('id');
        $sql   ="SELECT inventorystatus.*,employee.fname,employee.lname,inventory.product
                    FROM inventorystatus
                    left join employee on employee.user_id = inventorystatus.emp_id 
                    left join inventory on inventory.id = inventorystatus.item_id 
                    WHERE item_id = ?";
        $query = $this->db->query($sql, [$id])->getResultArray();
        return $query;
    }



   

	
	 
}//class