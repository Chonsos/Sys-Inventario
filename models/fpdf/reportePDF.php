
<?php

session_start();

define('FPDF_FONTPATH', './font/');
require('./fpdf.php');
require_once('../conexion.php');
require_once('../crud.php');

if (isset($_SESSION)) {
   if (isset($_SESSION["sesionIniciada"])) {
      if ($_SESSION["sesionIniciada"]) {
         class PDF extends FPDF
         {      
            // Cabecera de página
            function Header()
            {
               
               $this->Image('cleanLogo.png', 80, 5, 60); // logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
               $this->SetFont('Arial', 'B', 19); // tipo fuente, negrita(B-I-U-BIU), tamañoTexto
               $this->Cell(45); // Movernos a la derecha
               $this->SetTextColor(0, 0, 0); // color

               // Creamos una celda o fila
               $this->Ln(20); // Salto de línea
               $this->SetTextColor(103); //color

               /* TITULO DE LA TABLA */
               //color
               $this->SetTextColor(255, 0, 0);
               $this->Cell(50); // mover a la derecha
               $this->SetFont('Arial', 'B', 15);
               $this->Cell(100, 10, utf8_decode("REPORTE DE PRODUCTOS "), 0, 1, 'C', 0);
               $this->Ln(7);

               /* CAMPOS DE LA TABLA */
               $this->SetFillColor(255, 0, 0); //colorFondo
               $this->SetTextColor(0, 0, 0); //colorTexto
               $this->SetDrawColor(163, 163, 163); //colorBorde
               $this->SetFont('Arial', 'B', 11);
               $this->Cell(30);
               $this->Cell(17, 10, utf8_decode('Codigo'), 1, 0, 'C', 1);
               $this->Cell(40, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
               $this->Cell(30, 10, utf8_decode('Descripcion'), 1, 0, 'C', 1);
               $this->Cell(20, 10, utf8_decode('Stock'), 1, 0, 'C', 1);
               $this->Cell(25, 10, utf8_decode('Precio'), 1, 1, 'C', 1);
            }

            // Pie de página
            function Footer()
            {
               $this->SetY(-15); // Posición: a 1,5 cm del final
               $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
               $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

               $this->SetY(-15); // Posición: a 1,5 cm del final
               $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
               $hoy = date('d/m/Y');
               $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
            }
         }

         $pdf = new PDF();
         $pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
         $pdf->AliasNbPages(); //muestra la pagina / y total de paginas

         $i = 0;
         $pdf->SetFont('Arial', '', 12);
         $pdf->SetDrawColor(163, 163, 163); //colorBorde

         /* TABLA */
         $respuesta = Datos::mostrarProductosModel("inventario");
         foreach ($respuesta as $key => $value) {
            $pdf->Cell(30);
            $pdf->Cell(17, 10, utf8_decode($value["codigoProducto"]), 1, 0, '. C .', 0);
            $pdf->Cell(40, 10, utf8_decode($value["nombreProducto"]), 1, 0, '. C .', 0);
            $pdf->Cell(30, 10, utf8_decode($value["descripcion"]), 1, 0, '. C .', 0);
            $pdf->Cell(20, 10, utf8_decode($value["stock"]), 1, 0, '. C .', 0);
            $pdf->Cell(25, 10, utf8_decode($value["precio"]), 1, 1, '. C .', 0);
         }
         
        
         $pdf->Output('Reporte de Productos.pdf', 'I');  //nombreDescarga, Visor(I->visualizar - D->descargar)
      }
   } else {
      header("Location: ../../index.php");
      exit();
   }
} 
?>