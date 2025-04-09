<?php
namespace App\Models;
use CodeIgniter\Model;

class Dashboard_model extends Model {

	public function __construct() {
        parent:: __construct();
		$this->db = \Config\Database::connect();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->permission_model = model('employee/Permission_model');
    }
	
	public function home_details()
	{
		$fy_between="'".$this->session->get('fy_s_date')."' and  '".$this->session->get('fy_e_date')."'";
		$data=array();
		$data['success']=false;
		$data['msg']="Problem during saving data";
		
		$sql="select count(BillNo) as BillCount  from billednodetails where billDate between ".$fy_between." ";
		$query = $this->db->query($sql);
	   	$row= $query->getRow();
	  	$data['sales_count']= $row->BillCount; 
	  	//retail sales count         	
		 $sql="select count(BillNo) as BillCount  from retail_billnodetails where BillDate between ".$fy_between."";
		$query = $this->db->query($sql);
	   	$row= $query->getRow();
	  	$data['sales_count_retailer']= $row->BillCount;          	
								   
	    $sql="select count(PurchaseEntryNo) as pCount  from purchasemaster where  BillDate between ".$fy_between."";
		$query = $this->db->query($sql);
	   	$row= $query->getRow();
	  	$data['purchase_count']= $row->pCount;          	
	  	
	    $sql="select count(supplier_id) as sCount  from supplier ";
		$query = $this->db->query($sql);
	   	$row= $query->getRow();
	  	$data['supplier_count']= $row->sCount; 
	  	         	
	    $sql="select count(RetCode) as rCount  from retailersinformation ";
		$query = $this->db->query($sql);
	   	$row= $query->getRow();
	  	$data['retailer_count']= $row->rCount;          	
		//unsaved sales	dustributor				               
		$query="SELECT SaleEntryNo, BillDate, retailer_id,retailer_name,discount,GSTIN,sales_service,bill_type FROM sale_master_temp where org_id = ".$this->session->get('org_id')." AND BillDate >= '".$this->session->get('fy_s_date')."' AND BillDate <= '".$this->session->get('fy_e_date')."' order by BillDate DESC";
		$data['temp_sales']=$this->db->query($query)->getResultArray();			
		//unsaved sales	dustributor				               
		$query="SELECT BillNo, BillDate,CommisionID,Customer_name,customer_address,mobile,DoctorName,bill_from FROM retail_billnodetails_temp order by BillDate DESC";
		$data['temp_sales_retail']=$this->db->query($query)->getResultArray();			

		//unsaved purchases
		$query="SELECT PurchaseEntryNo, BillNo, BillDate, supplier_id,supplier_name,PmtMode, ChequeDate, ChequeNo, ChequeBank,GSTIN FROM purchase_master_temp";
		$data['temp_purchase']=$this->db->query($query)->getResultArray();	
		//unsaved purchases
		$query="SELECT PurchaseEntryNo, BillNo, BillDate, supplier_id,supplier_name,PmtMode, ChequeDate, ChequeNo, ChequeBank,GSTIN FROM purchase_master_temp";
		$data['temp_purchase']=$this->db->query($query)->getResultArray();	
		
		//unsaved RETAIL GST SALES
		$query="SELECT bill_no, bill_date, customer_name,bill_serise  FROM retail_gst_billnodetails_temp";
		$data['temp_gst_sales_retail']=$this->db->query($query)->getResultArray();	
		
		//proforma unsaved details.
		//unsaved sales	dustributor				               
		$query="SELECT SaleEntryNo, BillDate, retailer_id,retailer_name,discount,GSTIN,sales_service,bill_type FROM proforma_sale_master_temp where org_id = ".$this->session->get('org_id')." AND BillDate >= '".$this->session->get('fy_s_date')."' AND BillDate <= '".$this->session->get('fy_e_date')."'  order by BillDate DESC";
		$data['proforma_temp_sales']=$this->db->query($query)->getResultArray();
		return $data;
	}
	
