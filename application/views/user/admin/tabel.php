<div class="row">
	<div class="col-sm-2">
		<div class="form-group">
			<button onclick="add();" id="add" url="<?= base_url($global->url.'add.html')?>" class="btn btn-flat btn-block btn-primary"><span class="fa fa-plus"></span> Tambah</button>
		</div>			
	</div>	
</div>
<div class="row animated bounceInDown">
	<div class="col-sm-12">
		<div class="box box-primary">
		        <div class="box-header">
		          <h3 class="box-title">Tabel <?php echo ucwords($global->headline)?></h3>
		        </div>
		        <div class="box-body table-responsive">
		        	<table style="width:100%" id="datatabel" class="table table-bordered table-striped">
		                <thead>
			                <tr>
			                  <th width="5%">No</th>
			                  <th width="15%">Terdaftar</th>
			                  <th width="30%">Nama</th>
			                  <th width="20%">Username</th>
			                  <th width="20">Password</th>
			                  <th width="10%" class="text-center">Aksi</th>
			                </tr>
		                </thead>
		                <tbody>
		                	<?php $i=1;foreach ($data as $row):?>
			                	<tr>
			                		<td><?=$i?></td>
			                		<td><?=date('d-m-Y',strtotime($row->user_terdaftar))?></td>
			                		<td><?=$row->user_nama?><br>
			                		<td><?=$row->user_username?></td>
			                		<td><?=$row->user_password?></td>
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