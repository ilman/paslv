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
		Daftar Kwitansi
	</div>
	<!-- panel heading -->

	<div class="navbar nav-toolbar">
		<div class="navbar-form">
			<div class="navbar-left">
				<a class="btn btn-primary" href="<?php echo url('kwitansi/add') ?>">Buat Kwitansi Baru</a>
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
					<th>No. Kwitansi</th>
					<th>Client</th>
					<th>Jumlah</th>
					<th>Tanggal</th>
					<th class="td-action">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0+($result->from-1); foreach($result->data as $row): ?>
					<?php 
						$kwitansi_id = SG_Util::val($row, 'id');
					?>
					<tr>
						<td class="td-no"><?php echo $i+1 ?></td>
						<td><?php echo SG_Util::val($row, 'kwitansi_number') ?></td>
						<td><?php echo SG_Util::val($row, 'client_name') ?></td>
						<td><?php echo SG_Util::val($row, 'kwitansi_amount') ?></td>
						<td><?php echo SG_Util::val($row, 'created_at') ?></td>
						<td class="td-action">
							<a href="<?php echo url('kwitansi/edit/'.$kwitansi_id) ?>">
								<i class="fa fa-pencil"></i> Ubah
							</a>
							<a href="<?php echo url('kwitansi/delete/'.$kwitansi_id) ?>">
								<i class="fa fa-remove"></i> Hapus
							</a>
							<a href="<?php echo url('kwitansi/print/'.$kwitansi_id) ?>">
								<i class="fa fa-print"></i> Cetak
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