	public function delete_purchase($temp_session)
	{
	
			$this->db->where('PurchaseEntryNo', $temp_session);
			$this->db->delete('purchase_detail_temp'); 
			$this->db->where('PurchaseEntryNo', $temp_session);
			$this->db->delete('purchase_master_temp'); 
			
	}
	public function delete_sales($temp_session)
	{
		$this->db->table('sale_detail_temp')->where('SaleEntryNo', $temp_session)->delete();
		$this->db->table('sale_master_temp')->where('SaleEntryNo', $temp_session)->delete();
					
	}
	public function delete_proforma($temp_session)
	{
		$this->db->where('SaleEntryNo', $temp_session);
		$this->db->delete('proforma_sale_detail_temp'); 
		$this->db->where('SaleEntryNo', $temp_session);
		$this->db->delete('proforma_sale_master_temp'); 	
	}
	public function delete_sales_retail($temp_session)
	{
		$this->db->where('BillNo', $temp_session);
		$this->db->delete('retail_billnodetails_temp'); 
		$this->db->where('BillNo', $temp_session);
		$this->db->delete('retail_billitemdetails_temp'); 
		
	}
	public function delete_sales_retail_gst($temp_session)
	{
		$this->db->where('bill_no', $temp_session);
		$this->db->delete('retail_gst_billnodetails_temp'); 
		$this->db->where('bill_no', $temp_session);
		$this->db->delete('retail_gst_billitemdetails_temp'); 
		
	}
	public function stock_expiry()
	{
		 
			
			
			
	}
	public function get_recent_invoices()
	{
	   	$org_id = $this->session->get('org_id');
		$invoice="SELECT b.NetAmount AS total_amt,SUM(c.AmountCollected) AS collected_amt ,b.billDate,r.RetName,b.invoice_no
			FROM billednodetails b 
			LEFT OUTER JOIN collection c ON c.invoice_no = b.invoice_no AND b.fin_yr = c.fin_yr AND b.org_id = c.org_id 
			LEFT JOIN retailersinformation r on r.RetCode = b.DistributorId 
			LEFT JOIN billeditemdetails bi ON bi.BillNo = b.BillNo 
			WHERE b.org_id = ".$org_id." and (b.membership_bill = 0 OR b.membership_bill IS NULL) AND is_cancelled = 0 
			GROUP BY b.BillNo 
			ORDER BY billDate desc";

		$query = $this->db->query($invoice);
		$results = $query->getResultArray();  
			
		return $results;  
		exit;
	}
	public function get_monthwise_invoices()
	{
		$org_id = $this->session->get('org_id');
	    $sql = "
	        SELECT b.NetAmount AS total_amt,b.invoice_no,SUM(c.AmountCollected) AS collected_amt ,b.*,r.RetName,o.org_id,Max(c.CollectionDate) as received_amt_dt,c.TDS, 
	        GROUP_CONCAT(bi.ItemName) AS description,auc_no 
	        FROM billednodetails b 
	        LEFT OUTER JOIN collection c ON c.invoice_no = b.invoice_no AND b.fin_yr = c.fin_yr AND b.org_id = c.org_id LEFT JOIN retailersinformation r on r.RetCode = b.DistributorId 
	        LEFT JOIN billeditemdetails bi ON bi.BillNo = b.BillNo 
	        LEFT JOIN organization o on o.org_id = b.org_id WHERE b.org_id = $org_id and (b.membership_bill = 0 OR b.membership_bill IS NULL) AND is_cancelled = 0 
	        GROUP BY b.BillNo 
	        HAVING (collected_amt+TDS < total_amt OR collected_amt IS NULL ) AND total_amt > 0 
	        ORDER BY billDate desc";

	    $partial_pay_res = $this->db->query($sql)->getResultArray();

		    // Define time ranges
		    $date_3_months_ago = date('Y-m-d', strtotime('-3 months'));
		    $date_6_months_ago = date('Y-m-d', strtotime('-6 months'));
		    $date_12_months_ago = date('Y-m-d', strtotime('-12 months'));

			$user_wise_amt = [
			    '3_months' => 0,
			    '6_months' => 0,
			    '12_months' => 0,
			    'total_pending_amt' => 0, 
			];

			foreach ($partial_pay_res as $detail) {
			    $amount_due = $detail['total_amt'] - $detail['collected_amt'];
			    $bill_date = $detail['billDate'];

			    if ($bill_date >= $date_3_months_ago) {
			        $user_wise_amt['3_months'] += $amount_due;
			    }
			    if ($bill_date >= $date_6_months_ago) {
			        $user_wise_amt['6_months'] += $amount_due;
			    }
			    if ($bill_date >= $date_12_months_ago) {
			        $user_wise_amt['12_months'] += $amount_due;
			    }

			    $user_wise_amt['total_pending_amt'] += $amount_due;  
			}
	    return $user_wise_amt;
	}
	public function get_count_paind_unpaind_invoices()
	{
		$org_id = $this->session->get('org_id');
			$sql="SELECT COUNT(CASE WHEN b.NetAmount = c.AmountCollected THEN 1 END) AS paid_invoice,COUNT(CASE WHEN b.NetAmount != c.AmountCollected THEN 1 END) AS unpaid_invoice
					FROM billednodetails b 
					LEFT OUTER JOIN collection c 
					    ON c.invoice_no = b.invoice_no 
					    AND b.fin_yr = c.fin_yr 
					    AND b.org_id = c.org_id
					LEFT JOIN retailersinformation r 
					    ON r.RetCode = b.DistributorId 
					LEFT JOIN billeditemdetails bi 
					    ON bi.BillNo = b.BillNo 
					WHERE 
					    b.org_id = $org_id AND LEFT(b.billDate,7) = '".date('Y-m')."'
					    AND (b.membership_bill = 0 OR b.membership_bill IS NULL) 
					    AND b.is_cancelled = 0;
					";

		$query = $this->db->query($sql);
		$results = $query->getResultArray();  
		return $results;
	}
	public function get_total_paind_unpaind_invoices()
	{
		$org_id = $this->session->get('org_id');
			$sql="SELECT 
				    SUM(CASE WHEN b.NetAmount = c.AmountCollected THEN b.NetAmount ELSE 0 END) AS paid_invoice,
				    SUM(CASE WHEN b.NetAmount != c.AmountCollected THEN b.NetAmount ELSE 0 END) AS unpaid_invoice
				FROM billednodetails b
				LEFT OUTER JOIN collection c
				    ON c.invoice_no = b.invoice_no 
				    AND b.fin_yr = c.fin_yr 
				    AND b.org_id = c.org_id
				LEFT JOIN retailersinformation r
				    ON r.RetCode = b.DistributorId
				LEFT JOIN billeditemdetails bi
				    ON bi.BillNo = b.BillNo
				WHERE 
				    b.org_id = $org_id AND LEFT(b.billDate,7) = '".date('Y-m')."'
				    AND (b.membership_bill = 0 OR b.membership_bill IS NULL) 
				    AND b.is_cancelled = 0";

		$query = $this->db->query($sql);
		$results = $query->getResultArray();  
		return $results;
	}

