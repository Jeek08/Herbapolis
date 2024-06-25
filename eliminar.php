<?php
$conex = mysqli_connect("localhost","root","","amen");
$id=$_GET['ID'];
$sql="delete from productos where ID='".$id."'";
$resultado=mysqli_query($conex,$sql);

if($resultado){
	echo "<script lenguaje='JavaScript'>
			alert ('Los datos se eliminaron correctamente');
			window.location.href='Untitled-1.php';
			</script>";
}else {
	echo "<script lenguaje='JavaScript'>
			alert ('Los datos NO se eliminaroncorrectamente');
			window.location.href='Untitled-1.php';
			</script>";

}
?>