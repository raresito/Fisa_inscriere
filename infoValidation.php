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

        $uniqueEmail = $_POST["uniqueEmail"];
        echo $_POST["uniqueEmail"];

        $SQL = "INSERT INTO candidat 
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


        if($conn->query($SQL) == TRUE){
            echo "New record created successfully";
        } else {
            echo "Error: " . $SQL . "<br>" . $conn->error;
        }
        var_dump($_POST);
        ?>

        <div id = "sumbitArea">
            <a href="test.php"> Print </a>
        </div>
    </body>
</html>