	//To get total invoices
	public function getInvoices()
	{
		$org_id = $this->session->get('org_id');
		$sql = "SELECT COUNT(DISTINCT(invoice_no)) as totalInv FROM `billednodetails` WHERE org_id = $org_id AND LEFT(billDate,7) = '".date('Y-m')."'  ";
		$query = $this->db->query($sql)->getRowArray();
		return $query;
	}
	//To get Customer count
	public function getCustomers()
	{
		$sql = "SELECT COUNT(DISTINCT(RetCode)) as customerCnt FROM `retailersinformation` WHERE LEFT(date_updated,7) = '".date('Y-m')."' ";
		$query = $this->db->query($sql)->getRowArray();
		return $query;
	}

	public function getMonthlyInvData()
	{
		$org_id = $this->session->get('org_id');
		$dataArray = $result = array();
		$sql = "SELECT COUNT(DISTINCT(invoice_no)) as totalInv, DATE_FORMAT(created_date, '%m') AS month, created_date,org_id FROM `billednodetails` WHERE DATE_FORMAT(created_date, '%Y') = '".date('Y')."' AND org_id = $org_id GROUP BY month ORDER BY month";
		$query = $this->db->query($sql)->getResultArray();
		foreach ($query as $key => $value) {
			$dataArray[$value['month']] = $value;
		}
		for ($i=1; $i <= 12; $i++) { 
			$monthKey = str_pad($i, 2, '0', STR_PAD_LEFT);

			if(isset($dataArray[$monthKey]))
			{
				//echo "<pre> => " ; print_r($dataArray[$monthKey]);
				$result[$i] = $dataArray[$monthKey]['totalInv'];
			}else{
				$result[$i] = 0;
			}
			
		}

		$monthlyvalues = implode(',',$result);
		
		return $monthlyvalues;
	}

	public function getMonthlyInvSts()
	{
		$org_id = $this->session->get('org_id');
        $sql = "SELECT 
				COUNT(*) AS total_invoices,
				COUNT(CASE WHEN b.NetAmount = c.AmountCollected THEN 1 END) AS paid_invoice,
				COUNT(CASE WHEN b.NetAmount != c.AmountCollected 
				AND (c.AmountCollected IS NOT NULL AND TRIM(c.AmountCollected) != '') THEN 1 END) AS partially_paid,
				COUNT(CASE WHEN c.AmountCollected IS NULL OR TRIM(c.AmountCollected) = '' THEN 1 END) AS unpaid_invoice
				FROM billednodetails b 
				LEFT OUTER JOIN collection c ON c.invoice_no = b.invoice_no AND b.fin_yr = c.fin_yr AND b.org_id = c.org_id
				LEFT JOIN retailersinformation r ON r.RetCode = b.DistributorId 
				LEFT JOIN billeditemdetails bi ON bi.BillNo = b.BillNo 
				WHERE b.org_id = $org_id  AND LEFT(b.billDate,7) = '".date('Y-m')."' AND (b.membership_bill = 0 OR b.membership_bill IS NULL) AND b.is_cancelled = 0";
       
        $query = $this->db->query($sql);
        $results = $query->getRowArray();  
        return $results;
	}

}//class