<?php
session_start();
?>

<html>
    <head>
        <title>
            Admitere 2017 - Trimis
        </title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Welcome <?php echo $_SESSION['login_user']; ?></a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="logout.php">Sign Out</a></li>
                    <li><a href = "ContactPage.php"> Contacteaza-ne! </a></li>
                </ul>
            </div>
        </nav>
    </body>
</html>

<?php

include 'config.php';
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

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ALL;

try {

    $stmt = $conn -> prepare(
        "UPDATE candidat SET 
            CNP = ?,
            birthName = ?,
            name = ?,
            surname = ?,
            dateOfBirth = ?,
            nameFather = ?,
            nameMother = ?,
            IDtype = ?,
            serialID = ?,
            numberId = ?,
            eliberatedBy = ?,
            dateEliberated = ?,
            valabilityDate = ?,
            country = ?,
            city = ?,
            county = ?,
            citizenship = ?,
            ethnicity = ?,
            maritalStatus = ?,
            taraDomiciliu = ?,
            localitateDomiciliu = ?,
            stradaDomiciliu = ?,
            numarDomiciliu = ?,
            blocDomiciliu = ?,
            scaraDomiciliu = ?,
            etajDomiciliu = ?,
            apartamentDomiciliu = ?,
            codPostalDomiciliu = ?,
            fixDomiciliu = ?,
            mobilDomiciliu = ?,
            fixParinte = ?,
            mobilParinte = ?,
            emailParinte = ?,
            matematica = ?,
            informatica = ?,
            cti = ?,
            matematicaPura = ?,
            matematicaAplicata = ?,
            matematicaInformatica = ?,
            rromi = ?,
            pretutindeni = ?,
            olimpicAdmitere = ?,
            orfan = ?,
            parinteProfesor = ?,
            olimpicExamen = ?,   
            denumireLiceu = ?,
            taraLiceu = ?,
            localitateLiceu = ?,
            sesiuneBac = ?,
            anBac = ?,
            medieBac = ?,
            notaMateBac = ?,
            serieBac = ?,
            numarBac = ?,
            universitateALTS = ?,
            taraALTS = ?,
            localitateALTS = ?,
            facultateALTS = ?,
            domeniulALTS = ?,
            aniALTS = ?,
            anulALTS = ?,
            absolventALTS = ?,
            licentiatALTS = ?,
            specializareALTS = ?,
            serieALTS = ?,
            numarALTS = ?,
            emitentALTS = ?,
            dataemiteriiALTS = ?,
            absolvireALTS = ?,
            licentaALTS = ?
            WHERE uniqueEmail = ?");

    if (false === $stmt) {
        // and since all the following operations need a valid/ready statement object
        // it doesn't make sense to go on
        // you might want to use a more sophisticated mechanism than die()
        // but's it's only an example
        die('prepare() failsed: ' . htmlspecialchars($mysqli -> error));
    }

    $stmt2 = $stmt -> bind_param("sssssssssisssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss",
        $_POST['CNP'],
        $birthName,
        $_POST['name'],
        $_POST["surname"],
        $dateOfBirth,
        $_POST["nameFather"],
        $_POST["nameMother"],
        $_POST["IDtype"],
        $_POST["serialID"],
        $_POST["numberID"],
        $_POST["eliberatedBy"],
        $_POST["dateEliberated"],
        $_POST["valabilityDate"],
        $_POST["country"],
        $_POST["city"],
        $_POST["county"],
        $_POST["citizenship"],
        $_POST["ethnicity"],
        $_POST["maritalStatus"],
        $_POST["taraDomiciliu"],
        $_POST["localitateDomiciliu"],
        $_POST["stradaDomiciliu"],
        $_POST["numarDomiciliu"],
        $_POST["blocDomiciliu"],
        $_POST["scaraDomiciliu"],
        $_POST["etajDomiciliu"],
        $_POST["apartamentDomiciliu"],
        $_POST["codPostalDomiciliu"],
        $_POST["fixDomiciliu"],
        $_POST["mobilDomiciliu"],
        $_POST["fixParinte"],
        $_POST["mobilParinte"],
        $_POST["emailParinte"],
        $_POST["matematica"],
        $_POST["informatica"],
        $_POST["cti"],
        $_POST["matematicaPura"],
        $_POST["matematicaAplicata"],
        $_POST["matematicaInformatica"],
        $_POST["rromi"],
        $_POST["pretutindeni"],
        $_POST["olimpicAdmitere"],
        $_POST["orfan"],
        $_POST["parinteProfesor"],
        $_POST["olimpicExamen"],
        $_POST["denumireLiceu"],
        $_POST["taraLiceu"],
        $_POST["localitateLiceu"],
        $_POST["sesiuneBac"],
        $_POST["anBac"],
        $_POST["medieBac"],
        $_POST["notaMateBac"],
        $_POST["serieBac"],
        $_POST["numarBac"],
        $_POST["universitateALTS"],
        $_POST["taraALTS"],
        $_POST["localitateALTS"],
        $_POST["facultateALTS"],
        $_POST["domeniulALTS"],
        $_POST["aniALTS"],
        $_POST["anulALTS"],
        $_POST["absolventALTS"],
        $_POST["licentiatALTS"],
        $_POST["specializareALTS"],
        $_POST["serieALTS"],
        $_POST["numarALTS"],
        $_POST["emitentALTS"],
        $_POST["dataemiteriiALTS"],
        $_POST["absolvireALTS"],
        $_POST["licentaALTS"],
        $_SESSION['login_user']);

    if (false === $stmt2) {
        // again execute() is useless if you can't bind the parameters. Bail out somehow.
        echo 'nu a binduit';
    }

    if ($stmt -> execute() == TRUE) {
        echo "Information recorded successfully";
        $stmt -> close();
    } else {
        echo "esec";
    }
}
catch (mysqli_sql_exception $e) {

    echo $e->__toString();
}
echo '<div id = "sumbitArea">
            <a href="home.php">Acasă</a>
            <a href="generate.php"> Print </a>
            <a href="sendMail.php"> Send Mail </a>
      </div>';

//var_dump($_POST);
?>