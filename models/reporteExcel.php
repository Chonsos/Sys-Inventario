<?php

header("Content-Type: application/xls"); // Declaramos el tipo de archivo
header("Content-Disposition: attachment; filename= Reporte de Productos.xls"); // Nombramos el archivo junto con su extension

$archivoImagen = "C:\Users\XPC\OneDrive\Escritorio\LOGOTIPO.png";
?>

<!-- <div class="container-fluid page-body-wrapper">
	<div class="main-panel forma">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-lg-10 grid-margin stretch-card">
					<div class="card"> -->
<!-- <form> -->
<!-- <div class="card-body"> -->
<style>
	.tabla {
		border-style: solid;
	}

	.titulos {
		color: black;
		font-weight: bold;
		font-size: 25px;
	}
</style>

<img src=<?php echo ' ' . $archivoImagen . ' '; ?>>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table style="border-style: solid; font-size: 25px;">
	<h1>REPORTE DE PRODUCTOS</h1>
	<thead>
		<tr>
			<th style="border-style: solid;" class="titulos">Codigo del producto</th>
			<th style="border-style: solid;" class="titulos">Nombre</th>
			<th style="border-style: solid;" class="titulos">Descripcion</th>
			<th style="border-style: solid;" class="titulos">Stock</th>
			<th style="border-style: solid;" class="titulos">Precio</th>
		</tr>
	</thead>


	<?php
	include("./conexion.php");
	include('./crud.php');
	// $conexion = mysqli_connect("localhost","root","","dbcleanexpert");
	$respuesta = Datos::mostrarProductosModel("inventario");
	// $sql = "SELECT * FROM inventario";
	// $ejecutar=mysqli_query($conexion, $sql);
	foreach ($respuesta as $key => $value) {
		echo '
	<tbody>
	 <tr>
		 <td style="border-style: solid;" class="titulos">' . $value["codigoProducto"]  . '</td>
		 <td style="border-style: solid;" class="titulos">' . $value["nombreProducto"] . '</td>
		 <td style="border-style: solid;" class="titulos">' . $value["descripcion"] . '</td>
		 <td style="border-style: solid;" class="titulos">' . $value["stock"] . '</td>
		<td style="border-style: solid;" class="titulos">' . $value["precio"] . '</td>
	</tr>
 ';
	}