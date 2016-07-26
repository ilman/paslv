<?php 
	$attr = array( 'class' => 'form-control' );
?>
<div class="row">			
	<div class="col-sm-6">
		<div class="form-group">
			<label>No. Invoice</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-fw">#</i></span>
				<?php 
					$invoice_id = SG_Util::val($values, 'invoice_id');
					$invoice_number = 'INV/PAS/2014/'.$invoice_id;
				?>
				<?php echo SG_Form::field('text', 'invoice_number', $invoice_number, $attr); ?>
			</div>
		</div>			
	</div>
	<!-- col -->
	<div class="col-sm-6">
		<div class="form-group">
			<label>Tanggal</label>
			<div class="input-group">
				<?php echo SG_Form::field('text', 'created_at', $values, array('class' => 'form-control input-date')); ?>
				<span class="input-group-btn">
					<button class="btn btn-default" type="button"><i class="fa fa-fw fa-calendar"></i></button>
				</span>
			</div>
		</div>
	</div>
	<!-- col -->			
</div>
<!-- row -->

<div class="form-group">
	<label>Ditagihkan Kepada</label>
	<?php echo SG_Form::field('text', 'client_name', $values, $attr); ?>
</div>
<div class="form-group">
	<label>Jumlah</label>
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-fw">Rp</i></span>
		<?php 
			$custom_attr = array(
				'class' => 'form-control input-convert-to-text',
				'data-target' => '#invoice-amount-text'
			);
		?>
		<?php echo SG_Form::field('text', 'invoice_amount', $values, $custom_attr); ?>
	</div>

</div>
<div class="form-group">
	<label>Terbilang</label>
	<?php echo SG_Form::field('text', 'invoice_amount_text', $values, $attr); ?>
</div>
<div class="form-group">
	<label>Untuk Pembayaran</label>

	<p>
		<a class="btn btn-primary tr-add" rel="#invoice-desc">Add Product</a>
	</p>
	<table class="table" id="invoice-desc">
		<thead>
			<tr>
				<th width="50">No</th>
				<th width="400">Product</th>
				<th>Price</th>
				<th>Qty</th>
				<th>Total</th>
				<th width="100">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$invoice_text = SG_Util::val($values, 'invoice_text');
				$rows = json_decode($invoice_text);
				$table_total = 0;

				if(!is_array($rows)){
					$rows = array([]);
				}
			?>

			<?php $i=0; foreach($rows as $row): ?>
				<?php 
					$row_total = (isset($row->price) && isset($row->qty)) ? $row->price * $row->qty : '';
					$table_total = ($row_total) ? $table_total + $row_total : $table_total + 0;
				?>
				<tr>
					<td><?php echo $i + 1 ?></td>
					<td><?php echo SG_Form::field('textarea', 'invoice_text['.$i.'][product]', SG_Util::val($row, 'product'), $attr) ?></td>
					<td><?php echo SG_Form::field('text', 'invoice_text['.$i.'][price]', SG_Util::val($row, 'price'), array('class'=>'form-control tr-input-price')) ?></td>
					<td><?php echo SG_Form::field('text', 'invoice_text['.$i.'][qty]', SG_Util::val($row, 'qty'), array('class'=>'form-control tr-input-qty')) ?></td>
					<td><input type="text" class="form-control tr-total" readonly="readonly" value="<?php echo $row_total ?>"></td>
					<td>
						<a class="btn btn-default"><i class="fa fa-arrows"></i></a>
						<a class="btn btn-default tr-delete"><i class="fa fa-remove"></i></a>
					</td>
				</tr>
			<?php $i++; endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3">&nbsp;</th>
				<th>Total</th>
				<th colspan="2"><input type="text" class="form-control table-total" name="total_price" value="<?php echo $table_total ?>" readonly="readonly"></th>
			</tr>
		</tfoot>
	</table>

</div>
<!-- form-group -->

<div class="form-group">

	<!-- <div class="repeatable">
		<div class="row repeat-item">
			<div class="col-sm-9">
				
			</div>
			<div class="col-sm-3">
				<?php echo SG_Form::field('text', 'invoice_text_params[value]', $values, $attr) ?>
				<a class="repeat-delete">x</a>
			</div>		
		</div>
		<p><a class="btn btn-default repeat-add">Tambah Baris Baru</a></p>
	</div> -->

</div>
<!-- form-group -->
<div class="form-group">
	<label>Penerima</label>
	<?php echo SG_Form::field('text', 'employee_name', $values, $attr); ?>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-default">Submit</button>
</div>
<?php echo SG_Form::field('hidden', 'invoice_id', $values); ?>