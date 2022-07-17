<?php 
//activamos almacenamiento en el buffer
ob_start();
if (strlen(session_id())<1) 
  session_start();

if (!isset($_SESSION['nombre'])) {
  echo "debe ingresar al sistema correctamente para vosualizar el reporte";
}else{

if ($_SESSION['almacen']==1) {

//incluimos a la clase PDF_MC_Table
require('PDF_MC_Table.php');

//instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();

//agregamos la primera pagina al documento pdf
$pdf->AddPage();

//seteamos el inicio del margen superior en 25 pixeles
$y_axis_initial=25;

//seteamos el tipo de letra y creamos el titulo de la pagina. No se repetira como encabezado
$pdf->SetFont('Arial','B',12);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE ARTICULOS',1,0,'C');
$pdf->Ln(10);

//creamos las celdas para los titulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,6,'Nombre',1,0,'C',1);
$pdf->Cell(35,6,utf8_decode('Categoría'),1,0,'C',1);
$pdf->Cell(30,6,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(18,6,'Stock',1,0,'C',1);
$pdf->Cell(35,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Ln(10);

//creamos las filas de los registros según la consulta mysql
require_once "../modelos/Articulo.php";
$articulo = new Articulo();

$rspta = $articulo->listar();

//implementamos las celdas de la tabla con los registros a mostrar
$pdf->SetWidths(array(70,35,30,18,35));

while ($reg= $rspta->fetch_object()) {
	$nombre=$reg->nombre;
	$categoria= $reg->categoria;
	$codigo=$reg->codigo;
	$stock=$reg->stock;
	$descripcion=$reg->descripcion;

	$pdf->SetFont('Arial','',10);
	$pdf->Row(array(utf8_decode($nombre),utf8_decode($categoria),$codigo,$stock,utf8_decode($descripcion)));
}

//$pdf->Cell(35,6,utf8_decode('SELECT SUM($stock) FROM $articulo'),1,0,'C',1);

//mostramos el documento pdf
$pdf->Output();

}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
  ?>