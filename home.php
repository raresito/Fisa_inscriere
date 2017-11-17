<?php

session_start();

?>

<html>
    <head>
        <title>
            Admitere 2017 - Facultatea de Matematica si Informatica
        </title>

        <link rel="stylesheet" href="css/radioCheckbox.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>

        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>

        Welcome <?php echo $_SESSION['login_user']; ?> <br>

        <div class = "buttonGroup" id="accordion">
            <button type="button" onClick = "coll(this)" class="card redCard" data-toggle="collapse" data-target="#personal">Date personale</button>
            <button type="button" onClick = "coll(this)" class="card blueCard" data-toggle="collapse" data-target="#domeniu"> Optiuni de facultate</button>
            <button type="button" onClick = "coll(this)" class="card burgundyCard" data-toggle="collapse" data-target="#liceu"> Date despre Liceu </button>
            <button type="button" onClick = "coll(this)" class="card azureCard" data-toggle = "collapse" data-target="#specialAdmitere"> Admitere Speciala </button>
            <button type="button" onClick = "coll(this)" class="card greenCard" data-toggle = "collapse" data-target="#specialTaxaAdmitere"> Scutire de Taxa </button>
            <button type="button" onClick = "coll(this)" class="card lightBlueCard" data-toggle = "collapse" data-target="#alteStudii">Alte studii universitare </button>
        </div>

        <div id = "personal" class = "collapse centrat">
            <form name="registerForm" action = "infoValidation.php" method = "post">
                <div class = "form-group">
                    <label> Numele de familie la nastere: </label>
                    <input type = "text" class="form-control" name = "name" pattern = "[A-Za-z]{3,30}">
                </div>
                <div class = "form-group">
                    Numele de familie actual: <input type = "text" name = "actualName" pattern = "[A-Za-z]{3,30}" required> <br>
                    <!--Initiala tatalui preluata din nume. -->
                    Prenumele tau: <input type = "text" name = "surname" pattern = "[A-Za-z]{3,30}"> <br>
                    Numele tatalui: <input type = "text" name = "nameFather" pattern = "[A-Za-z]{3,30}"> <br>
                    Numele mamei: <input type = "text" name = "nameMother" pattern = "[A-Za-z]{3,30}"> <br>
                    Cu ce fel de act de identitate ai vrea sa te inregistrezi ? <br>
                    <input type = "radio" name = "IDtype" value = "CI" checked="checked" > Carte de identitate <!-- Va fi marcat drept CI -->
                    <input type = "radio" name = "IDtype" value = "Passport"> Pasaport <br>
                    Seria de buletin: <input type = "text" name = "serialID" pattern = "[A-Za-z]{2}">
                    Numar de buletin: <input type = "text" name = "numberID" pattern = "[0-9]{6}"> <br>
                    Eliberat de: <input type = "text" name = "eliberatedBy" pattern="[A-Za-z0-9]{3,30}">
                    Data eliberarii: <input type = "date" name = "dateEliberated" pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/">s
                    Valabil pana la: <input type = "date" name = "valabilityDate" pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"><br>
                    CNP <input type = "number" name = "CNP" pattern = "[0-9]{13}"><br>
                    Data nasterii: <input type = "date" name = "dateOfBirth" pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"><br>
                    Locul nasterii:<br>
                    Tara: <input type = "text" name = "country" pattern="[A-Za-z]{3,50}"><br>
                    Tara:
                    <select>
                        <option> Romania </option>
                        <option> Bulgaria </option>
                        <option> Spania </option>
                        <option> Italia </option>
                    </select>
                    Localitate: <input type = "text" name = "city" pattern = "^[a-zA-Z -,-]*$"><br>
                    Judet: <input type = "text" name = "county" pattern = "[A-Za-z0-9]{3,30}"><br>
                    Cetatenie <input type = "text" name = "citizenship"> <br>
                    Etnie <input type = "text" name = "ethnicity"> <br>
                    Starea civila <input type = "text" name = "maritalStatus"> <br>

                    Email valid: <input type="text" name = "uniqueEmail"> <br>
                </div>
                <div>
                    <input type="submit">
                </div>
            </form>
        </div>

        <div id = "domeniu" class="collapse">
            <form>
                <div class="form-group">
                    <label for="domeniu">Domeniul:</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" onchange="afiseaza(this)" value="matematica">
                            Matematica
                        </label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" onchange="afiseaza(this)" value="informatica">Informatica</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" onchange="afiseaza(this)" value="cti">CTI</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="specializare">Specializare</label>
                    <div class = "">
                        <div class="matematica funkyradio" >
                            <div class="funkyradio-primary">
                                <input type="radio" name="radio" id="radio1" />
                                <label for="radio1">Matematica pura</label>
                            </div>
                            <div class="funkyradio-primary">
                                <input type="radio" name="radio" id="radio2" />
                                <label for="radio2">Matematica aplicata</label>
                            </div>
                            <div class="funkyradio-primary">
                                <input type="radio" name="radio" id="radio3" />
                                <label for="radio3">Matematica informatica</label>
                            </div>
                            <a href="#" data-toggle="popover" title="Specializarea" data-content="Alegerea are doar rol statistic. Alegerea se face la inceputul anului II.">
                                <button type = "button" class = "btn btn-info"> Info </button>
                            </a><br>
                        </div>
                        <div class="checkbox informatica" >
                            <label><input type="checkbox" value="" disabled>Informatica</label><br>
                        </div>
                        <div class="checkbox cti" >
                            <label><input type="checkbox" value="" disabled>Calculatoare si Tehnologia Informatiei </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div id = "liceu" class = "collapse">
            <form id = "liceuForm">
                <div class = "form-group">
                    <label> Denumire: </label>
                    <input type = "text" class="form-control" id = "denumireLiceu">
                </div>

                <div class = "form-group">
                    <!--<label> Tara: </label>
                    <input type = "text" class="form-control" id = "taraLiceu">-->
                    <select class="input-medium bfh-countries" data-country="US"></select>
                </div>

                <div class = "form-group">
                    <label> Localitatea: </label>
                    <input type = "text" class="form-control" id = "localitateLiceu">
                </div>


                <div class = "form-row">
                    <div class = "col">
                        <label> Am sustinut Bacul in sesiunea: </label>
                        <input type = "text" class="form-control" id = "sesiuneBac">
                    </div>
                    <div class="col">
                        <!--<label> anul </label>-->
                        <input type = "number" class="form-control" id = "anBac">
                    </div>
                </div>

                <div class = "form-group">
                    <label> Media la Bac: </label>
                    <input type = "number" class="form-control" id = "medieBac">
                </div>

                <div class = "form-group">
                    <label> Nota la bac la Matematica </label>
                    <input type = "text" class="form-control" id = "notaMateBac">
                </div>

                <div class = "form-group">
                    <label> Diploma de bac: Serie:</label>
                    <input type = "text" class="form-control" id = "serieBac">
                    <label> Numar: </label>
                    <input type="number" class="form-control" id ="numarBac">
                </div>
            </form>
        </div>

        <div id = "specialAdmitere" class = "collapse">
            <form>
                <div class = "form-group">
                    <label for="specialAdmitere">Statut special la admitere </label>
                    <div class = "checkbox">
                        <label><input type = "checkbox" value = "rromi"> Locuri pentru rromi </label>
                    </div>
                    <div class = "checkbox">
                        <label><input type = "checkbox" value = "rromi"> Locuri pentru romani de pretutindeni </label>
                    </div>
                    <div class = "checkbox">
                        <label><input type = "checkbox" value = "rromi"> Locuri pentru olimpici, admitere fara examen </label>
                    </div>
                </div>
            </form>
        </div>

        <div id = "specialTaxaAdmitere" class = "collapse">
            <form>
                <div class = "form-group">
                    <label for="specialTaxaAdmitere">Statut special pentru scutirea de plata a taxei de admitere </label>
                    <div class = "checkbox">
                        <label><input type = "checkbox" value = "rromi"> Orfan de ambii părinți sau provenit din casă de copii sau plasament familial </label>
                    </div>
                    <div class = "checkbox">
                        <label><input type = "checkbox" value = "rromi"> Părinte cadru didactic sau angajat la Universitatea din București </label>
                    </div>
                    <div class = "checkbox">
                        <label><input type = "checkbox" value = "rromi"> Olimpic, admis fără examen </label>
                    </div>
                </div>
            </form>
        </div>

        <div id = "alteStudii" class="collapse centrat">
            <form>
                <label for="alteStudii"> Informatii despre alte studii universitre </label>
                <div class = "form-group">
                    <label> Universitatea: </label>
                    <input type = "text" class="form-control" name = "universitateALTS">
                </div>

                <div class = "form-group">
                    <label> Tara: </label>
                    <input type = "text" class="form-control" name = "taraALTS">
                </div>

                <div class = "form-group">
                    <label> Localitatea: </label>
                    <input type = "text" class="form-control" name = "localitateALTS">
                </div>

                <div class = "form-group">
                    <label> Facultatea:</label>
                    <input type = "text" class="form-control" name = "facultateALTS">
                </div>

                <div class = "form-group">
                    <label> Domeniul: </label>
                    <input type = "text" class="form-control" name = "denumireLiceu">
                </div>

                <div class = "form-group">
                    <label> Numarul de ani finantati de la buget: </label>
                    <input type = "text" class="form-control" name = "aniALTS">
                </div>

                <div class = "form-group">
                    <label> Student anul: </label>
                    <input type = "text" class="form-control" name = "anulALTS">
                </div>

                <div class = "form-group">
                    <label> Absolvent fără diplomă de licență în anul: </label>
                    <input type = "text" class="form-control" name = "absolventALTS">
                </div>

                <div class = "form-group">
                    <label> Licențiat în anul:</label>
                    <input type = "text" class="form-control" name = "licentiatALTS">
                </div>

                <div class = "form-group">
                    <label>Diploma de licenta in specializarea:</label>
                    <input type = "text" class="form-control" name = "specializareaALTS">
                </div>

                <div class = "form-group">
                    <label>Serie:</label>
                    <input type = "text" class="form-control" name = "serieALTS">
                </div>

                <div class = "form-group">
                    <label>Numar:</label>
                    <input type = "text" class="form-control" name = "numarALTS">
                </div>

                <div class = "form-group">
                    <label> Emisa de: </label>
                    <input type = "text" class="form-control" name = "emitentALTS">
                </div>

                <div class = "form-group">
                    <label>Data emiterii:</label>
                    <input type = "text" class="form-control" name = "dataEmiteriiALTS">
                </div>

                <div class = "form-group">
                    <label>Media generala de absolvire:</label>
                    <input type = "text" class="form-control" name = "absolvireALTS">
                </div>

                <div class = "form-group">
                    <label>Media la examenul de licenta:</label>
                    <input type = "text" class="form-control" name = "licentaALTS">
                </div>
            </form>
        </div>

        <div id = "sumbitArea">
            <a href="generate.php"> Print </a>
        </div>

        <div>
            <button type = "button" onclick="validare()" >Submit</button>
        </div>

    </body>
</html>