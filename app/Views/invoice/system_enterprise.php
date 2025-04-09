<?php
$year ="";
$date = date('Y-m-d',strtotime(str_ireplace("/","-",$billDate)));
if(strtotime($date) >= strtotime("2018-04-01")){
	if (date('m',strtotime($date)) > 3) {
		$year = date('Y',strtotime($date))."-".(date('y',strtotime($date)) +1)."/";
	}else {
		$year = (date('Y',strtotime($date))-1)."-".date('y',strtotime($date))."/";
	}
}
?>
<html>
<head>
<title><?=$year?><?= $invoice_no ;?></title>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
 <link rel="stylesheet" href="<?=base_url();?>css/report.css">
<style type="text/css">
.text-right{text-align:right}
table td{padding:1px 2px}
table th{border-bottom:1px dashed #000;border-top:1px dashed #000;margin:0 !important;padding:0 !important}
.border-top{border-top:1px dashed #000}
.spans{border:0px dashed #000;text-align:center;padding:2px 10px;font-weight:bold;float:left}
table{width:100%}
p{margin:0px}
.clear{clear:both}

</style>
</head>
<body>
<br/>
<br/>
<br/>
<br/>
<table class="bordered_table">
	<tr>
		<td>
			<font size=5 style="font-family: serif;"><?= $this->session->userdata('OrgName');?></font>
		</td>
	</tr><tr>
		<td>
			<font size=3 style=""><small style="font-size:12px;"><?= $this->session->userdata('OrgAddress');?>,<?= $this->session->userdata('OrgPhno');?>, <?= $this->session->userdata('Mobile')!=""?$this->session->userdata('Mobile'):'';?>
			,  <?= $this->session->userdata('Email')!=""?$this->session->userdata('Email'):'';?></small></font>
		</td>
	</tr>
	<tr>
		<td>
			<?php if($generated_bill_type == 'I'){
					$type = 'TAX INVOICE';
			}else{
					$type = 'DEBIT NOTE';
			}?>
			<font style='font-size:14px;text-align:center;margin: auto;display: block;padding-top: 20px;'><?=$type?></font>
			<br />
			<br />
			<table width="100%" class="no_bordered_table">
				<tr>
					<td style="font-size:12px;">
						<div style="width:49%;float:left;">
						<?php
						if(!empty($work_order_no)){
							?><font size=2>W/O Number : <?= $work_order_no;?></font></br></br><?php
						}
						?>
						<font size=2>INVOICE NO : <?=$year?><?= $invoice_no ;?></font>
						</div>
						<div style="width:49%;float:right;">
							<font size=2 style="float:right;">Dated: <?=$billDate;?></font>
						</div>
					</td>
				</tr>
			</table>
				<div style="font-size:12px;">
				<br />
				 To,<br />
				 <?=$RetName;?>,<br />
				 <?=$RetAdderss;?>,<br />
				 STATE CODE :<?=str_pad($state_id,2,'0',STR_PAD_LEFT);?>,<br />
				 GSTIN : <?=$rgstin;?>,<br />
				 <?php
				if(!empty($place_of_supply)){
					?>Place of Supply : <?=$place_of_supply;?><?php
				}
				?>
				<br />
				<br />
				</div>
				<table class="bordered_table" cellpadding='7' style="font-size:12px;border-left:0px !important;width: 100%;">
					<thead>
						<tr>
						  <?php
						  $Amountcolspan=3;
						  $colCount=-1;
						  echo '<th align="center" width="20px">SR</th>';$colCount++;
						  echo '<th align="center" width="200px">DESCRIPTION</th>';$colCount++;
						  if($wo_type =='Q'){
							echo '<th align="center" width="40px">Qty</th>';$colCount++;  
						  }
							echo '<th align="center" width="70px">SAC/HSN</th>';$colCount++;
							
							
							if($settings['Pack']) {echo '<th align="center" width="60px">PACK</th>';$colCount++;}
							if($settings['mfg']) {echo '<th align="center">MFG</th>';$colCount++;}
							if($settings['BatchNo']) {echo '<th align="center">BATCH</th>'; $colCount++;}
							if($settings['ExpDate']) {echo '<th align="center">EXP.DATE</th>';$colCount++;}
							if($settings['MRP']) {echo '<th align="center">MRP</th>';$colCount++;}
							if($wo_type =='Q'){
								if($settings['Rate']) {echo '<th align="center" width="70px" >RATE</th>';$colCount++;}
							}
							if($settings['ADD1']) {echo '<th align="center" width="60px">SGST %</th>';$colCount++;}
							if($settings['VALUE1']) {echo '<th align="center" width="60px">SGST</th>';$colCount++;}
							if($settings['ADD2']) {echo '<th align="center" width="60px">CGST %</th>';$colCount++;}
							if($settings['VALUE2']) {echo '<th align="center" width="60px">CGST</th>';$colCount++;}
							if($settings['EDperUnit']) {	echo '<th align="center" width="60px">IGST %</th>';$colCount++;}
							if($settings['TotalED']) {echo '<th align="center" width="60px">IGST</th>';$colCount++;}
							if($settings['DiscountPer']) {echo '<th align="center">DIS %</th>';$colCount++;}
							if($settings['VALUE3']) {echo '<th align="center">DIS.</th>';$colCount++;}
							
							if($settings['AMT']) {echo '<th align="center" width="90px">AMOUNT</th>';$colCount++;}
							
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
								
								<td align='center'><?= $SlNo?></td>
								<?php if(!empty($plant_id)){
									$from_date ='';
									$to_date ='';
									if($item['from_date']!=''){
										$from_date ='Periods '.date('d.m.Y',strtotime($item['from_date']));
									}
									if($item['to_date']!=''){
										$to_date = ' To '.date('d.m.Y',strtotime($item['to_date']));
									}
									?>
								<td align='center' width="150px"><?=$item['flag']=="R"?$item['return_type']."-":'';?><?=$item['ItemName'] .'<br/> '.$from_date.$to_date ?></td>
								<?php }else{?>
								<td align='center' width="150px"><?=$item['flag']=="R"?$item['return_type']."-":'';?><?=$item['ItemName']?></td>
								<?php
								}
								if($wo_type =='Q'){
								?>
								<td  align='center' width="20px"><?=$item['Qty'];?> </td>
								<?php 
								} ?>
								<td align='center'><?= $item['hsn_code']?></td>
								<?php 
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
							else 
							{
								if(!$retFlag)
								{
								echo'<tr><td colspan="'.$colCount.'"> Returns</td></tr>';
								$retFlag=true;
								}
								?>
							<tr>
								
								<td align='center' width="200px"><?=$item['flag']=="R"?$item['return_type']."-":'';?><?=$item['ItemName'];?></td>
								<td><?php 
									if($wo_type=='Q'){
									?>
									<?=$item['Qty'];?> + <?=$item['FreeQty'];?></td>
									<?php 
									} ?>
								<?php 
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
						 // for($i=14;$i>=$SlNo;$i--)
						 //echo "<tr><td  style='border:1px'>&nbsp;</td></tr>";
						  ?>
						  <tr><td colspan='<?=$colCount+1;?>'>&nbsp; </td></tr>
						  <tr>
						  <!--	<td class="border-top" colspan="<?=$colCount-$Amountcolspan?>" rowspan="7" valign="top">
									
									<br />
									<p><i class="fa fa-inr"></i> Rs.<?=ucwords(convert_number_to_words($NetAmount))?></p>
									<br />
									<br />
								For <font size=4><?= $this->session->userdata('OrgName');?></font>
								<br />
								<br />
								<br />
								<br />
									<p>Partner/Manader</p>
									<br />
									<br />
									
									
							</td>-->
							<td class="text-right border-top" colspan="<?=$colCount?>"><strong>SUB TOTAL</strong></td>
							<td class="text-right border-top"><?=$GrossAmount; ?></td>
						  </tr>
						  <tr>
							
							 <td class="text-right" colspan="<?=$colCount?>"><strong> SGST Tax</strong></td>
							<td class="text-right"><?=$TaxLtSum; ?></td>
						  </tr>
						  <tr>
							<td class="text-right" colspan="<?=$colCount?>"><strong> CGST Tax</strong></td>
							<td class="text-right"><?=$TaxCstSum; ?></td>
						  </tr>
						  <tr>
							<td class="text-right" colspan="<?=$colCount?>"><strong> IGST Tax</strong></td>
							<td class="text-right"><?=$TotalED; ?></td>
						  </tr>
						
						
						  <tr>
							
							
							<td class="text-right" colspan="<?=$colCount?>"><strong>ADJUSTMENT AMOUT</strong></td>
							<td class="text-right"><?=$OtherAdjustment; ?></td>
						  </tr>
						  <tr>
							<td class="text-right" colspan="<?=$colCount?>"><strong>NET PAYABLE</strong></td>
							<td class="text-right"><strong><?=$NetAmount; ?></strong></td>
						  </tr>
						  <tr>
							<td class="text-left" colspan="<?=$colCount+$Amountcolspan?>"><strong>(Rs.<?=ucwords(convert_number_to_words($NetAmount))?>)</strong></td>
						  </tr>
						 <tr>
							<td class="" colspan="<?=$colCount+$Amountcolspan?>" valign="top" style='border:0px;' >
									
									<br><br>
	For <font size=3 style="font-family: serif;"><?= $this->session->userdata('OrgName');?></font>
								<br />
								<br />
								<br />
								<br /><br />
								<br />
									<p>Partner/Manager</p>
									<br />
									<br />
							</td>
						 
						  </tr>
					 </tbody>
				</table>
			</td>
		</tr>
		
		<tr>
			<td style='border-top:0px;'><small>GSTIN: <?= $this->session->userdata('GSTIN');?>, PAN: <?= @$this->session->userdata('PAN');?>,&nbsp;&nbsp; <?php if($this->session->userdata('OrgPhno')=='21646361'){ echo 'MSME NO: UDYAM-MH-33-0486918';}?></small></td>
		</tr>
	</table>
	
	<br />
	<br />
	<br />
	Checked & Certified by User
</body>
<script>
window.print();
</script>
</html>