
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>B2B</title>
   <link rel="stylesheet" href="<?=base_url();?>css/report.css">
   <style type="text/css">
   
   </style>
  </head>
  <body>
  	 <table class="">
	  	  	<tr>
	            <td title="1">Summary For B2B(4)</td>
              	
              	
            </tr>
	      	<tr>
	            <td>No. of Recipients</td>
	            <td>No. of Invoices</td>
              	<td></td>
              	<td>Total Invoice Value</td>
              	<td></td>
              	<td></td>
              	<td></td>
              	<td></td>
              	<td></td>
              	<td>Total Taxable Value</td>
              	<td>0.00</td>
              	
            </tr>
	      	<tr>
	            <td><?=$b2b['no_of_recipients'];?></td>
	            <td><?=$b2b['invoiceCount'];?></td>
              	<td></td>
              	<td><?=number_format($b2b['TotalInvoiceValue'],2);?></td>
              	<td></td>
              	<td></td>
              	<td></td>
              	<td></td>
              	<td></td>
              	<td><?=number_format($b2b['TotalTaxableValue'],2);?></td>
              	<td></td>
              	
            </tr>
	      	<tr>
	            <td>GSTIN/UIN of Recipient</td>
	            <td>Invoice Number</td>
              	<td>Invoice date</td>
              	<td>Invoice Value</td>
              	<td>Place Of Supply</td>
              	<td>Reverse Charge</td>
              	<td>Invoice Type</td>
              	<td>E-Commerce GSTIN</td>
              	<td>Rate</td>
              	<td>Taxable Value</td>
              	<td>Cess Amount</td>
              	
            </tr>
          <?php 
          if(sizeof(@$b2b['invoice'])>0)
          {
          foreach($b2b['invoice'] AS $items){
          ?>
	      	<tr>
	            <td><?=$items['GSTIN'];?></td>
	            <td><?=$items['invoice_no'];?></td>
	            <td><?=$items['inv_date'];?></td>
	            <td><?=$items['NetAmount'];?></td>
              	<td><?=$items['state'];?></td>
              	<td>N</td>
              	<td>Regular</td>
              	<td></td>
              	<td><?=$items['rate'];?></td>
              	<td><?=$items['TaxableValue'];?></td>
              	<td>0.00</td>
              	
            </tr>
          <?php }
          }?>
		<tbody>
			
		
		</tbody>
		
	</table>
  
  </body>
</html> 