<!DOCTYPE html>
<html lang="es">
<head>
    <title>HERBAPOLIS</title>
    <link rel="stylesheet" href="ventana2.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="titulo">
    <a href="Login.html"> <button class="cerrar" id="btn-cerrar-modal"> <ion-icon name="arrow-undo-outline"> </ion-icon> </button> </a> 
        <div class="titulo_header">
             <p>VENTAS DE HERBAPOLIS</p> 
           <?php
    if (isset($_POST['venta'])) {
        $cantidad = isset($_POST['Cantidad']) ? $_POST['Cantidad'] : '';
        $productoId = isset($_POST['ID']) ? $_POST['ID'] : '';

        if ($cantidad !== '' && $productoId !== '') {
            $conex = mysqli_connect("localhost", "root", "", "amen");
            if (!$conex) {
                die('Error de conexión: ' . mysqli_connect_error());
            }

            $consulta = "SELECT Cantidad FROM productos WHERE id = $productoId";
            $resultado = mysqli_query($conex, $consulta);

         
            if ($resultado !== false && $resultado->num_rows == 1) {
                $row = $resultado->fetch_assoc();
                $cantidadDisponible = $row['Cantidad'];

                
                if ($cantidadDisponible >= $cantidad) {
                    
                    $nuevaCantidad = $cantidadDisponible - $cantidad;
                    $actualizacion = "UPDATE productos SET Cantidad = $nuevaCantidad WHERE id = $productoId";


                    if (mysqli_query($conex, $actualizacion)) {
                       ?> 
                        <script>
                             alert ("Compra realizada con éxito." ); 
                        </script>
                        <?php

                    } 
                    else {
                        ?> 
                        <script>
                             alert ("Error al actualizar la cantidad: " ); 
                        </script>
                        <?php
                    }
                } else {
                     ?> 
                        <script>
                             alert ("No hay suficiente cantidad disponible para la compra."); 
                        </script>
                        <?php

                }
            } else {
                 ?> 
                        <script>
                             alert ("Producto no encontrado."); 
                        </script>
                        <?php
               
            }

            
            mysqli_close($conex);
        } else {
            echo "Ingrese la cantidad y el ID del producto.";
        }
    }
    ?>
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                
                    <input type="number" class="number" name="Cantidad" placeholder="Cantidad a vender" required >

            <input type="number" name="ID" placeholder="ID del producto" required>
            <input type="submit" name="venta" value="Realizar compra">

                
            

               
             </form>
        
        </div>


    </div>  

    <div class="tabla_section">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Marca</th>
                    <th>Proveedor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conex = mysqli_connect("localhost", "root", "", "amen");
                $consulta = "SELECT * FROM productos";
                $resultado = mysqli_query($conex, $consulta);

                while ($mostrar = mysqli_fetch_array($resultado)) { 
                    ?>
                    <tr>
                        <td><?php echo $mostrar['ID'] ?></td>
                        <td><?php echo $mostrar['Producto'] ?></td>
                        <td><?php echo $mostrar['Cantidad'] ?></td>
                        <td><?php echo $mostrar['Marca'] ?></td>
                        <td><?php echo $mostrar['Proveedor'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>

       
    </div>

    
</body>
</html>