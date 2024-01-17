<?php
    require('fpdf186/fpdf.php');
    require ('cn.php');

    class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('MEDIA/logoPDF.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(51,10,'NOTA DE ENTREGA',1,0,'C');
        // Salto de línea
        $this->Ln(20);
        
        
        $this->Cell(40, 10, 'Nombre', 1, 0, 'C', 0);
        $this->Cell(32, 10, 'ID_Producto', 1, 0, 'C', 0);
        $this->Cell(22, 10, 'cantidad', 1, 0, 'C', 0);
        $this->Cell(37, 10, 'PrecioUnitario', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Impuesto', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'PrecioTotal', 1, 1, 'C', 0);
    }
    
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
    }
    
    //cuerpo del pdf

    $consulta = "SELECT * FROM `tproductosfactura` ORDER BY id_producto DESC LIMIT 1;";
    $resultado = $mysqli->query($consulta);
    $ultimo_elemento = $resultado->fetch_array();
    $cadena = $ultimo_elemento['ID_Relacionado'];
    $consulta = "SELECT * FROM `tproductosfactura` WHERE `ID_Relacionado` = $cadena;";
    $resultado = $mysqli->query($consulta);

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',16);

    
    while($row = $resultado->fetch_assoc()){
        $pdf->Cell(40, 10, $row['Nombre'], 1, 0, 'C', 0);
        $pdf->Cell(32, 10, $row['ID_Producto'], 1, 0, 'C', 0);
        $pdf->Cell(22, 10, $row['cantidad'], 1, 0, 'C', 0);
        $pdf->Cell(37, 10, $row['PrecioUnitario'], 1, 0, 'C', 0);
        $pdf->Cell(25, 10, $row['Impuesto'], 1, 0, 'C', 0);
        $pdf->Cell(30, 10, $row['PrecioTotal'], 1, 1, 'C', 0);
        
    }
    
    $pdf->Output();
?>