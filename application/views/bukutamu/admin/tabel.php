<div class="row">
	<div class="col-sm-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Informasi Kegiatan</h3>
			</div>
			<div class="box-body table-responsive">
				<table class="table table-striped" width="100%">
					<tr>
						<th width="20%">Nama Kegiatan</th>
						<td>: <?= ucwords($kegiatan->kegiatan_nama)?></td>
					</tr>
					<tr>
						<th>Keterangan</th>
						<td>: <?= ucwords($kegiatan->kegiatan_keterangan)?></td>
					</tr>
					<tr>
						<th>Tanggal </th>
						<td>: <?= date('d-m-Y',strtotime($kegiatan->kegiatan_date))?></td>
					</tr>	
					<tr>
						<th>Berkas Pendukung</th>
						<td>: <a href="<?= base_url($global->url.'download/'.$kegiatan->kegiatan_file)?>" class="btn btn-flat btn-xs btn-primary" target="_blank">Download</td>
					</tr>				
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-2">
		<div class="form-group">
			<button onclick="isibukutamu(<?= $kegiatan->kegiatan_id?>);" id="add" url="<?= base_url($global->url.'add.html')?>" class="btn btn-flat btn-block btn-primary"><span class="fa fa-plus"></span> Isi Bukutamu</button>
		</div>			
	</div>	
	<div class="col-sm-2">
		<div class="form-group">
			<a href="<?= base_url($global->url.'cetakbukutamu/'.md5($kegiatan->kegiatan_id))?>" class="btn btn-flat btn-block btn-warning" target="_blank"><span class="fa fa-print"></span> Cetak</a>
		</div>			
	</div>		
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="box box-primary  animated bounceInDown">
		        <div class="box-header">
		          <h3 class="box-title">Tabel <?php echo ucwords($global->headline)?></h3>
		        </div>
		        <div class="box-body table-responsive">
		        	<table style="width:100%" id="datatabel" class="table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th width="5%">No</th>
			                  <th width="10%">Tanggal</th>
			                  <th width="15%">Nama</th>
			                  <th width="10%">Jenis Kelamin</th>
			                  <th width="15%">Email</th>
			                  <th width="10%">No Hp</th>
			                  <th width="15%">Alamat Rumah</th>
			                  <th width="15%">Instansi</th>
			                  <th width="15%" class="text-center">Aksi</th>
			                </tr>
		                </thead>
		                <tbody>
		                	<?php $i=1;foreach ($data as $row):?>
			                	<tr>
			                		<td><?=$i?></td>
			                		<td><?=date('d-m-Y',strtotime($row->bukutamu_date))?></td>
			                		<td><?=ucwords($row->bukutamu_nama)?><br>
			                		<td><?=$row->bukutamu_jeniskelamin?></td>
			                		<td><?=$row->bukutamu_email?></td>
			                		<td><?=$row->bukutamu_notlp?></td>
			                		<td><?=ucwords($row->bukutamu_alamat)?></td>
			                		<td><?=$row->bukutamu_instansi?></td>
			                		<td class="text-center">
			                			<?php include 'button.php';?>
			                		</td>
			                	</tr>	                	
		                	<?php $i++;endforeach;?>
		                </tbody>            		
		        	</table>
		        	<p>Keterengan : <br>
		        		<a href="#" class="btn btn-flat btn-xs btn-info" style="width:25px"><span class="fa fa-pencil"></span></a> : Edit<br>
		        		<a href="#" class="btn btn-flat btn-xs btn-danger" style="width:25px"><span class="fa fa-trash"></span></a> : Hapus	
		        	</p>
		        </div>
		</div>		
	</div>
</div>

<?php include 'action.php'; ?>