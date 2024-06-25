<?php

$conex = mysqli_connect("localhost","root","","amen");

?>

<html>
<head>
	<link rel="stylesheet" href="editar.css">
	<title>EDITAR</title>
</head>
<body>
	<?php
	if (isset($_POST['registro']))
	{
	$id=$_POST['ID'];
	$producto=$_POST['Producto'];
	$cantidad=$_POST ['Cantidad'];
	$marca=$_POST['Marca'];
	$proveedor=$_POST['Proveedor'];

	$sql="update productos set Producto='".$producto."', Cantidad='".$cantidad."', Marca='".$marca."', Proveedor='".$proveedor."'where ID='".$id."'";
	$resultado=mysqli_query($conex,$sql);
		
		if($resultado){
			echo "<script lenguaje='JavaScript'>
			alert ('Los datos se actualizaron correctamente');
			window.location.href='Untitled-1.php';
			</script>";

		}else {
			"<script lenguaje='JavaScript'>
			alert ('Los datos NO se actualizaron correctamente');
			window.location.href='Untitled-1.php';
			</script>";
		}
		mysqli_close($conex);
	}
	else 
	{
		$id=$_GET['ID'];
		$sql="select * from productos where ID='".$id."'";
		$resultado=mysqli_query($conex,$sql);

		$fila =mysqli_fetch_assoc($resultado);
		$producto=$fila["Producto"];
		$cantidad=$fila ["Cantidad"];
		$marca=$fila["Marca"];
		$proveedor=$fila["Proveedor"];

		mysqli_close($conex);

	 ?>
	
		 <section>
    <div class="form-box">
      <div class="form-value">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post"">
          <h2>Editar Producto</h2>
          <div class="inputbox">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <input type "text" name="Producto" value="<?php echo $producto;?>" required placeholder="Ingresar el nombre del producto">
          </div>
          <div class="inputbox">
            <ion-icon name="stats-chart-outline"></ion-icon>
            <input type "number" name="Cantidad" value="<?php echo $cantidad;?>" required placeholder="Ingresar las unidades del producto">
          </div>
          <div class="inputbox">
            <ion-icon name="pricetags-outline"></ion-icon> 
            <input type "text" name="Marca" value="<?php echo $marca;?>" required placeholder="Ingresar la marca del producto">
          </div>
          <div class="inputbox">
            <ion-icon name="at-outline"></ion-icon>
            <input type "text" name="Proveedor" value="<?php echo $proveedor;?>" requiered placeholder="Ingresar el proveedor del producto">
          </div>
                    <input type="hidden" name="ID" value="<?php echo $id;?>">
                    <button name="registro">Guardar</button>
          
        </form>

      </div>
      <a href="Untitled-1.php"> <button class="cerrar" id="btn-cerrar-modal"> <ion-icon name="arrow-undo-outline"> </ion-icon> </button> </a> 
      
    </div>
  </section>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
	<?php 
	}
	?>


</body>
</html>