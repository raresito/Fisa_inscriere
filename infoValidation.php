<html>
    <title>
        infoValidation
    </title>
    <body>
        <?php
        include 'config.php';
        session_start();
        $conn = new mysqli($servername, $username, $password, $dbname);

        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected succesfully";

        $uniqueEmail = $_SESSION["login_user"];

        /*$SQL = "INSERT INTO candidat
                (uniqueEmail,
                CNP, 
                name, 
                surname, 
                dateOfBirth, 
                nameFather, 
                nameMother, 
                IDtype, 
                serialID, 
                numberID, 
                eliberatedBy, 
                dateEliberated, 
                valabilityDate, 
                country, city, 
                county, 
                citizenship, 
                ethnicity, 
                maritalStatus)
        VALUES ('$uniqueEmail',
        ".$_POST["CNP"] . ",
         '".$_POST["name"] . "',
          '".$_POST["surname"] . "',
           '".$_POST["dateOfBirth"] . "',
            '".$_POST["nameFather"] . "',
             '".$_POST["nameMother"] . "',
              '".$_POST["IDtype"] . "',
               '".$_POST["serialID"] . "',
                '".$_POST["numberID"] . "',
                 '".$_POST["eliberatedBy"] . "',
                  '".$_POST["dateEliberated"] . "',
                   '".$_POST["valabilityDate"] . "',
                    '".$_POST["country"] . "',
                     '".$_POST["city"] . "',
                      '".$_POST["county"] . "',
                       '".$_POST["citizenship"] . "',
                        '".$_POST["ethnicity"] . "',
                         '".$_POST["maritalStatus"] . "')";

*/
        $dateOfBirth = $_POST["dateOfBirth"] ;
        $SQL = "
        UPDATE candidat
          SET CNP = "."'".$_POST["CNP"]."'".",
              birthName = "."'".$_POST["birthName"]."'".",
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
              rromi = "."'". isset($_POST["rromi"]) ."'". ",
              pretutindeni = "."'". isset($_POST["pretutindeni"]) ."'". ",
              olimpicAdmitere = "."'". isset($_POST["olimpicAdmitere"]) ."'". ",
              orfan = "."'". isset($_POST["orfan"]) ."'". ",
              parinteProfesor = "."'". isset($_POST["parinteProfesor"]) ."'". ",
              olimpicExamen = "."'". isset($_POST["olimpicExamen"]) ."'". ",   
              denumireLiceu = "."'". $_POST["denumireLiceu"] ."'". "
          WHERE uniqueEmail = 'raresito@gmail.com' ";

        if($conn->query($SQL) == TRUE){
            echo "New record created successfully";
        } else {
            echo "Error: " . $SQL . "<br>" . $conn->error;
        }
        var_dump($_POST);
        ?>

        <div id = "sumbitArea">
            <a href="generate.php"> Print </a>
        </div>
    </body>
</html>