<?php
date_default_timezone_set('America/Fortaleza'); // setando o horario do servidor para o fuso mais proximo para quando exibir a data no relatorio ela estar correta

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header('Location: /smartcash/views/login.php');
}


require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/back_relatorio/fpdf.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smartcash/back_relatorio/mc_tables.php';

// usando o multicell
$mc = new PDF_MC_Table();
$mc->AddPage();

// data/hora de emissao
$mc->SetFont('Times', '', 8);
$mc->Cell(195, 1, "Gerado em: " . date('d/m/Y H:i:s'), 0, 0, 'R');
$mc->Ln();

// borda da pagina
$mc->SetDrawColor(158, 7, 138);
$mc->SetLineWidth(1);
$mc->Line(5, 5, 205, 5);
$mc->Line(5, 5, 5, 290);
$mc->Line(205, 290, 5, 290);
$mc->Line(205, 290, 205, 5);

// fonte e cores
$mc->SetFont('Times', '', 16);
$mc->SetTextColor(158, 7, 138);

// imagem
$mc->Image($_SERVER['DOCUMENT_ROOT'] . '/smartcash/imgs/logo.png', ($mc->GetPageWidth() - 30) / 2, null, 30, 30);

// titulo
$mc->Cell(0, 10, mb_convert_encoding('RELATÓRIO', "Windows-1252", "UTF-8"), 0, 0, 'C');
$mc->Ln();

$mc->SetWidths(array(
    ($mc->GetPageWidth() - 20) * 0.25, 
    ($mc->GetPageWidth() - 20) * 0.25, 
    ($mc->GetPageWidth() - 20) * 0.25, 
    ($mc->GetPageWidth() - 20) * 0.25
));

// titulo da tabela
$mc->Row(array(
    mb_convert_encoding('DATA', "Windows-1252", "UTF-8"),
    mb_convert_encoding('DESCRIÇÃO', "Windows-1252", "UTF-8"),
    mb_convert_encoding('CATEGORIA', "Windows-1252", "UTF-8"),
    mb_convert_encoding('VALOR', "Windows-1252", "UTF-8")
));

foreach ($_SESSION['extrato'] as $dado){
    $mc->Row(array(
        mb_convert_encoding(date('d/m/Y', strtotime($dado[0])), "Windows-1252", "UTF-8"),
        mb_convert_encoding($dado[1], "Windows-1252", "UTF-8"), 
        mb_convert_encoding($dado[3], "Windows-1252", "UTF-8"), 
        'R$ ' . mb_convert_encoding($dado[2], "Windows-1252", "UTF-8"
    )));
}

// linha de total larguras
$mc->SetWidths(array(
    ($mc->GetPageWidth() - 20) * 0.75, 
    ($mc->GetPageWidth() - 20) * 0.25
));

// linha de total valores
$mc->Row(array(
    mb_convert_encoding('Total', "Windows-1252", "UTF-8"),
    mb_convert_encoding("R$ " . $_SESSION['resultado'], "Windows-1252", "UTF-8")
));
    
$mc->Output();
