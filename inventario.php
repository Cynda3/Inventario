<?php
// Funcion para iniciar la sesion
session_start();
// Crea una variable de sesion para guardar los datos del invnetario
if(isset($_POST["enviar"])){ 
	$_SESSION["inventario"]= array();
	$_SESSION["codigo"]=$_POST["codigo"];
	$_SESSION["descripcion"]=$_POST["descripcion"];
	$_SESSION["cantidad"]=$_POST["cantidad"];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<h1>Inventario de dispositivos hardware</h1>
		<form method="post" action="inventario.php">
			<label>Codigo:</label> 
			<!-- Muestro los datos anteriores en los input en caso de haberlos -->
			<input type="number" name="codigo" ><br><br>
			<label>Descripcion: </label>
			<input type="text" name="descripcion" ><br><br>
			<label>CAntidad: </label>
			<input type="number" name="cantidad" ><br><br>
			<input type="submit" name="enviar" value="Enviar">
		</form>
		<h1>Inventario:</h1>
		<?php

				if($_POST["enviar"]){
					// Recogemos los datos del formulario
					$codigo=strtolower($_POST["codigo"]);
					$descripcion=strtolower($_POST["descripcion"]);
					$cantidad=strtolower($_POST["cantidad"]);
					
					$inventario=$_SESSION["inventario"]; 

					echo($inventario);

					// Compruebo si codigo y descripcion estan vacios
					if($_POST["codigo"]!="" && $_POST["descripcion"]!=""){
						// COmpruebo a ver si esta el nombre en el inventario
						if(!array_key_exists($codigo,$inventario)){
							// Añado los datos al inventario
							$inventario["codigo"]=$codigo;
							$inventario["descripcion"]=$descripcion;
							// Compruebo que han introducido la cantidad
							if ($_POST["cantidad"]!="" && $_POST["cantidad"] < 0) {
								// Muestro los datos del inventario
								foreach ($inventario as $key => $value) { 
									echo "<br>Codigo: ".$value."<br>Descripcion: ".$value."<br>Cantidad: ".$value."<br>";
								}
							}
							else{
								// Muestro los datos del inventario
								foreach ($inventario as $key => $value) { 
									echo "<br>Codigo: ".$key."<br>Descripcion: ".$value."<br>";
								}
							}
						}
						else{
							// Si ya existe, actualizo la descripcion y la cantidad
							if($descripcion!=""){
								if ($cantidad!="") {
									$inventario["descripcion"]=$descripcion;
									$inventario["cantidad"]=$cantidad;
									foreach ($inventario as $key => $value) { 
										echo "<br>Codigo: ".$value."<br>Descripcion: ".$value."<br>Cantidad: ".$value."<br>";
									}
								}
								$inventario["descripcion"]=$descripcion;
								foreach ($inventario as $key => $value) { 
									echo "<br>Codigo: ".$value."<br>Descripcion: ".$value."<br>Cantidad: ".$value."<br>";
								}
							}
							elseif($cantidad!=""){
								if ($cantidad == -1) {
									// Lo elimino del inventario
									unset($inventario[$codigo]); 
									foreach ($inventario as $key => $value) { 
										echo "<br>Codigo: ".$value."<br>Descripcion: ".$value."<br>Cantidad: ".$value."<br>";
									}
								}
								$inventario["cantidad"]=$cantidad;
								foreach ($inventario as $key => $value) { 
									echo "<br>Codigo: ".$value."<br>Descripcion: ".$value."<br>Cantidad: ".$value."<br>";
								}
							}
						}
					}
					else{
						// Los input de codigo y descripcion estan vacios
						echo "Debe introducir el codigo y la descripcion como minimo";
					}	
				}
				$_SESSION["inventario"]=$inventario;
				?>
		?>
</body>
</html>