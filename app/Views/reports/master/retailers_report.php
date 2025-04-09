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
   	<?php echo view('includes/report_header');?>
	
	 <table>
	  	<thead>
	      	<tr>
	              
              	<th title="1">SL.NO</th>
              	<th title="1">CUSTOMER</th>
              	<th title="1">GSTIN</th>
              	<th title="1">DL NO</th>
               	<th title="2">PHONE NO</th>	
              	<th title="2">EMAIL</th>
              	<th title="3">ADDRESS</th>
              	<th title="3">CR. DAY</th>
              	<th title="3" align="right">DIS.%</th>
              	
              	
            </tr>
		</thead>
		<tbody>
	 	<?php 
	 	$I=0;
		if(!empty($retailers)){
			foreach($retailers as $items){
				$I++;
			
				?>
			<tr>
				<td><?=$I?></td>
				<td><?=$items['RetName']?></td>
				<td><?=$items['GSTIN']?></td>
				<td><?=$items['RetLcNo']?></td>
				<td><?=$items['RetPhoneNo']?></td>
				<td><?=$items['RetEmail']?></td>
				<td><?=$items['RetAdderss']?></td>
				<td><?=$items['RetCreditDays']?></td>
				<td align="right"><?=$items['discount']?></td>
			
		</tr>
				<?php 
			}
		}
			?>
		</tbody>
		</table>
		
  </body>
</html> 