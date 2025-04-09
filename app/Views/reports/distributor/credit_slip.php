<?php $this->session = \Config\Services::session();?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Sales</title>
 	<link rel="icon" href="./favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="<?=base_url();?>css/report.css">
  </head>
  <body>
  
	 <?php 
	 
	$i=1;
	 foreach ($credit_slip as $bItems)
	 {
	 	 $i=$i+1;
	 	
	 	 if($i%2==0) 
	 	  	echo "<div class='page_break'>";
		$rightstyle=($i%2==0)?'border_right_dashed':'';
	 	?>

	  <table class="table" style="float:<?=($i%2==0)?'left':'right';?> ;width:<?=@$settings['width']?>%;">
		  <tr>
		  	<td>
		  		<p align="center"><font size=4><?= $this->session->get('OrgName');?></font>
	 				<br />REG NO: <?= $this->session->get('DLno');?>			
	 				<br /><?= $this->session->get('OrgAddress');?>			
	 				<br />Contacts:<?= $this->session->get('OrgPhno');?>	<?= $this->session->get('Mobile')!=""?$this->session->get('Mobile'):'';?>		
	 			</p>
		  		<p align="left">To,<br /><font size=4><?= $bItems['RetName'];?></font>
	 				<br />REG NO: <?= $bItems['RetLcNo'];?>			
	 				<br /><?= $bItems['RetAdderss'];?>			
	 				<br />Phone :<?= $bItems['RetPhoneNo'];?>		
	 			</p>
	 			<p><strong>Bill NO:<?= $bItems['BillNo'];?></strong>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Date:<?= date_mysql_user($bItems['billDate']);?></strong></p>
		  		<table>
		  			
		  				<?php if(@$settings['GrossAmount']){?><tr><td>Grogg Amount:</td><td align="right"><?= $bItems['GrossAmount'];?></td></tr><?php }?>
			  			<?php if(@$settings['Taxes']){?>
			  			<tr><td>SGST</td><td align="right"><?= $bItems['TaxLtSum'];?></td></tr>
			  			<tr><td>CGST:</td><td align="right"><?= $bItems['TaxCstSum'];?></td></tr>
			  			<?php }?>
		  				<?php if(@$settings['Discount']){?><tr><td>Discount:</td><td align="right"><?= $bItems['TotalDiscount'];?></td></tr><?php }else echo "<br>";?>
		  				<?php if(@$settings['AdditionalDiscount']){?><tr><td>Additional Discount:</td><td align="right"><?= $bItems['LassDiscountAmount'];?></td></tr><?php }?>
		  				<?php if(@$settings['LessSalesReturn']){?><tr><td>Less Sales Return:</td><td align="right"><?= $bItems['LessSalesReturn'];?></td></tr><?php }?>
		  				<?php if(@$settings['Adjustment']){?><tr><td>Adjustment:</td><td align="right"><?= $bItems['OtherAdjustment'];?></td></tr><?php }?>
		  				 				
		  				
		  				<tr><td>NET:</td><td align="center"><?= $bItems['NetAmount'];?></td></tr>
		  				<tr><td colspan="2"><b><?=ucwords(convert_number_to_words($bItems['NetAmount']));?></b></td></tr>
		  		
		  		</table>
		  	<?php if(!empty($setting['gap']))for($j=0;$j<$settings['gap'];$j++)echo "<br />";?>
		  		<p>Signature</p>	
		  		<p>Date:</p>	
		  	</td>
		  	
		  </tr>
	  
	  </table>
	 <?php 
	 
	if($i%2!=0)
	echo "<br style='clear:both'/></div>";
	
	 }
	 ?>
  </body>
</html> 