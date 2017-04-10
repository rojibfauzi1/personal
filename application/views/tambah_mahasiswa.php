<!DOCTYPE html>
<html>
<head>
	<title>Tambah Mahasiswa</title>
</head>
<body>
<h2>Tambah Mahasiswa</h2>
  
<?=$this->session->flashdata('pesan')?>
<form action="<?php echo base_url()."index.php/welcome/insert" ?>" method="post" enctype="multipart/form-data">
<table>
	<tr>
		<td>NIM</td>
		<td><input type="text" name="nim"></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input type="text" name="nama"></td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td><input type="text" name="kelas"></td>
	</tr>
	<tr>
		<td>Foto</td>
		<td><input type="file" name="filefoto"></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td><textarea name="alamat"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit"  value="Kirim"></td>
	</tr>
</table>
</form>
</body>
</html>