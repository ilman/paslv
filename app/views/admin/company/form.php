<?php 
	$attr = array( 'class' => 'form-control' );

	$company_id = SG_Util::val($values, 'company_id');
	$company_id = ($company_id) ? $company_id : SG_Util::val($values, 'id');
?>
<div class="form-group">
	<label>Nama Perusahaan</label>
	<?php echo SG_Form::field('text', 'company_name', $values, $attr); ?>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label>Telephone</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
				<?php echo SG_Form::field('text', 'company_phone', $values, $attr); ?>
			</div>
		</div>
	</div>
	<!-- col -->
	<div class="col-sm-6">
		<div class="form-group">
			<label>Fax</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
				<?php echo SG_Form::field('text', 'company_fax', $values, $attr); ?>
			</div>
		</div>
	</div>
	<!-- col -->
</div>
<!-- row -->

<div class="form-group">
	<label>Alamat</label>
	<?php 
		$custom_attr = $attr;
		$custom_attr['rows'] = 5;
	?>
	<?php echo SG_Form::field('textarea', 'company_address', $values, $custom_attr); ?>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-default">Submit</button>
</div>
<?php echo SG_Form::field('hidden', 'company_id', $company_id); ?>