<div class="row">
	<div class="col-sm-12 animated bounceInDown">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><?= ucwords($global->headline)?></h3>
				<button type="button" onclick="loaddata()" class="btn btn-xs pull-right btn-danger btn-flat"><i class="fa fa-arrow-left"></i> Kembali</button>
			</div>
			<div class="box-body">
				<form id="formadd" method="POST" action="javascript:void(0)" url="<?= base_url($global->url)?>"  enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Tanggal</label>
								<input type="text" readonly name="user_terdaftar" class="form-control" value="<?= date('d-m-Y')?>">
							</div>							
							<div class="form-group">
								<label>Nama</label>
								<input required type="text" name="user_nama" class="form-control" title="Harus di isi">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input required name="user_username" class="form-control" type="text"></input>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input required id="password" name="user_password" class="form-control" type="password"></input>
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<input required class="form-control" type="password" equalto="#password"></input>
							</div>														
							<div>
								<label>Level</label>
				                  <div class="radio">
				                    <label style="padding-right: 20px">
				                      <input required name="user_level" value="1" type="radio" >
				                      Admin
				                    </label>
				                    <label>
				                      <input disabled required name="user_level" value="0" type="radio">
				                      User
				                    </label>				                    
				                  </div>								
							</div>																		 
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">						
							<div class="form-group">
								<button type="submit" value="submit" name="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
							</div>														
						</div>
					</div>
				</form>		
			</div>
		</div>		
	</div>	
</div>
<?php include 'action.php';?>
<script type="text/javascript">
	//CKEDITOR.replace('editor1');
</script>
