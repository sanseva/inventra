<?php
//$company_logo=$this->session->get("company_logo");

$this->session = \Config\Services::session();
$org = $this->session->get('OrgName');
$logo = strtolower(preg_replace('/[.]/', '', $org));
$final_logo = preg_replace('/\s+/','',$logo);
$company_logo = base_url()."images/".$final_logo.".png";


?>

<html>
	<head>
		<title><?=$_SERVER["HTTP_HOST"]?></title>
	</head>
	<style type="text/css">
		 th {
            background-color: #f0f0f0;
            font-weight: bold;
        }th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #cfcfcf;
            font-size: 14px;
        } table {
           
            border-collapse: collapse;
        }
	</style>
	<body>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border:solid 1px #cfcfcf">
			<tbody>
				<tr style="background-color: #ebebeb;">
					<td>
					<?php if(file_exists($company_logo)){ ?>
					<img src="<?php echo $company_logo;?>" alt="<?=$_SERVER["HTTP_HOST"]?>" style="padding: 10px;height:100px"/><?php
					}else{
						//echo $company_logo;
						echo $org;
					}?>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border:solid 1px #cfcfcf">
<tr>
<td><div class="container">
    <div class="header">Daily Activity Summary for Billing Portal </div>
    <div class="content">
        <p>Dear Sir,</p>
        <p>Hope this message finds you well.</p>
        <p>Please find below the summary of activities performed by all users on the billing portal for [Date]:</p>
    </div>
    <div class="table-container">
        <table>
            <tr>
                <th>Sr.no</th>
                <th>Organization</th>
                <th>User Name</th>
                <th>User Role</th>
                <th>Login Time</th>
                <th>Logout Time</th>
                <th>Total Time Spent</th>
                <th>Activities Performed</th>
            </tr>
        </table>
    </div>

    <div class="footer">
        Thank you.
    </div>
</div></td>
</tr>
</table>
<html>
<body>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border:solid 1px #cfcfcf">
			<tbody>
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ebebeb" style="border-top: 0px solid black;">
							<tbody>
								<tr>
									<td width="23">&nbsp;</td>
									<td width="754" valign="top" align="left">
										<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
											<tbody>
												<tr>
													<td width="754" valign="top" align="left" style="font-family: Arial,Helvetica,sans-serif; font-size: 11px; color: rgb(67, 67, 67); vertical-align: middle;">
														<?=date("Y")?> &copy; A One Salasar. All rights reserved.
													</td>
													<td width="20%" valign="bottom" align="right">
														<a target="_blank" href="">
														<?php if(file_exists($company_logo)){?>
														<img border="0" style="display: block; width: 100px;padding:10px;" 
														src="<?php
														
															echo $company_logo;
														
														?>">
														<?php 
														}else{
															echo $org;
														}
														
														?>
														</a>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
									<td width="23">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
</table>
<body>
</html>