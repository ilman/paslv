<?php 
	$attr = array(
		'class' => 'form-control',
	);
	$link_params = array(
		'filter' => $filter,
	);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		Daftar Perusahaan
	</div>
	<!-- panel heading -->

	<div class="navbar nav-toolbar">
		<div class="navbar-form">
			<div class="navbar-left">
				<a class="btn btn-primary" href="<?php echo url('company/add') ?>">Tambah Perusahaan</a>
			</div>
			<div class="navbar-right">
				<form action="">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>

	<?php if(isset($result) && $result->total): ?>
		<div class="navbar nav-toolbar">
			<div class="navbar-text">
				<?php echo App_Util::paginationText($result) ?>
			</div>
			<?php echo App_Util::paginationLinks($result, $link_params) ?>
		</div>
		<!-- nav-toolbar -->


		<table class="table table-list table-striped table-hover">
			<thead>
				<tr>
					<th class="td-no">#</th>
					<th>Nama Perusahaan</th>
					<th>Alamat</th>
					<th>Telephone</th>
					<th class="td-action">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0+($result->from-1); foreach($result->data as $row): ?>
					<?php 
						$company_id = SG_Util::val($row, 'id');
					?>
					<tr>
						<td class="td-no"><?php echo $i+1 ?></td>
						<td><?php echo SG_Util::val($row, 'company_name') ?></td>
						<td><?php echo SG_Util::val($row, 'company_address') ?></td>
						<td><?php echo SG_Util::val($row, 'company_phone') ?></td>
						<td class="td-action">
							<a href="<?php echo url('company/edit/'.$company_id) ?>">
								<i class="fa fa-pencil"></i> Ubah
							</a>
							<a href="<?php echo url('company/delete/'.$company_id) ?>">
								<i class="fa fa-remove"></i> Hapus
							</a>
						</td>
					</tr>
				<?php $i++; endforeach; ?>
			</tbody>
		</table>

		<div class="navbar nav-toolbar">
			<?php echo App_Util::paginationLinks($result, $link_params) ?>
		</div>
		<!-- nav-toolbar -->
	<?php else: ?>
		<div class="padding-4x text-center"><?php echo trans('messages.no_data') ?></div>
	<?php endif; ?>
			
</div>
<!-- panel --> 