<?php 
	$attr = array( 'class' => 'form-control' );
?>
<div class="row">			
	<div class="col-sm-6">
		<div class="form-group">
			<label>No. Tanda Terima</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-fw">#</i></span>
				<?php 
					$receipt_id = SG_Util::val($values, 'id');
					$receipt_number = 'INV/PAS/2014/'.$receipt_id;
				?>
				<?php echo SG_Form::field('text', 'receipt_number', $receipt_number, $attr); ?>
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
	<div class="radio">
		<?php 
			$options = array(
				array('label'=>'Sudah diterima dari', 'value'=>'receive'),
				array('label'=>'Sudah diberikan pada', 'value'=>'give'),
			);
		?>
		<?php echo SG_Form::field('radio', 'type', $values, array(), '', $options, 'receive'); ?>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label>Pihak PT. PAS</label>
			<?php echo SG_Form::field('text', 'employee_name', $values, $attr); ?>
		</div>
	</div>
	<!-- col -->
	<div class="col-sm-6">
		<div class="form-group">
			<label>Pihak Kedua</label>
			<?php echo SG_Form::field('text', 'client_name', $values, $attr); ?>
		</div>
	</div>
	<!-- col -->
</div>
<!-- row -->

<div class="form-group">
	<label>Alamat</label>
	<?php echo SG_Form::field('text', 'client_address', $values, $attr); ?>
</div>

<fieldset>
	<?php 
		$contents = json_decode(SG_Util::val($values, 'content_json'));
		if(!$contents){
			$contents = array(array('desc'=>'', 'note'=>''));
		}
		$custom_attr = array('class' => 'form-control input-tinymce',	'rows' => 6 );
	?>
	<?php $i=0; foreach($contents as $content): ?>
		<div class="form-group">
			<label>Uraian/Deskripsi</label>
			<?php 
				$content_desc = SG_Util::val($content, 'desc');
				echo SG_Form::field('textarea', "content[$i][desc]", $content_desc, $custom_attr);
			?>
		</div>
		<?php 
			$custom_attr = array('class' => 'form-control',	'rows' => 3 );
		?>
		<div class="form-group">
			<label>Catatan</label>
			<?php 
				$content_note = SG_Util::val($content, 'note');
				echo SG_Form::field('textarea', "content[$i][note]", $content_note, $custom_attr);
			?>
		</div>
	<?php $i++; endforeach; ?>
</fieldset>

<div class="form-group">
	<button type="submit" class="btn btn-default">Submit</button>
</div>
<?php echo SG_Form::field('hidden', 'receipt_id', $receipt_id); ?>