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
			<a class="btn btn-default" href="<?php echo url('invoice/edit/'.$invoice_id) ?>">
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
								echo ($client_name) ? ucwords($client_name) : '-';
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
						



						<table class="table" id="invoice-desc" style="table-layout: fixed;">
							<tbody>
								<?php 
									$invoice_text = SG_Util::val($values, 'invoice_text');
									$rows = json_decode($invoice_text);
									$table_total = 0;
								?>

								<?php if(is_array($rows)): ?>
									<?php $i=0; foreach($rows as $row): ?>
										<?php 
											$row_total = (isset($row->price) && isset($row->qty)) ? $row->price * $row->qty : '';
											$table_total = ($row_total) ? $table_total + $row_total : $table_total + 0;
										?>
										<tr>
											<td width="50"><?php echo $i + 1 ?></td>
											<td><?php echo $row->product ?></td>
											<td width="150" style="text-align:right"><?php echo 'Rp ' . $row->price ?> <?php echo ($row->qty) ? ' x ' . $row->qty : '' ?></td>
											<td width="150" style="text-align:right"><?php echo 'Rp ' . $row_total ?></td>
										</tr>
									<?php $i++; endforeach; ?>
								<?php endif; ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3">&nbsp;</td>
									<td style="text-align:right">
										<span>Total: </span> <?php echo 'Rp ' . $table_total ?></td>
								</tr>
							</tfoot>
						</table>





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
					<?php echo ucwords(SG_Util::val($values, 'employee_name')) ?>
				</td>
			</tr>
		</table>
	</div>
</div>