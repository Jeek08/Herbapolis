<!DOCTYPE html>
<html lang="es">

    <title>HERBAPOLIS</title>
    <link rel="stylesheet" href="ventana.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <div class="titulo">
       
        <div class="titulo_header">

            <p>INVENTARIO DE HERBAPOLIS</p>
          
            <div>
                
                <button class="Nuevo" id="btn-abrir-modal">Agregar Nuevo</button>
                <a href="Login.html">
                 <button class="Back" id="btn-back">
                    <ion-icon name="arrow-undo-outline"></ion-icon>
                  </button>
                </a>
            </div>

        </div>
    </div>  

<form  class= "form_d"action="#"  name="ejemplo" method="post">
           
            <dialog opern class="modal" id="modal">
                <input type="text" name="Producto" id="Producto" required placeholder="Ingresar el nombre del producto">
               
                <input type="number" name="Cantidad" id="Cantidad" required placeholder="Ingresar las unidades del producto">
                
                <input type="text" name="Marca" id="Marca" required placeholder="Ingresar la marca del producto">

                <input type="email" name="Proveedor" id="Proveedor" requiered placeholder="Ingresar el proveedor del producto">

                <button class="cerrar" id="btn-cerrar-modal">X</button>
                <button class="enviar" id="btn-enviar-modal" name="registro">Agregar Producto</button>
            </dialog>
      
       <script>

      const btnAbrirModal = document.querySelector("#btn-abrir-modal");
      const btnCerrarModal = document.querySelector("#btn-cerrar-modal");
      const modal = document.querySelector("#modal");

      btnAbrirModal.addEventListener("click",()=>{modal.showModal();})

      btnCerrarModal.addEventListener("click",()=>{modal.close()})

      const btnEnviarModal = document.getElementById('btn-enviar-modal');
	  const tablaProductos = document.getElementById('tabla-productos');
	  const inputs = document.querySelectorAll('#modal input');

	  btnEnviarModal.addEventListener('click', () => {
  	  const valoresInputs = Array.from(inputs).map(input => input.value);

  	  if (valoresInputs.every(valor => valor.trim() !== '')) {
    	  const fila = document.createElement('tr');

    	  valoresInputs.forEach(valor => {
      	  const celda = document.createElement('td');
      	  celda.textContent = valor;
     	   fila.appendChild(celda);
    	  });

    	  tablaProductos.querySelector('tbody').appendChild(fila);

    	  
    	  inputs.forEach(input => (input.value = ''));

    	  
    	  const modal = document.getElementById('modal');
    	  modal.close();
  	  }
	  });


        </script>           
         
</form>


</html>
<?php
    $conex = mysqli_connect("localhost","root","admin","amen");

    if (isset ($_POST ['registro'])) {

    

        $producto = ($_POST ['Producto']); 
        $cantidad = ($_POST ['Cantidad']);
        $marca = ($_POST ['Marca']);
        $proveedor = ($_POST ['Proveedor']);
        $consulta = "INSERT INTO productos (Producto, Cantidad, Marca, Proveedor) VALUES ('$producto','$cantidad','$marca','$proveedor')" ;
        $resultado = mysqli_query ($conex,$consulta);

        if($resultado) {
            ?>
            <script> 
                alert ("Registro realizado con exito");
            </script>  
            <?php
            	} 
	
            }  
            ?>  

            <br>

     <div class="tabla_section">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Marca</th>
        <th>Proveedor</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $consulta = "SELECT * FROM productos";
      $resultado = mysqli_query($conex, $consulta);

      while ($mostrar = mysqli_fetch_array($resultado)) { ?>
        <tr>
          <td><?php echo $mostrar['ID'] ?></td>
          <td><?php echo $mostrar['Producto'] ?></td>
          <td><?php echo $mostrar['Cantidad'] ?></td>
          <td><?php echo $mostrar['Marca'] ?></td>
          <td><?php echo $mostrar['Proveedor'] ?></td>
          <td class="editar-eliminar">
             <?php echo "<a href='editar.php?ID=" . $mostrar['ID'] . "' class='editar-link'>EDITAR</a>"; ?>
             <?php echo "<a href='eliminar.php?ID=" . $mostrar['ID'] . "' class='eliminar-link'>ELIMINAR</a>"; ?>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
	
<?php
?>