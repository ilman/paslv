<style>
	body{ padding:0; margin:0; }	
</style>

<link rel="stylesheet" href="<?php echo url('assets/css/screen-receipt.css') ?>" />
<link rel="stylesheet" href="<?php echo url('assets/css/print-global.css') ?>" />
<link rel="stylesheet" href="<?php echo url('assets/css/print-receipt.css') ?>" />

<?php include('test-values.php') ?>

<?php
	$type = SG_Util::val($values, 'type');
	$client_name = SG_Util::val($values, 'client_name');
	$employee_name = SG_Util::val($values, 'employee_name');

	if($type=='receive'){
		$received_class = 'hidden-print';
		$given_class = 'strike';

		$received_by = $employee_name;
		$given_by = $client_name;
	}
	else{
		$received_class = 'strike';
		$given_class = 'hidden-print';

		$received_by = $client_name;
		$given_by = $employee_name;
	}
?>

<div class="print-page">
	<div class="navbar nav-toolbar">
		<div class="navbar-form">
			<a class="btn btn-default" href="<?php echo url('receipt/edit/') ?>">
				<i class="fa fa-pencil"></i> Ubah
			</a>
			<button type="button" class="btn btn-default" onClick="javascript:window.print()">
				<i class="fa fa-print"></i> Print
			</button>
		</div>
	</div>
	<div id="print-page-header">
		<table class="table-full">
			<tr>
				<th width="33%">&nbsp;</th>
				<th class="text-center"><h2 class="hidden-print">Tanda Terima</h2></th>
				<th width="33%">
					<div class="box box-sm">
						<span class="key">No.</span>
						<span class="val">
							<?php 
								$receipt_number = SG_Util::val($values, 'receipt_number');
								echo ($receipt_number) ? $receipt_number : '-';
							?>
						</span>
					</div>
					<div class="box box-sm">
						<span class="key">Tgl.</span>
						<span class="val">
							<?php 
								$invoice_date = strtotime(SG_Util::val($values, 'created_at'));
								$invoice_date = ($invoice_date) ? date('j F Y', $invoice_date) : date('j F Y');
								echo $invoice_date;
							?>
						</span>
					</div>
				</th>
			</tr>
		</table>
	</div>

	<div id="print-page-content">
		<div id="print-page-content-top">
			<table class="table-full">
				
				<tr>
					<td>
						<div class="box box-sm box-row">
							<span class="hidden-print disp-inline text-1">Sudah</span> 
							<span class="<?php echo $received_class ?> received-class disp-inline">
								diterima dari
							</span>
							<span class="hidden-print disp-inline text-2"> / </span>
							<span class="<?php echo $given_class ?> given-class disp-inline">
								diberikan pada
							</span>
						</div>
						<div class="box box-sm">
							<span class="key key-fix">Nama / Name</span>
							<span class="val">
								<?php 
									echo ($client_name) ? $client_name : '-';
								?>
							</span>
						</div>
						<div class="box box-sm">
							<span class="key key-fix">Alamat / Address</span>
							<span class="val">
								<?php 
									$client_address = SG_Util::val($values, 'client_address');
									echo ($client_address) ? $client_address : '-';
								?>
							</span>
						</div>
					</td>
				</tr>
			</table>
		</div>
		
		<div id="print-page-content-main">
			<table class="table-full">
				<thead>
					<tr>
						<th class="print-td-no"><span class="hidden-print">No.</span></th>
						<th class="print-td-desc"><span class="hidden-print">Uraian / Description</span></th>
						<th class="print-td-note"><span class="hidden-print">Catatan / Note</span></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$contents = json_decode(SG_Util::val($values, 'content_json'));
					?>
					<?php $i=1; foreach($contents as $content): ?>
						<tr>
							<td>1</td>
							<td><?php echo SG_Util::val($content, 'desc') ?></td>
							<td><?php echo SG_Util::val($content, 'note') ?></td>
						</tr>
					<?php $i++; endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

	<div id="print-page-footer">
		<table class="table-full">
			<tr>
				<td width="33%" style="padding-right:10px;">
					<div class="box text-center">
						<h5 class="hidden-print">Yang Menyerahkan</h5>
						<div class="ttd"></div>
						<?php echo $given_by ?>
					</div>
				</td>
				<td style="padding-left:10px; padding-right:10px;">
					<div class="box text-center">
						<h5 class="hidden-print">Tanggal Penyerahan</h5>
						<div class="ttd"></div>
						<?php echo $invoice_date ?>
					</div>
				</td>
				<td width="33%" style="padding-left:10px;">
					<div class="box text-center">
						<h5 class="hidden-print">Yang Menerima</h5>
						<div class="ttd"></div>
						<?php echo $received_by ?>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>