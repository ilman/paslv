<?php 
	$attr = array( 'class' => 'form-control' );

	$client_id = SG_Util::val($values, 'client_id');
	$client_id = ($client_id) ? $client_id : SG_Util::val($values, 'id');
?>
<div class="form-group">
	<label>Nama Klien</label>
	<?php echo SG_Form::field('text', 'client_name', $values, $attr); ?>
</div>
<div class="form-group">
	<label>Perusahaan</label>
	<?php echo SG_Form::field('text', 'company_name', $values, $attr); ?>
	<?php echo SG_Form::field('hidden', 'company_id', $values); ?>
</div>
<div class="form-group">
	<label>Jabatan</label>
	<?php echo SG_Form::field('text', 'client_title', $values, $attr); ?>
</div>
<div class="form-group">
	<label>Telephone</label>
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
		<?php echo SG_Form::field('text', 'client_phone', $values, $attr); ?>
	</div>

</div>
<div class="form-group">
	<label>Alamat</label>
	<?php 
		$custom_attr = $attr;
		$custom_attr['rows'] = 5;
	?>
	<?php echo SG_Form::field('textarea', 'client_address', $values, $custom_attr); ?>
</div>
<div class="form-group">
	<button type="submit" class="btn btn-default">Submit</button>
</div>
<?php echo SG_Form::field('hidden', 'client_id', $client_id); ?>