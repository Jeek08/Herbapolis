<?php
include ("Untitled2.php");
$conex = mysqli_connect("localhost","root","","amen");
$cantidad = $_POST['Cantidad'];
$productoId = $_POST['ID'];





$consulta = "SELECT Cantidad FROM productos WHERE id = $productoId";
$resultado = $conexion->query($consulta);


if ($resultado->num_rows == 1) {
    $row = $resultado->fetch_assoc();
    $cantidadDisponible = $row['Cantidad'];

    
    if ($cantidadDisponible >= $cantidad) {
        
        $nuevaCantidad = $cantidadDisponible - $cantidad;
        $actualizacion = "UPDATE productos SET Cantidad = $nuevaCantidad WHERE id = $productoId";

        if ($conexion->query($actualizacion) === TRUE) {
            echo "Compra realizada con éxito.";
        } else {
            echo "Error al actualizar la cantidad: " . $conexion->error;
        }
    } else {
        echo "No hay suficiente cantidad disponible para la compra.";
    }
} else {
    echo "Producto no encontrado.";
}


$conexion->close();
?>
