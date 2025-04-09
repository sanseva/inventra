<?php $this->session = \Config\Services::session(); ?>
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
/* Watermark styles */
/*.watermark {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: -1;
  opacity: 100; 
}*/
</style>
</head>
<body class="font12">
<!-- <div class="watermark">
  <img src="< ?= //base_url('images/aone_logo_png_transparent.png')? >" alt="Watermark Image">
</div> -->
<table>
	<tr>
			<td> 
				<table width="100%" class="">
	<!-- <tr>
		<td width="60%">
			<img src='< ?=base_url('images/acc.jpg')?>' style='width:150px;'>							
		</td>
		<td align="right">
			<table>
				<tr align="right">
					<td>
						<img src='< ?=base_url('images/salasar-logo.png')?>' style='width:70px;float:right'>
					</td>
					<td class="text-left">
						<strong><font style="color:#17478f;font-size:14px;">A One</font> <font style="color:#00aeef;font-size:14px;">Salasar Pvt Ltd</font>,</strong><br>702,Opal Square IT Park,<br>Padwal Nagar,<br>Thane West, Mumbai - 400604<br>Telephone No: +91 22 25660141<br>Email: scs@salasarauction.com<br>
						GSTIN NO : < ?= $this->session->get('DLno');?><br>
						STATE : < ?=state_id_name($this->session->get("state_id"))?>
					<td>
				</tr>
			</table>
		</td>
					</tr> -->
					<tr>
						<td align="center" colspan="2">
							<br /><br />
							<strong>TAX INVOICE</strong><br/>Original For Receipt
						</td>
					</tr>
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
				To,<br />
				<strong><?=$RetName;?>,</strong><br />
				<?=$RetAdderss;?>,<br />
				<strong>STATE CODE : </strong><?=state_id_name($state_id)?><br />
				<?php
				if(!empty($rgstin)){
					echo "<strong>GSTIN : </strong>".$rgstin."<br />";
				}
				if(!empty($place_of_supply)){
					echo "<strong>Place of Supply : </strong>".$place_of_supply."<br />";
				}
				if(!empty($RetConPerson)){
					echo "<strong>Kind Attn : </strong>".$RetConPerson."<br />";
				}
				if(!empty($RetPhoneNo)){
					echo "<strong>Mobile : </strong>".$RetPhoneNo."<br />";
				}
				if(!empty($RetEmail)){
					echo "<strong>Email : </strong>".$RetEmail."<br />";
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
			              	<?php 
								$billDateObj = DateTime::createFromFormat('d/m/Y', $billDate);
								$billDate = $billDateObj->format('Y-m-d');
								$billDateObj->modify('+10 days');
								$billDateAfterTenDays = $billDateObj->format('d-m-Y');
			              	 ?>
			              	<td class="text-right" colspan="<?=$colCount?>"><strong>DUE DATE </strong></td>
			              	<td class="text-right"><strong><?=$billDateAfterTenDays; ?></strong></td>
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
	</table>
	<br/><br/>
	<p>
   <span style="background-color: yellow;"> <strong> Note:<strong> AOSPL is registered under MSME (Reg. No. UDYAM-MH-18-0074597) therefore requested to follow timelines as per agreed terms. For payments later than 45 days may attract interest @22% as per MSME guidelines.</span>
	</p>
	<br/>
	<br/>

	<table  class="bordered_table" border="1" style="width: 20em; text-align: left;">
    <tr>
        <th>Company Name</th>
        <td>A One Salasar Private Limited</td>
    </tr>
    <tr>
        <th>Bank Name</th>
        <td>Kotak Mahindra Bank</td>
    </tr>
    <tr>
        <th>Account Number</th>
        <td>9712031920</td>
    </tr>
    <tr>
        <th>IFSC</th>
        <td>KKBK0000642</td>
    </tr>
    <tr>
        <th>Branch</th>
        <td>Mumbai Mulund West</td>
    </tr>
     <tr>
        <th>GSTIN NO</th>
        <td><?= $this->session->get('DLno');?></td>
    </tr>
    <tr>
        <th>STATE</th>
        <td><?=state_id_name($this->session->get("state_id"))?></td>
    </tr>
     <tr>
        <th>MSME No</th>
        <td>UDYAM-MH-18-0074597</td>
    </tr>
	</table>
	<br />
	<br />
	<!-- <div style="float: left; width: 33%;">
    <strong>< ?= $this->session->get('OrgName');?></strong><br>
    702, Opal Square IT Park.<br>
    Padwal Nagar.<br>
    Thane - 400604<br><br>
    </div>
	<div style="float: left; width: 33%;">
    Tel. : (+91-22) 25660141<br>
    Email ID: info@aonesalasar.com<br>
    Web : <a href="http://www.aonesalasar.com">www.aonesalasar.com</a><br>
    <a href="http://www.salasarauction.com">www.salasarauction.com</a>
	</div>
	<div style="float: left; width: 33%;">
    CIN No : U74999MH2016PTC282870<br>
    GST No : < ?= $this->session->get('DLno');?><br>
    PAN No : AAOCA5506C<br>
    State Code : < ?=state_id_name($this->session->get("state_id"))?>
	</div> -->
</body>
<script>
window.print();
</script>
</html>