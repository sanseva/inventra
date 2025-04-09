<html>
<head>
<title><?=$Billno;?></title>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
<style type="text/css">
.text-right{text-align:right}
table td{padding:1px 2px}
table th{border-bottom:1px dashed #000;border-top:1px dashed #000}
.border-top{border-top:1px dashed #000}
.spans{border:0px dashed #000;text-align:center;padding:2px 10px;font-weight:bold;float:left}
table{width:100%}
p{margin:0px}
.clear{clear:both}
</style>
</head>
<body>
	 <table>
	 	<tr>
	 		<td colspan="2" class="text-right">
		 		<table>
		 			<tr>
		 				<td width="33%"></td>
		 				<td width="33%" align="center">CASH / CREDIT VOUCHER</td>
		 				<td width="33%" class="text-right">BILL NO:<?=$Billno;?> DT: <?=$billDate;?></td>
		 			</tr>
		 		</table>
	 		
	 		</td>
	 	</tr>
 		<tr>
	 		<td width="50%">
	 		
	 		<font size=4><?= $this->session->userdata('OrgName');?></font>
	 				<br />GSTIN: <?= $this->session->userdata('GSTIN');?>			
	 				<br />DL NO: <?= $this->session->userdata('DLno');?> <?= $this->session->userdata('BCDANO');?>			
	 				<br /><?= $this->session->userdata('OrgAddress');?>			
	 				<br />Contacts:<?= $this->session->userdata('OrgPhno');?> <?= $this->session->userdata('Mobile')!=""?$this->session->userdata('Mobile'):'';?>		
	 		
	 		</td>
	 		<td width="50%">
	 			<table>
	 				<tr>
	 					<td class="text-right">NAME : </td>
	 					<td><strong><?=$RetName;?></strong></td>
					</tr>	 			
	 				<tr>
	 					<td class="text-right">DL NO :</td>
	 					<td><?=$RetLcNo;?></td>
					</tr>	 			
	 				<tr>
	 					<td class="text-right">ADDRESS :</td>
	 					<td><?=$RetAdderss;?></td>
					</tr>	 			
	 			</table>
	 		</td>
 		</tr>	
	 </table>
	 <table>
     	<thead>
         	<tr>
              <?php
              $Amountcolspan=3;
              $colCount=-1;
              	echo '<th align="left">QTY</th>';$colCount++;
               	echo '<th align="left">PRODUCT</th>';$colCount++;
               	if($settings['Pack']) {echo '<th align="left">PACK</th>';$colCount++;}
               	if($settings['mfg']) {echo '<th align="left">MFG</th>';$colCount++;}
               	if($settings['BatchNo']) {echo '<th align="left">BATCH</th>'; $colCount++;}
               	if($settings['ExpDate']) {echo '<th align="left">EXP.DATE</th>';$colCount++;}
               	if($settings['MRP']) {echo '<th align="right">MRP</th>';$colCount++;}
               	if($settings['Rate']) {echo '<th align="right">RATE</th>';$colCount++;}
              	if($settings['ADD1']) {echo '<th align="right">SGST%</th>';$colCount++;}
              	if($settings['VALUE1']) {echo '<th align="right">SGST</th>';$colCount++;}
              	if($settings['ADD2']) {echo '<th align="right">CGST%</th>';$colCount++;}
              	if($settings['VALUE2']) {echo '<th align="right">CGST</th>';$colCount++;}
              	if($settings['EDperUnit']) {	echo '<th align="right">IGST%</th>';$colCount++;}
              	if($settings['TotalED']) {echo '<th align="right">IGST</th>';$colCount++;}
              	if($settings['DiscountPer']) {echo '<th align="right">DIS%</th>';$colCount++;}
              	if($settings['VALUE3']) {echo '<th align="right">DIS.</th>';$colCount++;}
              	if($settings['AMT']) {echo '<th align="right">AMT.</th>';$colCount++;}
               	?>
              </tr>
         </thead>
         <tbody>
         <?php 
         $SlNo=0;
        $retFlag=false;
            foreach($products as $item){
            	
            	$SlNo=$SlNo+1;
            	$totalMrp=0;
            	$lessSalesReturn=0;
            	if($item['flag']=="P")
            	{
              	?>
              	<tr>
              		
              		<td nowrap><?=$item['Qty'];?> + <?=$item['FreeQty'];?></td>
              		<td nowrap><?=$item['flag']=="R"?$item['return_type']."-":'';?><?=$item['ItemName'];?></td>
              		<?php 
              			if($settings['Pack']) {echo '<td align="left">'.$item['Pack'].'</td>';}
              			if(@$settings['mfg']) {echo '<td align="left">'.@$item['mfg'].'</td>';}
              			if($settings['BatchNo']) {echo '<td align="left">'.@$item['BatchNo'].'</td>';}
              			if($settings['ExpDate']) {echo '<td align="left">'.mysql_to_exp_dat($item['ExpDate']).'</td>';}
              			if($settings['MRP']) {echo '<td align="right">'.$item['MRP'].'</td>';}
              			if($settings['Rate']) {echo '<td align="right">'.$item['Rate'].'</td>';}
              			if($settings['ADD1']) {echo '<td align="right">'.$item['ADD1'].'</td>';}
              			if($settings['VALUE1']) {echo '<td align="right">'.$item['VALUE1'].'</td>';}
              			if($settings['ADD2']) {echo '<td align="right">'.$item['ADD2'].'</td>';}
              			if($settings['VALUE2']) {echo '<td align="right">'.$item['VALUE2'].'</td>';}
              			if($settings['EDperUnit']) {echo '<td align="right">'.$item['EDperUnit'].'</td>';}
              			if($settings['TotalED']) {echo '<td align="right">'.$item['TotalED'].'</td>';}
              			if($settings['DiscountPer']) {echo '<td align="right">'.$item['DiscountPer'].'</td>';}
              			if($settings['VALUE3']) {echo '<td align="right">'.$item['VALUE3'].'</td>';}
              			if($settings['AMT']) {echo '<td align="right">'.$item['AMT'].'</td>';}
               	
              		?>
              		
             <tr>
              	<?php 
            	}
            	else 
            	{
            		if(!$retFlag)
            		{
            		echo'<tr><td colspan="'.$colCount.'"> Returns</td></tr>';
            		$retFlag=true;
            		}
            		?>
            	<tr>
            		<td nowrap><?=$item['Qty'];?> + <?=$item['FreeQty'];?></td>
              		<td nowrap><?=$item['flag']=="R"?$item['return_type']."-":'';?><?=$item['ItemName'];?></td>
              		<?php 
              			if($settings['Pack']) {echo '<td align="left">'.$item['Pack'].'</td>';}
              			if(@$settings['mfg']) {echo '<td align="left">'.@$item['mfg'].'</td>';}
              			if($settings['BatchNo']) {echo '<td align="left">'.@$item['BatchNo'].'</td>';}
              			if($settings['ExpDate']) {echo '<td align="left">'.mysql_to_exp_dat($item['ExpDate']).'</td>';}
              			if($settings['MRP']) {echo '<td align="right">'.$item['MRP'].'</td>';}
              			if($settings['Rate']) {echo '<td align="right">'.$item['Rate'].'</td>';}
              			if($settings['ADD1']) {echo '<td align="right">'.$item['ADD1'].'</td>';}
              			if($settings['VALUE1']) {echo '<td align="right">'.$item['VALUE1'].'</td>';}
              			if($settings['ADD2']) {echo '<td align="right">'.$item['ADD2'].'</td>';}
              			if($settings['VALUE2']) {echo '<td align="right">'.$item['VALUE2'].'</td>';}
              			if($settings['EDperUnit']) {echo '<td align="right">'.$item['EDperUnit'].'</td>';}
              			if($settings['TotalED']) {echo '<td align="right">'.$item['TotalED'].'</td>';}
              			if($settings['DiscountPer']) {echo '<td align="right">'.$item['DiscountPer'].'</td>';}
              			if($settings['VALUE3']) {echo '<td align="right">'.$item['VALUE3'].'</td>';}
              			if($settings['AMT']) {echo '<td align="right">'.$item['AMT'].'</td>';}
               	
              		?>
              		
            	<tr>
            	<?php 
            	}
              	$totalMrp=$totalMrp+($item['MRP']*($item['Qty']+$item['FreeQty']));
              
              	if($item['flag']=="R")
              	$lessSalesReturn=$lessSalesReturn+$item['AMT'];
              }
              for($i=14;$i>=$SlNo;$i--)
              echo "<tr><td>&nbsp;</td></tr>";
              ?>
              <tr >
              	<td class="border-top" colspan="<?=$colCount-$Amountcolspan?>" rowspan="7" valign="top">
              			<p class="clear">
              			<b>Total MRP:<?=number_format($totalMrp,2);?></b>
              			<b>Less Sales RETURN:<?=number_format($lessSalesReturn,2);?></b> 
              			</p>
              			<br />
              			<p><i class="fa fa-inr"></i> Rs.<?=ucwords(convert_number_to_words($NetAmount))?></p>
              			<br />
              			<br />
              			<?=$settings['MRP']?>
              			<p>Signature</p>
              			
              	</td>
              	<td class="text-right border-top" colspan="<?=$Amountcolspan?>">TOTAL</td>
              	<td class="text-right border-top"><?=$GrossAmount; ?></td>
              </tr>
              <tr>
              	
              	 <td class="text-right" colspan="<?=$Amountcolspan?>">SGST :</td>
              	<td class="text-right"><?=$TaxLtSum; ?></td>
              </tr>
              <tr>
              	<td class="text-right" colspan="<?=$Amountcolspan?>"> CGST :</td>
              	<td class="text-right"><?=$TaxCstSum; ?></td>
              </tr>
              <tr>
              	<td class="text-right" colspan="<?=$Amountcolspan?>"> IGST :</td>
              	<td class="text-right"><?=$TotalED; ?></td>
              </tr>
              <tr>
              	<td class="text-right" colspan="<?=$Amountcolspan?>"> <span style="float:left">Less addl. Discount @<?=number_format($LessDiscountPercent,2);?></span> LESS DISCOUNT :</td>
              	<td class="text-right"><?=$TotalDiscount+$LassDiscountAmount; ?></td>
              </tr>
            
              <tr>
              	
              	
              	<td class="text-right" colspan="<?=$Amountcolspan?>">  Adj. Amt. :</td>
              	<td class="text-right"><?=$OtherAdjustment; ?></td>
              </tr>
              <tr>
              	<td class="text-right" colspan="<?=$Amountcolspan?>">NET :</td>
              	<td class="text-right"><strong><?=$NetAmount; ?></strong></td>
              </tr>
             
             
             
              
         </tbody>
      </table>
</body>
<script>

window.print();
</script>
</html>