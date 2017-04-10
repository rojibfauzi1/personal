<!DOCTYPE html>
<html>
<head>
	<title>Data Mahasiswa</title>
</head>
<body>
<a href="<?php echo base_url()."index.php/welcome/tambah_data" ?>">Tambah Data</a>
<?=$this->session->flashdata('pesan')?>

<table border="1" class="border-collapse: collapse;">
	<thead>
		<tr style="background-color: grey">
			<th>NIM</th>
			<th>Nama</th>
			<th>Kelas</th>
			<th>Alamat</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
			<?php foreach($data as $mhs){ ?>
		<tr>
			<td><?php echo $mhs['nim'] ?></td>
			<td><?php echo $mhs['nama'] ?></td>
			<td><?php echo $mhs['kelas'] ?></td>
			<td><?php echo $mhs['alamat'] ?></td>
			<td>
				<a href="<?php echo base_url()."index.php/welcome/edit_data/".$mhs['nim'] ?>">Edit</a> ||
				<a href="<?php echo base_url()."index.php/welcome/hapus_data/".$mhs['nim'] ?>">Hapus</a>
			</td>
		</tr>
			<?php } ?>
	</tbody>
</table>
</body>
</html>