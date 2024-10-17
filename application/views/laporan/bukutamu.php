<!DOCTYPE html>
<html>

<head>
	<title><?= ucwords('Laporan Presensi ' . $kegiatan->kegiatan_nama) ?></title>
</head>
<style type="text/css">
	.withborder,
	table {
		border-collapse: collapse;
	}

	.withborder td,
	th {
		border: 1px solid black;
		padding: 8px;
	}

	.header {
		padding-bottom: 30px;
	}
</style>

<body>
	<table width="100%" class="noborder">
		<tr>
			<td colspan="2" align="center" class="header">
				<h2><?= ucwords('Laporan Presensi ' . $kegiatan->kegiatan_nama) ?></h2>
			</td>
		</tr>
		<tr>
			<td width="70%">
				<table width="100%" class="noborder">
					<tr>
						<td width="20%" align="left"><b>Kegiatan</b></td>
						<td width="30%" align="left">: <?= ucwords($kegiatan->kegiatan_nama) ?></td>
					</tr>
					<tr>
						<td width="20%" align="left"><b>Tanggal Kegiatan</b></td>
						<td width="30%" align="left">: <?= date('d-m-Y', strtotime($kegiatan->kegiatan_date)) ?></td>
					</tr>
					<tr>
						<td width="20%" align="left"><b>Keterangan</b></td>
						<td width="30%" align="left">: <?= ucwords($kegiatan->kegiatan_keterangan) ?></td>
					</tr>
				</table>
			</td>
			<td rowspan="2" width="30%" align="right"><img src="<?= $qrcode ?>" style="width:90px;height:90px"></td>
		</tr>
	</table>
	<div style="height:50px"></div>
	<h4>Daftar Hadir</h4>
	<table width="100%" class="withborder">
		<tr>
			<th width="5%">No</th>
			<th width="10%">Tanggal</th>
			<th width="15%">Nama</th>
			<th width="10%">Jenis Kelamin</th>
			<th width="15%">Email</th>
			<th width="10%">No Hp</th>
			<th width="15%">Alamat Rumah</th>
			<th width="15%">Instansi</th>
		</tr>
		<?php $i = 1;
		foreach ($data as $row): ?>
			<tr>
				<td><?= $i ?></td>
				<td><?= date('d-m-Y', strtotime($row->bukutamu_date)) ?></td>
				<td><?= ucwords($row->bukutamu_nama) ?><br>
				<td><?= $row->bukutamu_jeniskelamin ?></td>
				<td><?= $row->bukutamu_email ?></td>
				<td><?= $row->bukutamu_notlp ?></td>
				<td><?= ucwords($row->bukutamu_alamat) ?></td>
				<td><?= $row->bukutamu_instansi ?></td>
			</tr>
		<?php $i++;
		endforeach; ?>
	</table>
</body>

</html>