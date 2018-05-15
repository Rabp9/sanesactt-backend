<?php
    $pdf->AddPage();
    $pdf->SetFont("Helvetica", "", 11);
    
    // 190
    $pdf->Cell(40, 10, '2018', 1, 0, 'C');
    $pdf->Cell(110, 10, '2018', 1, 0, 'C');
    $pdf->Cell(40, 10, '2018', 1, 0, 'C');
    $pdf->ln(10);
    
    
    $pdf->Output("I", "Reporte_por Cruces.pdf");
?>