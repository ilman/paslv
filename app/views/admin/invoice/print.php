<style>
	body{ padding:0; margin:0; }	
</style>

<link rel="stylesheet" href="<?php echo url('assets/css/screen-invoice.css') ?>" />
<link rel="stylesheet" href="<?php echo url('assets/css/print-global.css') ?>" />
<link rel="stylesheet" href="<?php echo url('assets/css/print-invoice.css') ?>" />

<?php // include('test-values.php') ?>

<div class="print-page">
	<div class="navbar nav-toolbar">
		<div class="navbar-form">
			<a class="btn btn-default">
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
				<th colspan="2">&nbsp;</th>
				<th width="33%">
					<h2 class="hidden-print">Invoice</h2>
					<div class="box box-sm">
						<span class="key">No.</span>
						<span class="val">
							<?php 
								$invoice_number = SG_Util::val($values, 'invoice_number');
								echo ($invoice_number) ? $invoice_number : '-';
							?>
						</span>
					</div>
					<div class="box box-sm">
						<span class="key">Tgl.</span>
						<span class="val">
							<?php 
								$invoice_date = strtotime(SG_Util::val($values, 'created_at'));
								echo ($invoice_date) ? date('j F Y', $invoice_date) : date('j F Y');
							?>
						</span>
					</div>
				</th>
			</tr>
		</table>
	</div>

	<div id="print-page-content">
		<table class="table-full">
			<tr>
				<td>
					<div class="box">
						<span class="key key-fix">Terima dari: </span>
						<span class="val">
							<?php 
								$client_name = SG_Util::val($values, 'client_name');
								echo ($client_name) ? $client_name : '-';
							?>
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<span class="key key-fix">Terbilang: </span>
					<span class="box shade">
						<?php 
							$invoice_amount_text = SG_Util::val($values, 'invoice_amount_text');
							echo ($invoice_amount_text) ? $invoice_amount_text : '-';
						?>
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<div class="box" id="box-content">
						<h5 class="hidden-print">Untuk Pembayaran:</h5>
						<?php echo SG_Util::val($values, 'invoice_text') ?>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<div id="print-page-footer">
		<table class="table-full">
			<tr>
				<td width="40%">
					<span class="key key-fix">Jumlah: </span>
					<span class="box shade"><?php echo SG_Util::val($values, 'invoice_amount') ?></span>
				</td>
				<td>&nbsp;</td>
				<td width="33%" class="text-center">
					<h5 class="hidden-print">Yang Menerima Pembayaran</h5>
					<div class="ttd">&nbsp;</div>
					<?php echo SG_Util::val($values, 'employee_name') ?>
				</td>
			</tr>
		</table>
	</div>
</div>