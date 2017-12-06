<?php

include 'config.php';
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected succesfully";

$uniqueEmail = $_SESSION["login_user"];

$dateOfBirth = $_POST["dateOfBirth"] ;
$birthName = $_POST["birthName"];
$SQL = "
        UPDATE candidat
          SET CNP = "."'".$_POST["CNP"]."'".",
              birthName = "."'".$birthName."'".",
              name = "."'".$_POST['name']."'".",
              surname = "."'".$_POST["surname"]."'".",
              dateOfBirth = "."'".$dateOfBirth."'".",
              nameFather = "."'".$_POST["nameFather"] ."'". ",
              nameMother = "."'".$_POST["nameMother"] ."'". ",
              IDtype = "."'".$_POST["IDtype"] ."'". ",
              serialID = "."'".$_POST["serialID"] ."'". ",
              numberId = "."'".$_POST["numberID"] ."'". ",
              eliberatedBy = "."'".$_POST["eliberatedBy"] ."'". ",
              dateEliberated = "."'".$_POST["dateEliberated"] ."'". ",
              valabilityDate = "."'".$_POST["valabilityDate"] ."'". ",
              country = "."'".$_POST["country"] ."'". ",
              city = "."'".$_POST["city"] ."'". ",
              county = "."'".$_POST["county"] ."'". ",
              citizenship = "."'".$_POST["citizenship"] ."'". ",
              ethnicity = "."'".$_POST["ethnicity"] ."'". ",
              maritalStatus = "."'".$_POST["maritalStatus"] ."'". ",
              taraDomiciliu = "."'".$_POST["taraDomiciliu"] ."'". ",
              localitateDomiciliu = "."'".$_POST["localitateDomiciliu"] ."'". ",
              stradaDomiciliu = "."'".$_POST["stradaDomiciliu"] ."'". ",
              numarDomiciliu = "."'".$_POST["numarDomiciliu"] ."'". ",
              blocDomiciliu = "."'".$_POST["blocDomiciliu"] ."'". ",
              scaraDomiciliu = "."'".$_POST["scaraDomiciliu"] ."'". ",
              etajDomiciliu = "."'".$_POST["etajDomiciliu"] ."'". ",
              apartamentDomiciliu = "."'".$_POST["apartamentDomiciliu"] ."'". ",
              codPostalDomiciliu = "."'".$_POST["codPostalDomiciliu"] ."'". ",
              fixDomiciliu = "."'".$_POST["fixDomiciliu"] ."'". ",
              mobilDomiciliu = "."'".$_POST["mobilDomiciliu"] ."'". ",
              fixParinte = "."'".$_POST["fixParinte"] ."'". ",
              mobilParinte = "."'".$_POST["mobilParinte"] ."'". ",
              emailParinte = "."'".$_POST["emailParinte"] ."'". ",
              matematica = "."'".isset($_POST["matematica"]) ."'". ",
              informatica = "."'". isset($_POST["informatica"]) ."'". ",
              cti = "."'". isset($_POST["cti"]) ."'". ",
              matematicaPura = "."'".isset($_POST["matematicaPura"]) ."'". ",
              matematicaAplicata = "."'".isset($_POST["matematicaAplicata"]) ."'". ",
              matematicaInformatica = "."'".isset($_POST["matematicaInformatica"]) ."'". ",
              rromi = "."'". isset($_POST["rromi"]) ."'". ",
              pretutindeni = "."'". isset($_POST["pretutindeni"]) ."'". ",
              olimpicAdmitere = "."'". isset($_POST["olimpicAdmitere"]) ."'". ",
              orfan = "."'". isset($_POST["orfan"]) ."'". ",
              parinteProfesor = "."'". isset($_POST["parinteProfesor"]) ."'". ",
              olimpicExamen = "."'".isset($_POST["olimpicExamen"]) ."'". ",   
              denumireLiceu = "."'".$_POST["denumireLiceu"] ."'". ",
              taraLiceu = "."'".$_POST["taraLiceu"] ."'". ",
              localitateLiceu = "."'".$_POST["localitateLiceu"] ."'". ",
              sesiuneBac = "."'".$_POST["sesiuneBac"] ."'". ",
              anBac = "."'".$_POST["anBac"] ."'". ",
              medieBac = "."'".$_POST["medieBac"] ."'". ",
              notaMateBac = "."'".$_POST["notaMateBac"] ."'". ",
              serieBac = "."'".$_POST["serieBac"] ."'". ",
              numarBac = "."'".$_POST["numarBac"] ."'". ",
              universitateALTS = "."'".$_POST["universitateALTS"] ."'". ",
              taraALTS = "."'".$_POST["taraALTS"] ."'". ",
              localitateALTS = "."'".$_POST["localitateALTS"] ."'". ",
              facultateALTS = "."'".$_POST["facultateALTS"] ."'". ",
              domeniulALTS = "."'".$_POST["domeniulALTS"] ."'". ",
              aniALTS = "."'".$_POST["aniALTS"] ."'". ",
              anulALTS = "."'".$_POST["anulALTS"] ."'". ",
              absolventALTS = "."'".$_POST["absolventALTS"] ."'". ",
              licentiatALTS = "."'".$_POST["licentiatALTS"] ."'". ",
              specializareALTS = "."'".$_POST["specializareALTS"] ."'". ",
              serieALTS = "."'".$_POST["serieALTS"] ."'". ",
              numarALTS = "."'".$_POST["numarALTS"] ."'". ",
              emitentALTS = "."'".$_POST["emitentALTS"] ."'". ",
              dataemiteriiALTS = "."'".$_POST["dataemiteriiALTS"] ."'". ",
              absolvireALTS = "."'".$_POST["absolvireALTS"] ."'". ",
              licentaALTS = "."'".$_POST["licentaALTS"] ."'". "
              
          WHERE uniqueEmail = 'raresito@gmail.com' ";

$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);

if($conn->query($SQL) == TRUE){
    echo "New record created successfully";
} else {
    echo "
            <pre>
                <?php 
                    var_dmp($_POST);
                ?>
            </pre>";
    echo "Error: " . $SQL . "<br>" . $conn->error;
}
echo '<div id = "sumbitArea">
            <a href="generate.php"> Print </a>
            <a href="sendMail.php"> Send Mail </a>
      </div>';

var_dump($_POST);
?>