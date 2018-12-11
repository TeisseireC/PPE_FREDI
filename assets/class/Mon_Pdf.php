<?php
/**
 * Description of Mon_Pdf
 *
 * @author Grolphite
 */
require('../lib/fpdf.php');

require('../../assets/include/global.inc.php');



class MON_PDF extends FPDF {

    function Header() {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'Tableau', 'B', 0, 'C');
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(0, 0, 0); // Noir
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }

}

$pdf = new MON_PDF('P');
$pdf->SetTitle('Reçu dons aux oeuvres', true);
$pdf->SetAuthor('G04');
$pdf->SetSubject('Reçu dons aux oeuvres');
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Times', '', 24);
$pdf->SetTextColor(204, 51, 0); // Rouge sang #CC3300
$pdf->Cell(0, 20, utf8_decode("Reçu dons aux oeuvres"), 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 16);
// Entêtes
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->SetFillColor(125); // Niveau de gris
$pdf->SetX(30);
$pdf->Ln();

// Boucle du contenu
session_start();
$mail = $_SESSION['email'];


$adherentDAO = new AdherentDAO();
$clubDAO = new ClubDAO();

$adherent = $adherentDAO->findAllByMail($mail);
$clubs = $clubDAO->findAllByIdClubAdh($adherent->get_idClub());

    foreach($clubs as $club){
        $pdf->Cell(50, 15, utf8_decode($club->get_nomclub()), 0, 0, 'C', false);
        $pdf->Ln();
        if ($club->get_idligue() == 1) {

            $pdf->Cell(50, 15, utf8_decode("Club de Football"), 0, 0, 'C', false);
            $pdf->Ln(); 

        } else if ($club->get_idligue() == 2) {

            $pdf->Cell(50, 15, utf8_decode("Club de Basketball"), 0, 0, 'C', false);
            $pdf->Ln(); 

        } else if ($club->get_idligue() == 3) {

            $pdf->Cell(50, 15, utf8_decode("Club de Volleyball"), 0, 0, 'C', false);
            $pdf->Ln();

        }
    }

    $pdf->Cell(50, 15, utf8_decode($adherent->get_idClub()), 0, 0, 'C', false);
    $pdf->Ln();
    $pdf->Cell(50, 15, utf8_decode($adherent->get_nomAdh()), 0, 0, 'C', false);
    $pdf->Ln();
    $pdf->Cell(50, 15, utf8_decode($adherent->get_prenomAdh()), 0, 0, 'C', false);
    $pdf->Ln();

// Génération du document PDF
$pdf->Output('../outfile/cerfa_'. $adherent->get_prenomAdh() . '_'. $adherent->get_nomAdh() .'_'. date('Y') .'.pdf', 'f');
header('Location: ../../Pages/Tresorier/pageTresorier.php');
