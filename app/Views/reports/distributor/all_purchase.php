<?php $this->session = \Config\Services::session();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sales</title>
 <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url();?>css/report.css">
  </head>
  <body>
   <table class="table">
	 	<tr>
	 		<td colspan="2" class="text-right">
		 		<table class="table">
		 			<tr>
		 				<td width="33%"></td>
		 				<td width="33%" align="center">PURCHASE REPORT</td>
		 				<td width="33%" class="text-right">Date:<?=date('d/M/Y');?></td>
		 			</tr>
		 		</table>
	 		
	 		</td>
	 	</tr>
 		<tr>
	 		<td width="100%" align="center">
	 		
	 		<font size=4><?= $this->session->get('OrgName');?></font>
	 				<br />REG NO: <?= $this->session->get('DLno');?> 			
	 				<br /><?= $this->session->get('OrgAddress');?>			
	 				<br />Contacts:<?= $this->session->get('OrgPhno');?>	<?= $this->session->get('Mobile')!=""?$this->session->get('Mobile'):'';?>		
	 		
	 		</td>
	 		
 		</tr>	
	 </table>
	 <table>
	  	<thead>
	      	<tr>
	              
              	<th title="1">SL.NO</th>
              	<th title="1">SUPPLIER</th>
               	<th title="2">BILL NO</th>	
               	<th title="2">ENTRY NO</th>
              	<th title="2">BILL DT.</th>
              	<th title="3">GROSS</th>
              	<th title="4" align="right">SGST</th>
              	<th title="5" align="right">CGST</th>
              	<th title="6" align="right">IGST</th>
              	<th title="7" align="right">DISC.</th>
              	<th title="8" align="right">A. DISC.</th>
              	<th title="9" align="right">ADJ.</th>
              	<th title="9" align="right">RETURN</th>
              	<th title="10" align="right">NET</th>
              	
            </tr>
		</thead>
		<tbody>
			<?php 
			$I=0;
			$GROSS=0;$lt=0;$cst=0.00;$ed=0;$disT=0;$disO=0;$sr=0;$net=0;$oa=0;
			foreach($sales as $items){
				$GROSS=$GROSS+$items['GrossAmount'];$lt=$lt+$items['TaxLtSum'];
				$cst=$cst+$items['TaxCstSum'];	$ed=$ed+$items['ED'];
				$sr=$sr+$items['LessSalesReturn'];	$net=$net+$items['NetAmount'];
				$disT=$disT+$items['TotalDiscount'];$disO=$disO+$items['LassDiscountAmount'];
				$oa=$oa+$items['OtherAdjustment'];
				$I=$I+1;
			?>
			<tr>
				<td><?=$I?></td>
				<td><?=$items['supplier_name']?></td>
				<td><?=$items['BillNo']?></td>
				<td><?=$items['PurchaseEntryNo']?></td>
				
				<td><?=date_mysql_user($items['BillDate'])?></td>
				<td align="right"><?=$items['GrossAmount']?></td>
				<td align="right"><?=$items['TaxLtSum']?></td>
				<td align="right"><?=$items['TaxCstSum']?></td>
				<td align="right"><?=$items['ED']?></td>
				<td align="right"><?=$items['TotalDiscount']?></td>
				<td align="right"><?=$items['LassDiscountAmount']?></td>
				<td align="right"><?=$items['OtherAdjustment']?></td>
				<td align="right"><?=$items['LessSalesReturn']?></td>
				<td align="right"><?=$items['NetAmount']?></td>
				</tr>
			<?php 
			}
			?>
		
		</tbody>
		<tfoot>
		<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				
				              
              	<th title="4" align="right"><?=number_format($GROSS,2)?></th>
              	<th title="4" align="right"><?=number_format($lt,2)?></th>
              	<th title="5" align="right"><?=number_format($cst,2)?></th>
              	<th title="6" align="right"><?=number_format($ed,2)?></th>
              	<th title="7" align="right"><?=number_format($disT,2)?></th>
              	<th title="8" align="right"><?=number_format($disO,2)?></th>
              	<th title="9" align="right"><?=number_format($oa,2)?></th>
              	<th title="9" align="right"><?=number_format($sr,2)?></th>
              	<th title="10" align="right"><?=number_format($net,2)?></th>
		</tr>
		</tfoot>
	</table>
  
  </body>
</html> 