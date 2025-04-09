
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>B2CL</title>
   <link rel="stylesheet" href="<?=base_url();?>css/report.css">
   <style type="text/css">
   
   </style>
  </head>
  <body>
  	 <table class="bordered_table">
	  	  	<tr>
	            <td title="1">Summary For B2CL(5)</td>
              	<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
              	
            </tr>
	      	<tr>
	           
	            <td>No. of Invoices</td>
              	<td></td>
              	<td>Total Invoice Value</td>
              	<td></td>
              	<td></td>
              	<td>Total Taxable Value</td>
              	<td>Total Cess</td>
              	<td></td>
              	
            </tr>
	      	<tr>
	          
	            <td><?=$b2b['invoiceCount'];?></td>
              	<td></td>
              	<td><?=number_format($b2b['TotalInvoiceValue'],2,'.','');?></td>
              	<td></td>
              	<td></td>
              	<td><?=number_format($b2b['TotalTaxableValue'],2,'.','');?></td>
              	<td>0.00</td>
              	<td></td>
           
              	
            </tr>
	      	<tr>
	            <td>Invoice Number</td>
              	<td>Invoice date</td>
              	<td>Invoice Value</td>
              	<td>Place Of Supply</td>
               	<td>Rate</td>
              	<td>Taxable Value</td>	
              	<td>Cess Amount</td>
              	<td>E-Commerce GSTIN</td>
             </tr>
          <?php 
          if(is_array(@$b2b['invoice']))
          {
          foreach($b2b['invoice'] AS $items){
          ?>
	      	<tr>
	            
	            <td><?=$items['invoice_no'];?></td>
	            <td><?=$items['inv_date'];?></td>
	            <td><?=$items['NetAmount'];?></td>
              	<td><?=$items['state'];?></td>
              	<td><?=$items['rate'];?></td>
              	<td><?=$items['TaxableValue'];?></td>
              	<td>0.00</td>
              	<td><?=$this->session->userdata('GSTIN');?></td>
              	
            </tr>
          <?php }
          }
          else 
          echo "There is no Invoice greater than Rs.250000.00 "
          ?>
		<tbody>
			
		
		</tbody>
		
	</table>
  
  </body>
</html> 