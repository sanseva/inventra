<html>
<head>
<title><?=$invoice_no;?></title>
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
<tr><td><font size=6><?= $this->session->userdata('OrgName');?></font></td></tr>
<tr>
	<td>
			<small style="font-size:12px;"><?= $this->session->userdata('OrgAddress');?>,<?= $this->session->userdata('OrgPhno');?>
			 <?= $this->session->userdata('Mobile')!=""?$this->session->userdata('Mobile'):'';?>
			 <?= $this->session->userdata('Email')!=""?$this->session->userdata('Email'):'';?></small>
			 <br />
			 <br />
			 <table width="100%" class="no_bordered_table">
			 <tr>
			 	<td>
			 	<font size=3>W/O Number :<?= $this->session->userdata('wo_number');?></font></br></br>
				<font size=4>INVOICE NO : <?= $invoice_no ;?></font>
				</td>
			
			 	<td align="right">
			 	<font size=4>Dated: <?=$billDate;?></font>
				</td>
			</tr>
				
			</table>
			 <br />
			 To,<br />
			 <?=$RetName;?>,<br />
			 <?=$RetAdderss;?>,<br />
			 STATE CODE:<?=str_pad($state_id,2,'0',STR_PAD_LEFT);?>,<br />
			 GSTIN: <?=$rgstin;?>,
				
				<br />
				<br />
				<table class="bordered_table" cellpadding='7' style="font-size:14px;border-left:0px !important;width: 730px;margin-left:4px;">
			     	<thead>
			         	<tr>
			              
			             
			             <th>Description</th>
			             <th>Value</th>
			             <th>Rate</th>
			             <th>Amount</th>
			              
			              </tr>
			         </thead>
			         <tbody>
			         <?php 
			         $SlNo=0;
			      
			            foreach($products as $item){
			            	
			            	$SlNo=$SlNo+1;
			            	
			            	
			              	?>
							<?php $des=str_replace("\r\n", "<br>",$item['ItemName']);?>
			              	<tr>
			              		
			              		<td align='left'><?php echo $des;?></td>
			              		<td align='left'><?=$item['MRP']?></td>
			              		<td align='left'><?=$item['discounted_bill_percent']?></td>
			              		<td align='left'><?=$item['Rate']?></td>
			              		
			              		
			              		
			            	 </tr>
			            	 
			              	<?php 
			            	}
			                ?>
						
			              <tr>
			             
			              	<td class="text-right border-top" colspan="3"><strong>SUB TOTAL</strong></td>
			              	<td class="text-right border-top"><?=$GrossAmount; ?></td>
			              </tr>
			              <tr>
			              	
			              	 <td class="text-right" colspan="3"><strong> SGST Tax</strong></td>
			              	<td class="text-right"><?=$TaxLtSum; ?></td>
			              </tr>
			              <tr>
			              	<td class="text-right" colspan="3"><strong> CGST Tax</strong></td>
			              	<td class="text-right"><?=$TaxCstSum; ?></td>
			              </tr>
			              <tr>
			              	<td class="text-right" colspan="3"><strong> IGST Tax</strong></td>
			              	<td class="text-right"><?=$TotalED; ?></td>
			              </tr>
			            
			            
			              <tr>
			              	
			              	
			              	<td class="text-right" colspan="3"><strong>ADJUSTMENT AMOUT</strong></td>
			              	<td class="text-right"><?=$OtherAdjustment; ?></td>
			              </tr>
			              <tr>
			              	<td class="text-right" colspan="3"><strong>NET PAYABLE</strong></td>
			              	<td class="text-right"><strong><?=$NetAmount; ?></strong></td>
			              </tr>
			             <tr>
			             <td class="" colspan="4" valign="top" style='border:0px;' >
			              			
			              			<br />
			              			<i class="fa fa-inr"></i> (Rs.<?=ucwords(convert_number_to_words($NetAmount))?>)
			              		
			              			<br/>
									<br/>
			              			<br><br>
	For <font size=4><?= $this->session->userdata('OrgName');?></font>
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
	
	<tr><td style='border-top:0px;'><small>GSTIN: <?= $this->session->userdata('GSTIN');?>, PAN: <?= @$this->session->userdata('PAN');?></small>
	
	
	</td></tr>
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