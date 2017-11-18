<?php
session_start();


require_once 'fpdf/fpdf.php';
require_once 'fpdi/src/autoload.php';

class PDF extends FPDF{
    function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $k=$this->k;
        if($this->y+$h>$this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AcceptPageBreak())
        {
            $x=$this->x;
            $ws=$this->ws;
            if($ws>0)
            {
                $this->ws=0;
                $this->_out('0 Tw');
            }
            $this->AddPage($this->CurOrientation);
            $this->x=$x;
            if($ws>0)
            {
                $this->ws=$ws;
                $this->_out(sprintf('%.3F Tw',$ws*$k));
            }
        }
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $s='';
        if($fill || $border==1)
        {
            if($fill)
                $op=($border==1) ? 'B' : 'f';
            else
                $op='S';
            $s=sprintf('%.2F %.2F %.2F %.2F re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
        }
        if(is_string($border))
        {
            $x=$this->x;
            $y=$this->y;
            if(is_int(strpos($border,'L')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
            if(is_int(strpos($border,'T')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
            if(is_int(strpos($border,'R')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            if(is_int(strpos($border,'B')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
        }
        if($txt!='')
        {
            if($align=='R')
                $dx=$w-$this->cMargin-$this->GetStringWidth($txt);
            elseif($align=='C')
                $dx=($w-$this->GetStringWidth($txt))/2;
            elseif($align=='FJ')
            {
                //Set word spacing
                $wmax=($w-2*$this->cMargin);
                $this->ws=($wmax-$this->GetStringWidth($txt))/substr_count($txt,' ');
                $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                $dx=$this->cMargin;
            }
            else
                $dx=$this->cMargin;
            $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
            if($this->ColorFlag)
                $s.='q '.$this->TextColor.' ';
            $s.=sprintf('BT %.2F %.2F Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,$txt);
            if($this->underline)
                $s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
            if($this->ColorFlag)
                $s.=' Q';
            if($link)
            {
                if($align=='FJ')
                    $wlink=$wmax;
                else
                    $wlink=$this->GetStringWidth($txt);
                $this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$wlink,$this->FontSize,$link);
            }
        }
        if($s)
            $this->_out($s);
        if($align=='FJ')
        {
            //Remove word spacing
            $this->_out('0 Tw');
            $this->ws=0;
        }
        $this->lasth=$h;
        if($ln>0)
        {
            $this->y+=$h;
            if($ln==1)
                $this->x=$this->lMargin;
        }
        else
            $this->x+=$w;
    }
    function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0)
    {
        // resize font
        $subFontSizeold = $this->FontSizePt;
        $this->SetFontSize($subFontSize);

        // reposition y
        $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
        $subX        = $this->x;
        $subY        = $this->y;
        $this->SetXY($subX, $subY - $subOffset);

        //Output text
        $this->Write($h, $txt, $link);

        // restore y position
        $subX        = $this->x;
        $subY        = $this->y;
        $this->SetXY($subX,  $subY + $subOffset);

        // restore font size
        $this->SetFontSize($subFontSizeold);
    }
    function Header(){
        $title = "Universitatea din București / Facultatea de Matematica si Informatica";
        $this->SetTitle($title);

        $this->SetFont('Times', 'B', 10);

        $w = $this->GetStringWidth($title) + 6;
        $border = 0;

        //Title
        $this->Cell($w, 9, $title, $border, 0,'L');
        $this->Cell($this->GetStringWidth('Anexa 1') + 36, 9, 'Anexa 1',$border,1,'R');



    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','',6);
        // Print centered page number
        $this->Cell($this->GetStringWidth('Fisa se completeaza cu litere de tipar') + 7,2,'','T',1);
        $this->Cell(0,3,'Fisa se completeaza cu litere de tipar','',1,'L');
        $this->Cell(0,3,'Codul postal','',1,'L');
        $this->Cell(0,3,'Inclusiv prefixul localitatii','',1,'L');

    }

}

class getData{

    private $result = false;
    private $row = null;

    function __construct()
    {

        //Connect to DB

        $servername = "localhost";
        $username = "root";
        $password = "lab223";
        $dbname = "Admitere 2017";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            //die("Connection failed: ");
        } else
            //echo 'Connectat la Baza de Date!';
            //echo '<br>';

            $user =  $_SESSION['login_user'];
        //echo $emailField;
        $sqlData = "SELECT * FROM candidat WHERE uniqueEmail = '$user'";
        $this->result = mysqli_query($conn, $sqlData);
    }

    function getRow(){
        return $this->row = mysqli_fetch_array($this->result, 1);
    }
}

$pdf = new PDF();
$pdf->SetLeftMargin(24);
$pdf->SetFont('Times', 'B', 10);
$pdf->AddPage();

$border = 0;

//GET SQL DATA
$personData = new getData();
$data = $personData->getRow();

//TITLU

$pdf->Cell(160,3,'',$border,1,'C');
$pdf->Cell(160, 4, 'FISA DE INSCRIERE', $border, 1, 'C');
$pdf->Cell(160, 4, 'STUDII UNIVERSITARE DE LICENTA', $border, 1, 'C');

//SUBTITLU
$pdf->SetFont('Times', '',10);
$pdf->Cell(160, 5, 'la concursul de admitere pentru anul universitar _________________, sesiunea __________________',$border,1,'C');

//ORGANIZATORICE
$pdf->SetFont('Times', 'B',10);
$pdf->Cell(160, 5, 'ATENȚIE:',$border,1,'L');

$pdf->SetFont('Times', '',10);
$organizatorice = '            Admiterea se organizează pe domenii de licență, pe locuri finanțate de la buget sau pe locuri cu taxă (inclusiv la a 2-a facultate), la formele de învățământ IF (învățământ cu frecvență) sau ID (învățământ la distanță). Candidații vor fi declarați admiși în ordinea descrescătoare a mediei de admitere, la domeniul de licență, forma de finanțare, forma de învățământ și tipul de facultate la care au candidat.';
//$organizatorice = iconv('utf-8','ASCII/translit',$organizatorice);
$pdf->MultiCell(160,4,$organizatorice,$border,'FJ');

//DOMENIUL DE LICENTA

$pdf->SetFont('Times', 'B',10);
$pdf->Cell(160, 7, 'DOMENIUL DE LICENTA SI SPECIALIZAREA',$border,1,'L');
$pdf->SetFont('Times', '',10);
$domeniuDeLicenta = '            Se bifează un singur domeniu și, în cadrul acestuia, o singură specializare. Alegerea specializării în cadrul domeniului Matematică este orientativă; opțiunea finală pentru specializare la domeniul Matematică se va face la sfărșitul anului I, repartizarea pe specializări la acest domeniu făcându-se în ordinea descrescătoare a rezultatelor la învățătură (punctajele de clasificare), obținute după anul I.';
$pdf->MultiCell(160,4,$domeniuDeLicenta, $border, 'FJ');

$border = 1;

$pdf->SetFont('Times', 'B',10);
$pdf->Cell(75,4,'Domeniul','LTR',0,'C');
$pdf->Cell(75,4,'Specializarea','LTR',1,'C');
$pdf->SetFont('Times', '',10);

$pdf->Cell(65,4,'Matematica','LTR',0,'L');
$pdf->Cell(10,4,'','LTR',0,'L');
$pdf->Cell(65,4,'Matematica',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');

$pdf->Cell(65,4,'','LR',0,'L');
$pdf->Cell(10,4,'','LR',0,'L');
$pdf->Cell(65,4,'Matematica Aplicata',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');

$pdf->Cell(65,4,'','LRB',0,'L');
$pdf->Cell(10,4,'','LRB',0,'L');
$pdf->Cell(65,4,'Matematica-Informatica',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');


$pdf->Cell(65,4,'Informatica',1,0,'L');
$pdf->Cell(10,4,'',1,0,'L');
$pdf->Cell(65,4,'Informatica',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');

$pdf->Cell(65,4,'Calculatoare si tehnologia informatiei',1,0,'L');
$pdf->Cell(10,4,'',1,0,'L');
$pdf->Cell(65,4,'Calculatoare si tehnologia informatiei',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');

//FORMA DE INVATAMANT SI FINANTARE

$border = 0;

$pdf->SetFont('Times', 'B',10);
$pdf->Cell(160, 7, 'FORMA DE INVATAMANT SI FINANTARE',$border,1,'L');
$pdf->SetFont('Times', '',10);
$domeniuDeLicenta = '            Se bifează o singură formă de învățământ și, în cadrul acesteia, o singură formă de finanțare. Candidații care se înscriu pe locuri finanțate de la buget pot opta pentru un loc cu taxă în perioada de confirmare a locurilor cu taxă, cf. calendarului admiterii.';
$pdf->MultiCell(160,5,$domeniuDeLicenta, $border, 'FJ');

$border = 1;

$pdf->SetFont('Times', 'B',10);
$pdf->Cell(75,4,'Forma de invatamant','LTR',0,'C');
$pdf->Cell(75,4,'Forma de fiantare','LTR',1,'C');
$pdf->SetFont('Times', '',10);

$pdf->Cell(65,4,'IF (invatamant cu frecventa)','LTR',0,'L');
$pdf->Cell(10,4,'','LTR',0,'L');
$pdf->Cell(65,4,'Buget',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');

$pdf->Cell(65,4,'','LR',0,'L');
$pdf->Cell(10,4,'','LR',0,'L');
$pdf->Cell(65,4,'Taxa',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');

$pdf->Cell(65,4,'','LRB',0,'L');
$pdf->Cell(10,4,'','LRB',0,'L');
$pdf->Cell(65,4,'Taxa, a 2-a facultate',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');


$pdf->Cell(65,4,'ID (invatamant la distanta)','LTR',0,'L');
$pdf->Cell(10,4,'','LTR',0,'L');
$pdf->Cell(65,4,'Taxa',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');

$pdf->Cell(65,4,'','LRB',0,'L');
$pdf->Cell(10,4,'','LBR',0,'L');
$pdf->Cell(65,4,'Taxa, a 2-a facultate',1,0,'L');
$pdf->Cell(10,4,'',1,1,'L');

//DATE PERSONALE

$border = 0;

$pdf->SetFont('Times', 'B',10);
$pdf->Cell(160, 7, 'DATE PERSONALE',$border,1,'L');
$pdf->SetFont('Times', '',10);

$border = 1;

$pdf->MultiCell(27,4,' Nume de familie  la nastere', $border, 'L');
$pdf->Cell(100,4,'',$border,1);
$pdf->Cell($pdf->GetStringWidth('Initiala tatalui/mamei')+3,4,'Initiala tatalui/mamei',$border, 0);
$pdf->Cell(12,4,substr($data['nameFather'],0,1),$border,0);
$pdf->Cell($pdf->GetStringWidth('Prenume')+3,4,'Prenume',$border, 0);
$pdf->Cell(89,4,$data['surname'],$border,1);

$pdf->Cell($pdf->GetStringWidth('Initiala tatalui/mamei')+3,4,'Fiul/fiica lui',$border, 0);
$pdf->Cell(42,4,$data['nameFather'],$border,0);
$pdf->Cell($pdf->GetStringWidth('si al/a')+3,4,'si al/a',$border, 0);
$pdf->Cell(63.2,4,$data['nameMother'],$border,1);

$pdf->Cell($pdf->GetStringWidth('Actul de identitate')+10,4,'Actul de identitate',$border, 0);
//$pdf->Cell(19,4,$data['IDtype'],$border,0);
$pdf->Cell(19,4,$_SESSION['login_user'],$border,0);
$pdf->Cell($pdf->GetStringWidth('seria')+13.5,4,'seria',$border, 0);
$pdf->Cell($pdf->GetStringWidth('si al/a')+3,4,$data['serialID'],$border,0);
$pdf->Cell(19,4,'nr.',$border,0);
$pdf->Cell(44.3,4,$data['numberID'],$border,1);

$pdf->Cell($pdf->GetStringWidth('Eliberat de ')+2,4,'Eliberat de',$border, 0);
$pdf->Cell(44,4,$data['eliberatedBy'],$border,0);
$pdf->Cell($pdf->GetStringWidth('la data')+3.7,4,'  la data',$border, 0);
$pdf->Cell($pdf->GetStringWidth('si al/a')+22,4,$data['dateEliberated'],$border,0);
$pdf->Cell($pdf->GetStringWidth('valabil pana la ')+4,4,' valabil pana la',$border,0);
$pdf->Cell(18.8,4,$data['valabilityDate'],$border,1);

$pdf->Cell(39, 4,'CNP (cod numeric pers.)',$border,0);
$pdf->Cell(4,4,substr($data['CNP'],0,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],1,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],2,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],3,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],4,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],5,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],6,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],7,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],8,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],9,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],10,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],11,1),$border, 0);
$pdf->Cell(4,4,substr($data['CNP'],12,1),$border, 0);

$pdf->Cell($pdf->GetStringWidth(" Data nasterii") + 3,4," Data nasterii", $border, 0);

$pdf->Cell(4,4,'',$border, 0);
$pdf->Cell(4,4,'',$border, 0);
$pdf->Cell(4,4,'',$border, 0);
$pdf->Cell(4,4,'',$border, 0);
$pdf->Cell(4,4,'',$border, 0);
$pdf->Cell(4,4,'',$border, 0);
$pdf->Cell(4,4,'',$border, 0);
$pdf->Cell(4,4,'',$border, 1);

$pdf->Cell(23,4,'Locul nasterii', $border, 0);
$pdf->Cell(12,4,'Tara', $border, 0);
$pdf->Cell(28,4,$data['country'], $border, 0);
$pdf->Cell(19,4,'Localitatea', $border, 0);
$pdf->Cell(24,4,$data['city'],$border,0);
$pdf->Cell(20,4,'Judet/Sector',$border, 0);
$pdf->Cell(24,4,$data['county'],$border,1);

$pdf->Cell(23,4,'Cetatenia', $border, 0);
$pdf->Cell(40,4,$data['citizenship'], $border, 0);
$pdf->Cell(19,4,'Etnia', $border, 0);
$pdf->Cell(24,4,$data['ethnicity'],$border,0);
$pdf->Cell(20,4,'Starea civila',$border, 0);
$pdf->Cell(24,4,$data['maritalStatus'],$border,1);

//DOMICILIUL STABIL

$border = 0;

$pdf->SetFont('Times', 'B',10);
$pdf->Cell(160, 7, 'Domiciliul stabil (conform BI/CI)',$border,1,'L');
$pdf->SetFont('Times', '',10);

$border = 1;

$pdf->Cell(10,4,' Tara', $border, 0);
$pdf->Cell(30,4,'', $border, 0);
$pdf->Cell(20,4,' Localitate', $border, 0);
$pdf->Cell(33,4,'',$border,0);
$pdf->Cell(13,4,' Strada', $border, 0);
$pdf->Cell(44,4,'',$border,1);

$pdf->Cell(8,4,'Nr.',$border,0);
$pdf->Cell(10,4,'', $border,0);
$pdf->Cell(8,4,'Bl.',$border,0);
$pdf->Cell(9,4,'',$border,0);
$pdf->Cell(8,4,'Sc.',$border,0);
$pdf->Cell(9,4,'',$border,0);
$pdf->Cell(8,4,'Et.',$border,0);
$pdf->Cell(8,4,'',$border,0);
$pdf->Cell(9,4,'Ap.',$border,0);
$pdf->Cell(9,4,'',$border,0);
$pdf->Cell(20,4,'Judet/Sector',$border,0);
$pdf->Cell(20,4,'',$border,0);
$pdf->Cell(10,4,'Cod',$border,0);
$pdf->Cell(14,4,'',$border,1);

$pdf->Cell(26,4,'Telefon fix', $border,0);
$pdf->Cell(37,4,'',$border,0);
$pdf->Cell(43,4,'Telefon mobil', $border,0);
$pdf->Cell(44,4,'',$border,1);

$border = 0;

$pdf->SetFont('Times', 'B',10);
$pdf->Cell($pdf->GetStringWidth('Date de contact alternative '), 7, 'Date de contact alternative ',$border,0,'L');
$pdf->SetFont('Times', '',10);
$pdf->Cell(40 ,7,'(ale unuia dintre parinti, tutore, etc.)', $border,1,'L');

$border = 1;

$pdf->Cell(26,4,'Telefon fix', $border,0);
$pdf->Cell(37,4,'',$border,0);
$pdf->Cell(43,4,'Telefon mobil', $border,0);
$pdf->Cell(44,4,'',$border,1);

$pdf->Cell(26,4,'Email',$border,0);
$pdf->Cell(124,4,'',$border,1);

//PAGINA 2
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',10);

//STATUT SPECIAL LA ADMITERE

$border = 0;

$pdf->Cell(160,3,'',$border,1,'L');
$pdf->Cell(160, 8, 'STATUT SPECIAL LA ADMITERE ',$border,1,'L');

$pdf->SetFont('Times','',10);
$text = "            Se completeaza doar de catre candidatii care dau admitere pe un loc cu statut special, cf. categoriilor enumerate mai jos si se aproba de Comisia de admitere.";
$pdf->MultiCell(160,5,$text, $border, 'FJ');

$border = 1;
$pdf->SetFont('Times','B',10);

$pdf->Cell(72,'4','Categoria',$border,0,'C');
$pdf->Cell(20,'4','Aprobare',$border,0,'C');
$pdf->Cell(32,'4','Observatii',$border,0,'C');
$pdf->Cell(26,'4','Semnatura',$border,1,'C');

$pdf->SetFont('Times','',10);

$pdf->Cell(72,4.5,'(se bifeaza de catre candiat)', $border, 0,'C');
$pdf->Cell(78,4.5,'(se completeaza de catre Comisia de admitere)', $border, 1, 'C');

$pdf->Cell(63,4.5,'Locuri pentru rromi','LTR', 0,'L');
$pdf->Cell(9,4.5,'','LTR',0);
$pdf->Cell(11,4.5,'DA',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LTR',0,'L');
$pdf->Cell(26,4.5,'','LTR',1,'L');

$pdf->Cell(63,4.5,'','LBR', 0,'L');
$pdf->Cell(9,4.5,'','LBR',0);
$pdf->Cell(11,4.5,'NU',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LBR',0,'L');
$pdf->Cell(26,4.5,'','LBR',1,'L');

$pdf->Cell(63,4.5,'Locuri pentru romanii de pretutindeni','LTR', 0,'L');
$pdf->Cell(9,4.5,'','LTR',0);
$pdf->Cell(11,4.5,'DA',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LTR',0,'L');
$pdf->Cell(26,4.5,'','LTR',1,'L');

$pdf->Cell(63,4.5,'','LBR', 0,'L');
$pdf->Cell(9,4.5,'','LBR',0);
$pdf->Cell(11,4.5,'NU',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LBR',0,'L');
$pdf->Cell(26,4.5,'','LBR',1,'L');

$pdf->Cell(63,4.5,'Locuri pentru olimpici, admitere fara','LTR', 0,'L');
$pdf->Cell(9,4.5,'','LTR',0);
$pdf->Cell(11,4.5,'DA',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LTR',0,'L');
$pdf->Cell(26,4.5,'','LTR',1,'L');

$pdf->Cell(63,4.5,'examen','LBR', 0,'L');
$pdf->Cell(9,4.5,'','LBR',0);
$pdf->Cell(11,4.5,'NU',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LBR',0,'L');
$pdf->Cell(26,4.5,'','LBR',1,'L');



//STATUT SPECIAL PENTRU SCUTIREA DE PLATA TAXEI DE ADMITERE

$border = 0;
$pdf->SetFont('Times','B',10);


$pdf->Cell(160,2,'',$border,1,'L');
$pdf->Cell(160, 7, 'STATUT SPECIAL PENTRU SCUTIREA DE PLATA TAXEI DE ADMITERE ',$border,1,'L');

$pdf->SetFont('Times','',10);
$text = "            Se completeaza doar de catre candidatii care solicita scutirea de plata a taxei de admitere pentru un singur domeniu de licenta in cadrul Universitatii din Bucuresti si se aporba de Comisia de admitere.";
$pdf->MultiCell(160,5,$text, $border, 'FJ');

$border = 1;
$pdf->SetFont('Times','B',10);

$pdf->Cell(72,'4','Categoria',$border,0,'C');
$pdf->Cell(20,'4','Aprobare',$border,0,'C');
$pdf->Cell(32,'4','Observatii',$border,0,'C');
$pdf->Cell(26,'4','Semnatura',$border,1,'C');

$pdf->SetFont('Times','',10);

$pdf->Cell(72,4.5,'(se bifeaza de catre candiat)', $border, 0,'C');
$pdf->Cell(78,4.5,'(se completeaza de catre Comisia de admitere)', $border, 1, 'C');

$pdf->Cell(63,4.5,'Orfan de ambii parinti sau provenit din','LTR', 0,'L');
$pdf->Cell(9,4.5,'','LTR',0);
$pdf->Cell(11,4.5,'DA',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LTR',0,'L');
$pdf->Cell(26,4.5,'','LTR',1,'L');

$pdf->Cell(63,4.5,'casa de copii sau plasament familial','LBR', 0,'L');
$pdf->Cell(9,4.5,'','LBR',0);
$pdf->Cell(11,4.5,'NU',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LBR',0,'L');
$pdf->Cell(26,4.5,'','LBR',1,'L');

$pdf->Cell(63,4.5,'Parinte cadru didactic sau angajat la','LTR', 0,'L');
$pdf->Cell(9,4.5,'','LTR',0);
$pdf->Cell(11,4.5,'DA',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LTR',0,'L');
$pdf->Cell(26,4.5,'','LTR',1,'L');

$pdf->Cell(63,4.5,'Universitatea din Bucuresti','LBR', 0,'L');
$pdf->Cell(9,4.5,'','LBR',0);
$pdf->Cell(11,4.5,'NU',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LBR',0,'L');
$pdf->Cell(26,4.5,'','LBR',1,'L');

$pdf->Cell(63,4.5,'Olimpic, admis fara examen','LTR', 0,'L');
$pdf->Cell(9,4.5,'','LTR',0);
$pdf->Cell(11,4.5,'DA',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LTR',0,'L');
$pdf->Cell(26,4.5,'','LTR',1,'L');

$pdf->Cell(63,4.5,'examen','LBR', 0,'L');
$pdf->Cell(9,4.5,'','LBR',0);
$pdf->Cell(11,4.5,'NU',$border,0,'L');
$pdf->Cell(9,4.5,'',$border,0);
$pdf->Cell(32,4.5,'','LBR',0,'L');
$pdf->Cell(26,4.5,'','LBR',0,'L');

$border = 0;
$pdf->SetFont('Times','B',10);


$pdf->Cell(160,8,'',$border,1,'L');
$pdf->Cell(160, 7, 'INFORMATII DESPRE ALTE STUDEII UNIVERSTIARE ',$border,1,'L');


$pdf->SetFont('Times','',10);
$text = "            Se completeaza obligatoriu de catre candidatii care sunt studenti sau care au absolvit o facultate, in situtatia in care vor sa candideze pe un loc finantat de la buget sau pe un loc la a 2-a facultate.";
$pdf->MultiCell(160,4,$text, $border, 'FJ');

$border = 1;

$pdf->Cell(24,'4','Universitatea',$border,0,'L');
$pdf->Cell(48,'4','',$border,0,'L');
$pdf->Cell(20,'4','Facultatea',$border,0,'L');
$pdf->Cell(58,'4','',$border,1,'L');

$pdf->Cell(24,'4','Localitatea',$border,0,'L');
$pdf->Cell(48,'4','',$border,0,'L');
$pdf->Cell(20,'4','Tara',$border,0,'L');
$pdf->Cell(58,'4','',$border,1,'L');

$pdf->Cell(24,'4','Domeniul',$border,0,'L');
$pdf->Cell(48,'4','',$border,0,'L');
$pdf->Cell(55,'4','Numarul de ani finantati de la buget  ',$border,0,'L');
$pdf->Cell(23,'4','',$border,1,'L');

$pdf->Cell(24,'4','Student anul',$border,0,'L');
$pdf->Cell(8,'4','',$border,0,'L');
$pdf->Cell(60,'4','Absolvent fara diploma de licenta in anul',$border,0,'L');
$pdf->Cell(15,'4','',$border,0,'L');
$pdf->Cell(26,'4','Licentiat in anul',$border,0,'L');
$pdf->Cell(17,'4','',$border,1,'L');

$pdf->Cell(55,4,'Diploma de licenta in specializarea',$border,0,'L');
$pdf->Cell(45,4,'',$border,0,'L');
$pdf->Cell(12,4,'Seria',$border,0,'L');
$pdf->Cell(13,4,'',$border,0,'L');
$pdf->Cell(8,4,'Nr.',$border,0,'L');
$pdf->Cell(17,4,'',$border,1,'L');

$pdf->Cell(24,'4','Emisa de',$border,0,'L');
$pdf->Cell(48,'4','',$border,0,'L');
$pdf->Cell(20,'4','La data de',$border,0,'L');
$pdf->Cell(58,'4','',$border,1,'L');

$pdf->Cell(44,'4','Media generala de absolvire',$border,0,'L');
$pdf->Cell(28,'4','',$border,0,'L');
$pdf->Cell(44,'4','Media la examenul de licenta',$border,0,'L');
$pdf->Cell(34,'4','',$border,1,'L');


$border = 0;
$pdf->SetFont('Times','B',10);


$pdf->Cell(160,8,'',$border,1,'L');
$pdf->Cell(160, 7, 'INFORMATII DESPRE LICEUL ABSOLVIT ',$border,1,'L');


$pdf->SetFont('Times','',10);
$text = "            Se completeaza de catre toti candidatii";
$pdf->MultiCell(160,4,$text, $border, '');

$border = 1;

$pdf->Cell(15,'4','Liceul',$border,0,'L');
$pdf->Cell(135,'4','',$border,1,'L');
$pdf->Cell(15,'4','Tara',$border,0,'L');
$pdf->Cell(43,'4','',$border,0,'L');
$pdf->Cell(20,'4','Localitatea',$border,0,'L');
$pdf->Cell(72,'4','',$border,1,'L');
$pdf->Cell(58,'4','Am sustinut bacalaureatul in sesiunea',$border,0,'L');
$pdf->Cell(11,'4','',$border,0,'L');
$pdf->Cell(9,'4','Anul',$border,0,'L');
$pdf->Cell(18,'4','',$border,0,'L');
$pdf->Cell(35,'4','Media generala BAC',$border,0,'L');
$pdf->Cell(19,'4','',$border,1,'L');

$pdf->Cell(131,4,'Nota la BAC la disciplina Matematica (sau echivalent, cf. aprobarii Comisiei de admitere)', $border,0,'L');
$pdf->Cell(19,4,'',$border,1);

$pdf->Cell(37,'4','Diploma de bacalaureat',$border,0,'L');
$pdf->Cell(12,'4','Seria',$border,0,'L');
$pdf->Cell(11,'4','',$border,0,'L');
$pdf->Cell(9,'4','Nr.',$border,0,'L');
$pdf->Cell(27,'4','',$border,0,'L');
$pdf->Cell(27,'4','Emisa la data de',$border,0,'L');
$pdf->Cell(27,4,'',$border,1);

$pdf->Output();
?>