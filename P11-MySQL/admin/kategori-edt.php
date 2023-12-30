<?php

if(isset($_REQUEST['id']))
{ 

	$id = $_REQUEST['id'];

	$result = mysqli_query($con, "SELECT * FROM kategori WHERE id_kategori=$id");

	while($data = mysqli_fetch_array($result))
	{
		$nama   = $data['nama_kategori'];
		$id 	= $data['id_kategori'];
	}

	?>

	<div class="row justify-content-between">
		<div class="col-10"><b>Edit Kategori </b></div>
	</div>

	<hr>

	<form action="index.php?page=kategori-edt" method="post" enctype="multipart/form-data">

		<table class="table table-sm table-borderless">
			<tr> 
				<td width="10%">Nama Kategori</td>
				<td>
					<input class="form-control form-control-sm" type="text" name="nama" value="<?php echo $nama;?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
				</td>
			</tr>
			<tr> 
				<td></td>
				<td><input class="btn btn-dark btn-sm" type="submit" name="submit" value="submit"></td>
			</tr>
		</table>
	</form> 

<?php } ?>

<?php

if(isset($_POST['submit']))
{   
	$id		= $_POST['id'];
	$nama   = $_POST['nama'];

	$result = mysqli_query($con, "UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori=$id");

	header("Location: index.php?page=kategori");
}
?>