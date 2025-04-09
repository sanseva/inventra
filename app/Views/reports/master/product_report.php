<?php $this->session = \Config\Services::session();
$this->common_model = model("Common_model"); ?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<?php echo view('includes/common_css_js');?>
	<meta charset="utf-8" />
	<title>Home | <?php echo TITLE; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
	<meta name="author" content="Zoyothemes"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= base_url();?>assets/images/favicon.ico">
	<link rel="stylesheet" href="<?=base_url();?>css/report.css">
	<!-- App css -->
	<link href="<?= base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

	<!-- Icons -->
	<link href="<?= base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
	<?php echo view('includes/report_header');?>
	<?php
	$session = \Config\Services::session();
	?>
	<table>
		<thead>
			<tr>
				<th title="1">SL.NO</th>
				<th align="left">HSN</th>
				<th align="left">PRODUCT NAME</th>
				<th align="left">PACKING</th>

				<?php if ($session->get('packageType') == "R"): ?>
					<th align="center">FACTOR</th>
				<?php endif; ?>

				<th align="right">SGST</th>
				<th align="right">CGST</th>
				<th align="right">IGST</th>
				<th align="center">SCHEME</th>
				<th align="center">ALERT QTY</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$I = 0;
			foreach ($products as $item): 
				$I++;
				?>
				<tr>
					<td><?= $I ?></td>
					<td><?= htmlspecialchars($item['hsn_code']) ?></td>
					<td><?= htmlspecialchars($item['ItemName']) ?></td>
					<td align="center"><?= htmlspecialchars($item['Packing']) ?></td>

					<?php if ($session->get('packageType') == "R"): ?>
						<td align="center"><?= htmlspecialchars($item['Factor']) ?></td>
					<?php endif; ?>

					<td align="right"><?= htmlspecialchars($item['SGST']) ?></td>
					<td align="right"><?= htmlspecialchars($item['CGST']) ?></td>
					<td align="right"><?= htmlspecialchars($item['IGST']) ?></td>
					<td align="center"><?= htmlspecialchars($item['QTY']) ?>:<?= htmlspecialchars($item['FREE']) ?></td>
					<td align="center"><?= htmlspecialchars($item['Alert']) ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</body>
</html>
