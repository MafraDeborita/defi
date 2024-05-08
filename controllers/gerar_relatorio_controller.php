<?php

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: /defi/views/login.php');
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/defi/back_relatorio/fpdf.php';


$pdf = new FPDF();
$pdf->AddPage();

// borda da pagina
$pdf->SetDrawColor(158, 7, 138);
$pdf->SetLineWidth(1);
$pdf->Line(5, 5, 205, 5);
$pdf->Line(5, 5, 5, 290);
$pdf->Line(205, 290, 5, 290);
$pdf->Line(205, 290, 205, 5);

// fonte e cores
$pdf->SetFont('Times', '', 16);
$pdf->SetTextColor(158, 7, 138);

// imagem
$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/defi/imgs/logo.png', ($pdf->GetPageWidth() - 30) / 2, null, 30, 30);

// titulo
$pdf->Cell(0, 10, mb_convert_encoding('RELATÓRIO', "Windows-1252", "UTF-8"), 0, 0, 'C');
$pdf->Ln();

// titulo da tabela
$pdf->Cell(($pdf->GetPageWidth() - 20) / 4, 10, mb_convert_encoding('DATA', "Windows-1252", "UTF-8"), 0, 0, 'C');
$pdf->Cell(($pdf->GetPageWidth() - 20) / 4, 10, mb_convert_encoding('DESCRIÇÃO', "Windows-1252", "UTF-8"), 0, 0, 'C');
$pdf->Cell(($pdf->GetPageWidth() - 20) / 4, 10, mb_convert_encoding('CATEGORIA', "Windows-1252", "UTF-8"), 0, 0, 'C');
$pdf->Cell(($pdf->GetPageWidth() - 20) / 4, 10, mb_convert_encoding('VALOR', "Windows-1252", "UTF-8"), 0, 0, 'C');
$pdf->Ln();

// linhas da tabela
foreach ($_SESSION['extrato'] as $dado) {
    $pdf->Cell(($pdf->GetPageWidth() - 20) / 4, 10, mb_convert_encoding(date('d/m/Y', strtotime($dado[0])), "Windows-1252", "UTF-8"), 1, 0, 'C');
    $pdf->Cell(($pdf->GetPageWidth() - 20) / 4, 10, mb_convert_encoding($dado[1], "Windows-1252", "UTF-8"), 1, 0, 'C');
    $pdf->Cell(($pdf->GetPageWidth() - 20) / 4, 10, mb_convert_encoding($dado[3], "Windows-1252", "UTF-8"), 1, 0, 'C');
    $pdf->Cell(($pdf->GetPageWidth() - 20) / 4, 10, 'R$ ' . mb_convert_encoding($dado[2], "Windows-1252", "UTF-8"), 1, 0, 'C');
    $pdf->Ln();
}

// linha de total
$pdf->Cell(($pdf->GetPageWidth() - 20) * 0.75, 10, mb_convert_encoding('Total', "Windows-1252", "UTF-8"), 1, 0, 'C');
$pdf->Cell(($pdf->GetPageWidth() - 20) * 0.25, 10, mb_convert_encoding("R$ " . $_SESSION['resultado'], "Windows-1252", "UTF-8"), 1, 0, 'C');


$pdf->Output('I', 'Relatório.pdf', true);
