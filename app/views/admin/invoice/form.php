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
	<?php 
		$custom_attr = array(
			'class' => 'form-control',
			'rows' => 6,
		);
	?>
	<?php echo SG_Form::field('textarea', 'invoice_text', $values, $custom_attr); ?>
</div>
<div class="form-group">
	<label>Penerima</label>
	<?php echo SG_Form::field('text', 'employee_name', $values, $attr); ?>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-default">Submit</button>
</div>
<?php echo SG_Form::field('hidden', 'invoice_id', $values); ?>