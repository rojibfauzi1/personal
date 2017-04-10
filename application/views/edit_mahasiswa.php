<!DOCTYPE html>
<html>
<head>
	<title>Edit Mahasiswa</title>
</head>
<body>
<h2>Edit Mahasiswa</h2>
<?=$this->session->flashdata('pesan')?>
<form action="<?php echo base_url()."index.php/welcome/update" ?>" method="post" enctype="multipart/form-data">
<table>
	<tr>
		<td>NIM</td>
		<td><input type="text" name="nim" value="<?php echo $nim ?>"></td>
		<input type="hidden" name="foto" value="<?php echo $foto ?>">
	</tr>
	<tr>
		<td>Nama</td>
		<td><input type="text" name="nama" value="<?php echo $nama ?>"></td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td><input type="text" name="kelas" value="<?php echo $kelas ?>"></td>
	</tr>
	<tr>
	<tr>
		<td>Foto</td>
		<td><img src="<?= base_url() ?>/gambar/mahasiswa/<?php echo $foto ?>" height="50" width="50"></td>
	</tr>
	<tr>
		<td>Upload</td>
		<td><input type="file" name="filefoto"></td>
	</tr>
		<td>Alamat</td>
		<td><textarea name="alamat"><?php echo $alamat ?></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="kirim" value="Update"></td>
	</tr>
</table>
</form>
</body>
</html>