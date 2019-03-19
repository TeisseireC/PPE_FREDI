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
$pdf->SetFont('Arial', '', 12);
// Entêtes
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->SetFillColor(125); // Niveau de gris
$pdf->SetX(30);
$pdf->Ln();

// Boucle du contenu
session_start();
$licence = isset($_GET['licence']) ? $_GET['licence'] : $_POST['licence'] ;

$adherentDAO = new AdherentDAO();
$clubDAO = new ClubDAO();
$bordereauDAO = new BordereauDAO();
$ligneDeFraisDAO = new ligneDeFraisDAO();

$adherent = $adherentDAO->findByLicence($licence);
$mail = $adherent->get_adresseMail();

$club = $clubDAO->find($adherent->get_idClub());

$date1 = date('Y');

$bordereau = $bordereauDAO->findBordereaux($mail, $date1);
$idbordereau = $bordereau->get_idBordereau();

$ligneDeFrais = $ligneDeFraisDAO->findLigneDeFrais($mail, $idbordereau);


$pdf->Cell(0, 15, utf8_decode("Nom du club : ".$club->get_nomclub()), 0, 0, 'L', false);
$pdf->Ln();

if ($club->get_idligue() == 1) {

    $pdf->Cell(0, 15, utf8_decode("Club de Football"), 0, 0, 'L', false);
    $pdf->Ln(); 

} else if ($club->get_idligue() == 2) {

    $pdf->Cell(0, 15, utf8_decode("Club de Basketball"), 0, 0, 'L', false);
    $pdf->Ln(); 

} else if ($club->get_idligue() == 3) {

    $pdf->Cell(0, 15, utf8_decode("Club de Volleyball"), 0, 0, 'L', false);
    $pdf->Ln();

}

$pdf->Cell(0, 15, utf8_decode("Nom de l'adherent : ".$adherent->get_nomAdh()), 0, 0, 'L', false);
$pdf->Ln();
$pdf->Cell(0, 15, utf8_decode("Prenom de l'adherent : ".$adherent->get_prenomAdh()), 0, 0, 'L', false);
$pdf->Ln();
$pdf->Cell(0, 15, utf8_decode("Adresse de l'adherent : ".$adherent->get_adresse()), 0, 0, 'L', false);
$pdf->Ln();
$pdf->Cell(0, 15, utf8_decode("Code Postal de l'adherent : ".$adherent->get_codePostal()), 0, 0, 'L', false);
$pdf->Ln();
$pdf->Cell(0, 15, utf8_decode("Ville de l'adherent : ".$adherent->get_ville()), 0, 0, 'L', false);
$pdf->Ln();

//cell(w,h,txt,border,ln,align,fill,link)
$pdf->Cell(53,6,utf8_decode("Nom du club : ".$club->get_nomclub()), 1, 0, 'L', false);
$pdf->Ln();

$pdf->Cell(25,6,utf8_decode("Date"),1);
//$pdf->Cell(40,6,$motif->get_LibelleMotifs(),1);
$pdf->Cell(40,6,utf8_decode("Trajet"),1);
$pdf->Cell(20,6,utf8_decode("Km"),1);
$pdf->Cell(20,6,utf8_decode("Prix/Km"),1);
$pdf->Cell(20,6,utf8_decode("Peage"),1);
$pdf->Cell(20,6,utf8_decode("Repas"),1);
$pdf->Cell(28,6,utf8_decode("Hebergement"),1);
$pdf->Cell(20,6,utf8_decode("Total"),1);
$pdf->Ln();

foreach($ligneDeFrais as $ligne){
        $pdf->Cell(25,6,utf8_decode($ligne->get_dateFrais()),1);
        //$pdf->Cell(40,6,$motif->get_LibelleMotifs(),1);
        $pdf->Cell(40,6,$ligne->get_trajet(),1);
        $pdf->Cell(20,6,$ligne->get_km(),1);
        $pdf->Cell(20,6,$ligne->get_coutTrajet(),1);
        $pdf->Cell(20,6,$ligne->get_coutPeage(),1);
        $pdf->Cell(20,6,$ligne->get_coutRepas(),1);
        $pdf->Cell(28,6,$ligne->get_coutHebergement(),1);
        $pdf->Cell(20,6,$ligne->get_coutTotal(),1);
    $pdf->Ln();
}
foreach($ligneDeFrais as $ligne){
    $TotalTotal = $TotalTotal + $ligne->get_coutTotal();
}
$pdf -> SetX(143);    // set the cursor at Y position 5
$pdf->Cell(28,6,utf8_decode("TotalTotal"),1);
$pdf->Cell(20,6,$TotalTotal,1);
$pdf->Ln();
$pdf -> SetX(0);    // set the cursor at Y position 5

// Génération du document PDF
$pdf->Output('../outfile/cerfa_'. $adherent->get_prenomAdh() . '_'. $adherent->get_nomAdh() .'_'. date('Y') .'.pdf', 'f');
header('Location: ../../Pages/Tresorier/pageTresorier.php');
