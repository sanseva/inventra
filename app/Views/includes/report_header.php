<?php $this->session = \Config\Services::session(); ?>
<table class="table">
	 	<tr>
	 		<td colspan="2" class="text-right">
		 		<table class="table">
		 			<tr>
		 				<td width="33%"></td>
		 				<td width="33%" align="center"><?=$title;?></td>
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