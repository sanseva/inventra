<html>
<head>
<title><?=$invoice_no;?></title>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
 <link rel="stylesheet" href="<?=base_url();?>css/report.css">
<style type="text/css">
.text-right{text-align:right}
table td{padding:1px 2px}
table th{border-bottom:1px solid #000;border-top:1px solid #000}
.border-top{border-top:1px dashed #000}
.spans{border:0px dashed #000;text-align:center;padding:2px 10px;font-weight:bold;float:left}
table{width:100%}
p{margin:0px}
.clear{clear:both}
.font12,table td,table th,font{
	font-size:12px;
}
</style>
</head>
<body class="font12">
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<table>
<tr><td align="center"><font size=4>TAX INVOICE<br/>Original For Receipt</font></td></tr>
<tr>
	<td> 
	<?php
	$year ="";
	$date = date('Y-m-d',strtotime(str_ireplace("/","-",$billDate)));
	if(strtotime($date) >= strtotime("2018-04-01")){
		if (date('m',strtotime($date)) > 3) {
			$year = "/".date('Y',strtotime($date))."-".(date('y',strtotime($date)) +1);
		}else {
			$year = "/".(date('Y',strtotime($date))-1)."-".date('y',strtotime($date));
		}
	}
	?>
	<table width="100%" class="">
			 <tr>
			 	<td>
			 	<font size=4>INVOICE NO : AO<?=$year?>/<?=str_pad($invoice_no,"3","0",STR_PAD_LEFT) ;?></font><br>
				<?php if(!empty($work_order_no)){ ?>
			 	<font size=4>PO NO : <?=$work_order_no?></font>
				<?php }?>
				</td>
			
			 	<td align="right">
			 	<font size=4> Dated: <?=$billDate;?></font>
				</td>
			</tr>
				
	</table>
			 <br />
			 <br />
			
			 <br />
			 To,<br />
			 <?=$RetName;?>,<br />
			 <?=$RetAdderss;?>,<br />
			<?php if( ! empty($RetCity)){ 
			?>
				CITY : <?php echo $RetCity;?>,<br />
			<?php
			 }
			 ?>
			 STATE CODE : <?=state_id_name($state_id)?>,<br />
			<?php if( ! empty($pincode)){
				 
			?>
				PIN CODE : <?php echo $pincode;?>,<br />
			<?php
			 }
			 ?>
			 GSTIN : <?=$rgstin;?><br />
			<?php
			if(!empty($place_of_supply)){
				echo "Place of Supply : ".$place_of_supply;
			}
			?>
				<br />
				<br />
				 <table class="bordered_table" border="1" cellpadding='10'>
			     	<thead>
			         	<tr>
			              <?php
			              $Amountcolspan=3;
			              $colCount=-1;
						   echo '<th align="center">SR</th>';$colCount++;
			              echo '<th align="center">DESCRIPTION</th>';$colCount++;
			              	echo '<th align="center">SAC Code</th>';$colCount++;
							if($wo_type=='Q'){
									echo '<th align="center">'.$type.'</th>';$colCount++;
							}
			              
			               	
			               	if($settings['Pack']) {echo '<th align="center">PACK</th>';$colCount++;}
			               	if($settings['mfg']) {echo '<th align="center">MFG</th>';$colCount++;}
			               	if($settings['BatchNo']) {echo '<th align="center">BATCH</th>'; $colCount++;}
			               	if($settings['ExpDate']) {echo '<th align="center">EXP.DATE</th>';$colCount++;}
			               	if($settings['MRP']) {echo '<th align="center">MRP</th>';$colCount++;}
							if($wo_type =='Q'){
								if($settings['Rate']) {echo '<th align="center">RATE</th>';$colCount++;}
							}
			               
			              	if($settings['ADD1']) {echo '<th align="center">SGST %</th>';$colCount++;}
			              	if($settings['VALUE1']) {echo '<th align="center">SGST</th>';$colCount++;}
			              	if($settings['ADD2']) {echo '<th align="center">CGST %</th>';$colCount++;}
			              	if($settings['VALUE2']) {echo '<th align="center">CGST</th>';$colCount++;}
			              	if($settings['EDperUnit']) {	echo '<th align="center">IGST %</th>';$colCount++;}
			              	if($settings['TotalED']) {echo '<th align="center">IGST</th>';$colCount++;}
			              	if($settings['DiscountPer']) {echo '<th align="center">DIS %</th>';$colCount++;}
			              	if($settings['VALUE3']) {echo '<th align="center">DIS.</th>';$colCount++;}
							if($settings['AMT']) {echo '<th align="center">AMOUNT</th>';$colCount++;}
						
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
								$data_range = "";
								if(!empty($item['from_date']) && !empty($item['to_date']) && $item['from_date'] != "0000-00-00" && $item['to_date'] != "0000-00-00"){
									if($item['from_date'] == $item['to_date']){
										if ( ! empty($item["from_date"]) && $item['from_date']!='1970-01-01')
										{
											$data_range = 'On '.date("d-m-Y",strtotime($item["from_date"]));
										}
										
									}
									else{
										if ( ! empty($item["from_date"]) && ! empty($item["to_date"]) && $item['from_date']!='1970-01-01')
										{
											$data_range = 'Periods  '.date("d-m-Y",strtotime($item["from_date"])).' To  '. date("d-m-Y",strtotime($item["to_date"]));
											
										}	
									}								
								}
			              	?>
			              	<tr>
			              		
			              		<td align='center'><?= $SlNo?></td>
			              		<?php if(!empty($plant_id)){?>
			              		<td align='center' width="200px"><?=$item['flag']=="R"?$item['return_type']."-":'';?><?=$item['ItemName'] .'<br/>'.$data_range?></td>
								<?php }else{?>
								<td align='center' width="200px"><?=$item['flag']=="R"?$item['return_type']."-":'';?><?=$item['ItemName']?></td>
								<?php
								}?>
			              		<td nowrap align='center'><?=$item['hsn_code'];?></td>
								<?php 
								if($wo_type=='Q'){
								?>
			              		<td nowrap align='center'><?=$item['Qty'];?></td>
								<?php 
								}
								?>
								
			              		<?php 
			              			if($settings['Pack']) {echo '<td align="center">'.$item['Pack'].'</td>';}
			              			if(@$settings['mfg']) {echo '<td align="center">'.@$item['mfg'].'</td>';}
			              			if($settings['BatchNo']) {echo '<td align="center">'.@$item['BatchNo'].'</td>';}
			              			if($settings['ExpDate']) {echo '<td align="center">'.mysql_to_exp_dat($item['ExpDate']).'</td>';}
			              			if($settings['MRP']) {echo '<td align="center">'.$item['MRP'].'</td>';}
									if($wo_type =='Q'){
										if($settings['Rate']) {echo '<td align="center">'.$item['Rate'].'</td>';}
									}
			              			if($settings['ADD1']) {echo '<td align="center">'.$item['ADD1'].'</td>';}
			              			if($settings['VALUE1']) {echo '<td align="center">'.$item['VALUE1'].'</td>';}
			              			if($settings['ADD2']) {echo '<td align="center">'.$item['ADD2'].'</td>';}
			              			if($settings['VALUE2']) {echo '<td align="center">'.$item['VALUE2'].'</td>';}
			              			if($settings['EDperUnit']) {echo '<td align="center">'.$item['EDperUnit'].'</td>';}
			              			if($settings['TotalED']) {echo '<td align="center">'.$item['TotalED'].'</td>';}
			              			if($settings['DiscountPer']) {echo '<td align="center">'.$item['DiscountPer'].'</td>';}
			              			if($settings['VALUE3']) {echo '<td align="center">'.$item['VALUE3'].'</td>';}
									if($settings['AMT']) {echo '<td align="center">'.$item['AMT'].'</td>';}
									
			               	
			              		?>
			              		
			            	 </tr>
			            	 
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
			            		
			              		<td nowrap><?=$item['flag']=="R"?$item['return_type']."-":'';?><?=$item['ItemName'];?></td>
								<?php 
									if($wo_type=='Q'){
								?>
			              		<td nowrap><?=$item['Qty'];?> </td>
								<?php } 
			              			if($settings['Pack']) {echo '<td align="left">'.$item['Pack'].'</td>';}
			              			if(@$settings['mfg']) {echo '<td align="left">'.@$item['mfg'].'</td>';}
			              			if($settings['BatchNo']) {echo '<td align="left">'.@$item['BatchNo'].'</td>';}
			              			if($settings['ExpDate']) {echo '<td align="left">'.mysql_to_exp_dat($item['ExpDate']).'</td>';}
			              			if($settings['MRP']) {echo '<td align="right">'.$item['MRP'].'</td>';}
									if($wo_type =='Q'){
										if($settings['Rate']) {echo '<td align="right">'.$item['Rate'].'</td>';}
									}
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
							
			            	</tr>
			            	<?php 
			            	}
			              	$totalMrp=$totalMrp+($item['MRP']*($item['Qty']+$item['FreeQty']));
			              
			              	if($item['flag']=="R")
			              	$lessSalesReturn=$lessSalesReturn+$item['AMT'];
			              }
			              //for($i=14;$i>=$SlNo;$i--)
			              //echo "<tr><td style='border:1px' colspan='7'>&nbsp;</td></tr>";
			              ?>
						  <tr><td colspan='<?=$colCount+1;?>'>&nbsp; </td></tr>
			              <tr>
			              	
			              	<td class="text-right bordor-bottom" colspan="<?=$colCount?>"><strong>SUB TOTAL</strong></td>
			              	<td class="text-right "><strong><?=$GrossAmount; ?></strong></td>
			              </tr>
			              <tr>
			              	
			              	 <td class="text-right" colspan="<?=$colCount?>"><strong> SGST Tax </strong></td>
			              	<td class="text-right"><strong><?=$TaxLtSum; ?></strong></td>
			              </tr>
			              <tr>
			              	<td class="text-right" colspan="<?=$colCount?>"><strong>CGST Tax</strong></td>
			              	<td class="text-right"><strong><?=$TaxCstSum; ?></strong></td>
			              </tr>
			              <tr>
			              	<td class="text-right" colspan="<?=$colCount?>"><strong> IGST Tax</strong> </td>
			              	<td class="text-right"><strong><?=$TotalED; ?></strong></td>
			              </tr>
			            
			            
			              <tr>
			              	
			              	
			              	<td class="text-right" colspan="<?=$colCount?>"><strong>Adj. Amt.</strong> </td>
			              	<td class="text-right"><strong><?=$OtherAdjustment; ?></strong></td>
			              </tr>
			              <tr>
			              	<td class="text-right" colspan="<?=$colCount?>"><strong>NET PAYABLE </strong></td>
			              	<td class="text-right"><strong><?=$NetAmount; ?></strong></td>
			              </tr>
						  
			             <tr>
							<td class="border-top" colspan="<?=$colCount+$Amountcolspan?>"  valign="top">
			              			
			              			<br />
			              			<i class="fa fa-inr text-right"></i> (Rs.<?=ucwords(convert_number_to_words($NetAmount))?>)
			              			<br />
			              			<br />
			              			
			              	</td>
						</tr>
						
						
			             
			             
			              
			         </tbody>
			      </table>
	</td>
	</tr>
	<br/>
	<br/>
	<br/>
	<br/>
									
	
<!--	<tr><td><small>GSTIN: <?= $this->session->userdata('GSTIN');?>, PAN: <?= @$this->session->userdata('PAN');?></small></td></tr>-->
	</table>
	<br/><br/>
	<strong><?= $this->session->userdata('OrgName');?></strong><br />
	<strong>GSTIN NO : </strong><?= $this->session->userdata('DLno');?><br/>
	<strong>STATE : </strong><?=state_id_name($this->session->userdata("state_id"))?><br/><br/>
	<!--<strong>BANK : </strong>Kotak Mahindra Bank<br/>
	<strong>BRANCH : </strong>Mulund West<br/>
	<strong>A/C No : </strong>9712031920<br/>
	<strong>IFSC CODE : </strong>KKBK0000642<br/>-->
			              		<br />
			              		<br />
			              		<br />
			              		<br />
			              			<p>Partner/Manager</p>
			              			<br />
	<br />
	<br />
	<br />
	Checked & Certified by User
</body>
<script>
window.print();
</script>
</html>