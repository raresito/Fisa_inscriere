<?php

session_start();

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
        $user =  $_SESSION['login_user'];
        //echo $emailField;
        $sqlData = "SELECT * FROM candidat WHERE uniqueEmail = '$user'";
        $this->result = mysqli_query($conn, $sqlData);
    }

    function getRow(){
        return $this->row = mysqli_fetch_array($this->result, 1);
    }
}

$personData = new getData();
$data = $personData->getRow();

if($data['informatica'] == 1){
    echo'avem informatica';
}

?>

<html>
    <head>
        <title>
            Admitere 2017 - Facultatea de Matematica si Informatica
        </title>

        <link rel="stylesheet" href="css/radioCheckbox.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </head>
    <body>

        Welcome <?php echo $_SESSION['login_user']; ?> <br>

        <div class = "buttonGroup" id="accordion">
            <button type="button" onClick = "coll(this)" class="card redCard" data-toggle="collapse" data-target="#personal">Date personale</button>
            <button type="button" onClick = "coll(this)" class="card lightBlueCard" data-toggle = "collapse" data-target="#contact">Date de contact </button>
            <button type="button" onClick = "coll(this)" class="card blueCard" data-toggle="collapse" data-target="#domeniu"> Optiuni de facultate</button>
            <button type="button" onClick = "coll(this)" class="card burgundyCard" data-toggle="collapse" data-target="#liceu"> Date despre Liceu </button>
            <button type="button" onClick = "coll(this)" class="card azureCard" data-toggle = "collapse" data-target="#specialAdmitere"> Admitere Speciala </button>
            <button type="button" onClick = "coll(this)" class="card greenCard" data-toggle = "collapse" data-target="#specialTaxaAdmitere"> Scutire de Taxa </button>
            <button type="button" onClick = "coll(this)" class="card lightBlueCard" data-toggle = "collapse" data-target="#alteStudii">Alte studii universitare </button>
        </div>

        <form name = "registerForm" action = "infoValidation.php" method = "post" id="form">

            <div id = "personal" class = "collapse centrat">
                <div class = "form-group">
                    <label> Numele de familie la nastere: </label>
                    <input type = "text" class="form-control" name = "birthName" value="<?php echo $data['birthName']; ?>">
                </div>
                <div class = "form-group">
                    <label> Numele de familie actual: </label>
                    <input type = "text" class="form-control" name = "name" value="<?php echo $data['name']; ?>" >
                </div>
                <div class = "form-group">
                    <label> Prenumele tau: </label>
                    <input type = "text" name = "surname" class="form-control" value="<?php echo $data['surname']; ?>">
                </div>
                <div class = "form-group">
                    <label> Numele tatalui: </label>
                    <input type = "text" name = "nameFather" class = "form-control" value="<?php echo $data['nameFather']; ?>">
                </div>

                <div class = "form-group">
                    <label> Numele mamei:  </label>
                    <input type = "text" name = "nameMother" class = "form-control" value="<?php echo $data['nameMother']; ?>">
                </div>

                <div class = "form-group">
                    <label> Cu ce fel de act de identitate ai vrea sa te inregistrezi ? </label> <br>
                    <input type = "radio" name = "IDtype" value = "CI" checked="checked" > Carte de identitate <!-- Va fi marcat drept CI --> <br>
                    <input type = "radio" name = "IDtype" value = "Passport"> Pasaport
                </div>

                <div class = "form-group">
                    <label> Seria de buletin  </label>
                    <input type = "text" class = "form-control" name = "serialID" pattern = "[A-Za-z]{2}" value="<?php echo $data['serialID']; ?>">
                </div>

                <div class = "form-group">
                    <label> Numar de buletin:  </label>
                    <input type = "text" class = "form-control" name = "numberID" pattern = "[0-9]{6}" value="<?php echo $data['numberID']; ?>">
                </div>
                <div class = "form-group">
                    <label> Eliberat de:  </label>
                    <input type = "text" class = "form-control" name = "eliberatedBy"  value="<?php echo $data['eliberatedBy']; ?>">
                </div>
                <div class = "form-group">
                    <label> Data eliberarii:  </label>
                    <input type = "date" class = "form-control" name = "dateEliberated" pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/" value="<?php echo $data['dateEliberated']; ?>">
                </div>
                <div class = "form-group">
                    <label> Valabil pana la:  </label>
                    <input type = "date" class = "form-control" name = "valabilityDate" pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/" value="<?php echo $data['valabilityDate']; ?>">
                </div>
                <div class = "form-group">
                    <label> CNP  </label>
                    <input type = "number" class = "form-control" name = "CNP" pattern = "[0-9]{13}" value="<?php echo $data['CNP']; ?>">
                </div>
                <div class = "form-group">
                    <label> Data nasterii:  </label>
                    <input type = "date" class = "form-control" name = "dateOfBirth" pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/" value="<?php echo $data['dateOfBirth']; ?>">
                </div>
                <div class = "form-group">
                    <label>Locul nasterii:</label> <br>
                    <label> Tara:  </label>
                    <select class = "form-control" name = "country" id = "tara">
                        <option value="AF">Afghanistan</option>
                        <option value="AX">Åland Islands</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                        <option value="AS">American Samoa</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AQ">Antarctica</option>
                        <option value="AG">Antigua and Barbuda</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AT">Austria</option>
                        <option value="AZ">Azerbaijan</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrain</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BY">Belarus</option>
                        <option value="BE">Belgium</option>
                        <option value="BZ">Belize</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermuda</option>
                        <option value="BT">Bhutan</option>
                        <option value="BO">Bolivia, Plurinational State of</option>
                        <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                        <option value="BA">Bosnia and Herzegovina</option>
                        <option value="BW">Botswana</option>
                        <option value="BV">Bouvet Island</option>
                        <option value="BR">Brazil</option>
                        <option value="IO">British Indian Ocean Territory</option>
                        <option value="BN">Brunei Darussalam</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina Faso</option>
                        <option value="BI">Burundi</option>
                        <option value="KH">Cambodia</option>
                        <option value="CM">Cameroon</option>
                        <option value="CA">Canada</option>
                        <option value="CV">Cape Verde</option>
                        <option value="KY">Cayman Islands</option>
                        <option value="CF">Central African Republic</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CX">Christmas Island</option>
                        <option value="CC">Cocos (Keeling) Islands</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comoros</option>
                        <option value="CG">Congo</option>
                        <option value="CD">Congo, the Democratic Republic of the</option>
                        <option value="CK">Cook Islands</option>
                        <option value="CR">Costa Rica</option>
                        <option value="CI">Côte d'Ivoire</option>
                        <option value="HR">Croatia</option>
                        <option value="CU">Cuba</option>
                        <option value="CW">Curaçao</option>
                        <option value="CY">Cyprus</option>
                        <option value="CZ">Czech Republic</option>
                        <option value="DK">Denmark</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominica</option>
                        <option value="DO">Dominican Republic</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egypt</option>
                        <option value="SV">El Salvador</option>
                        <option value="GQ">Equatorial Guinea</option>
                        <option value="ER">Eritrea</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Ethiopia</option>
                        <option value="FK">Falkland Islands (Malvinas)</option>
                        <option value="FO">Faroe Islands</option>
                        <option value="FJ">Fiji</option>
                        <option value="FI">Finland</option>
                        <option value="FR">France</option>
                        <option value="GF">French Guiana</option>
                        <option value="PF">French Polynesia</option>
                        <option value="TF">French Southern Territories</option>
                        <option value="GA">Gabon</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="DE">Germany</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GR">Greece</option>
                        <option value="GL">Greenland</option>
                        <option value="GD">Grenada</option>
                        <option value="GP">Guadeloupe</option>
                        <option value="GU">Guam</option>
                        <option value="GT">Guatemala</option>
                        <option value="GG">Guernsey</option>
                        <option value="GN">Guinea</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="GY">Guyana</option>
                        <option value="HT">Haiti</option>
                        <option value="HM">Heard Island and McDonald Islands</option>
                        <option value="VA">Holy See (Vatican City State)</option>
                        <option value="HN">Honduras</option>
                        <option value="HK">Hong Kong</option>
                        <option value="HU">Hungary</option>
                        <option value="IS">Iceland</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IR">Iran, Islamic Republic of</option>
                        <option value="IQ">Iraq</option>
                        <option value="IE">Ireland</option>
                        <option value="IM">Isle of Man</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italy</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japan</option>
                        <option value="JE">Jersey</option>
                        <option value="JO">Jordan</option>
                        <option value="KZ">Kazakhstan</option>
                        <option value="KE">Kenya</option>
                        <option value="KI">Kiribati</option>
                        <option value="KP">Korea, Democratic People's Republic of</option>
                        <option value="KR">Korea, Republic of</option>
                        <option value="KW">Kuwait</option>
                        <option value="KG">Kyrgyzstan</option>
                        <option value="LA">Lao People's Democratic Republic</option>
                        <option value="LV">Latvia</option>
                        <option value="LB">Lebanon</option>
                        <option value="LS">Lesotho</option>
                        <option value="LR">Liberia</option>
                        <option value="LY">Libya</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lithuania</option>
                        <option value="LU">Luxembourg</option>
                        <option value="MO">Macao</option>
                        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                        <option value="MG">Madagascar</option>
                        <option value="MW">Malawi</option>
                        <option value="MY">Malaysia</option>
                        <option value="MV">Maldives</option>
                        <option value="ML">Mali</option>
                        <option value="MT">Malta</option>
                        <option value="MH">Marshall Islands</option>
                        <option value="MQ">Martinique</option>
                        <option value="MR">Mauritania</option>
                        <option value="MU">Mauritius</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">Mexico</option>
                        <option value="FM">Micronesia, Federated States of</option>
                        <option value="MD">Moldova, Republic of</option>
                        <option value="MC">Monaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="ME">Montenegro</option>
                        <option value="MS">Montserrat</option>
                        <option value="MA">Morocco</option>
                        <option value="MZ">Mozambique</option>
                        <option value="MM">Myanmar</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="NL">Netherlands</option>
                        <option value="NC">New Caledonia</option>
                        <option value="NZ">New Zealand</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Niger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk Island</option>
                        <option value="MP">Northern Mariana Islands</option>
                        <option value="NO">Norway</option>
                        <option value="OM">Oman</option>
                        <option value="PK">Pakistan</option>
                        <option value="PW">Palau</option>
                        <option value="PS">Palestinian Territory, Occupied</option>
                        <option value="PA">Panama</option>
                        <option value="PG">Papua New Guinea</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Peru</option>
                        <option value="PH">Philippines</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PL">Poland</option>
                        <option value="PT">Portugal</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="RE">Réunion</option>
                        <option value="RO" selected = "selected">Romania</option>
                        <option value="RU">Russian Federation</option>
                        <option value="RW">Rwanda</option>
                        <option value="BL">Saint Barthélemy</option>
                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                        <option value="KN">Saint Kitts and Nevis</option>
                        <option value="LC">Saint Lucia</option>
                        <option value="MF">Saint Martin (French part)</option>
                        <option value="PM">Saint Pierre and Miquelon</option>
                        <option value="VC">Saint Vincent and the Grenadines</option>
                        <option value="WS">Samoa</option>
                        <option value="SM">San Marino</option>
                        <option value="ST">Sao Tome and Principe</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="SN">Senegal</option>
                        <option value="RS">Serbia</option>
                        <option value="SC">Seychelles</option>
                        <option value="SL">Sierra Leone</option>
                        <option value="SG">Singapore</option>
                        <option value="SX">Sint Maarten (Dutch part)</option>
                        <option value="SK">Slovakia</option>
                        <option value="SI">Slovenia</option>
                        <option value="SB">Solomon Islands</option>
                        <option value="SO">Somalia</option>
                        <option value="ZA">South Africa</option>
                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                        <option value="SS">South Sudan</option>
                        <option value="ES">Spain</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="SD">Sudan</option>
                        <option value="SR">Suriname</option>
                        <option value="SJ">Svalbard and Jan Mayen</option>
                        <option value="SZ">Swaziland</option>
                        <option value="SE">Sweden</option>
                        <option value="CH">Switzerland</option>
                        <option value="SY">Syrian Arab Republic</option>
                        <option value="TW">Taiwan, Province of China</option>
                        <option value="TJ">Tajikistan</option>
                        <option value="TZ">Tanzania, United Republic of</option>
                        <option value="TH">Thailand</option>
                        <option value="TL">Timor-Leste</option>
                        <option value="TG">Togo</option>
                        <option value="TK">Tokelau</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad and Tobago</option>
                        <option value="TN">Tunisia</option>
                        <option value="TR">Turkey</option>
                        <option value="TM">Turkmenistan</option>
                        <option value="TC">Turks and Caicos Islands</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UG">Uganda</option>
                        <option value="UA">Ukraine</option>
                        <option value="AE">United Arab Emirates</option>
                        <option value="GB">United Kingdom</option>
                        <option value="US">United States</option>
                        <option value="UM">United States Minor Outlying Islands</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistan</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VE">Venezuela, Bolivarian Republic of</option>
                        <option value="VN">Viet Nam</option>
                        <option value="VG">Virgin Islands, British</option>
                        <option value="VI">Virgin Islands, U.S.</option>
                        <option value="WF">Wallis and Futuna</option>
                        <option value="EH">Western Sahara</option>
                        <option value="YE">Yemen</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabwe</option>
                    </select>
                </div>
                <div class = "form-group">
                    <label>Localitate:</label>
                    <input type = "text" class = "form-control" name = "city" value="<?php echo $data['city']; ?>">
                </div>
                <div class = "form-group">
                    <label> Judet:  </label>
                    <input type = "text" class = "form-control" name = "county" value="<?php echo $data['county']; ?>">
                </div>
                <div class = "form-group">
                    <label> Cetatenie  </label>
                    <input type = "text" class = "form-control" name = "citizenship" value="<?php echo $data['citizenship']; ?>">
                </div>
                <div class = "form-group">
                    <label> Etnie  </label>
                    <input type = "text" class = "form-control" name = "ethnicity" value="<?php echo $data['ethnicity']; ?>">
                </div>
                <div class = "form-group">
                    <label> Starea civila  </label>
                    <input type = "text" class = "form-control" name = "maritalStatus" value="<?php echo $data['maritalStatus']; ?>">
                </div>
                <div class = "form-group">
                    <labeL>Email valid: </labeL>
                    <input type="text" class = "form-control" name = "uniqueEmail" disabled = "disabled" value="<?php echo $_SESSION['login_user']; ?>">
                </div>

            </div>

            <div id = "contact" class="collapse centrat">
                <label> Domiciliul stabil (din buletin)</label>
                <div class = "form-group">
                    <label> Tara </label>
                    <input
                            type = "text"
                            class="form-control"
                            name = "taraDomiciliu"
                            value="<?php echo $data['taraDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Localitate </label>
                    <input
                            type = "text"
                            class="form-control"
                            name = "localitateDomiciliu"
                            value="<?php echo $data['localitateDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Strada </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "stradaDomiciliu"
                            value="<?php echo $data['stradaDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Nr. </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "numarDomiciliu"
                            value="<?php echo $data['numarDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Bloc </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "blocDomiciliu"
                            value="<?php echo $data['blocDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Scara </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "scaraDomiciliu"
                            value="<?php echo $data['scaraDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Etaj </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "etajDomiciliu"
                            value="<?php echo $data['etajDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Apartament </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "apartamentDomiciliu"
                            value="<?php echo $data['apartamentDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Judet/Sector </label>
                    <select class = "form-control" name="judete">
                        <option value="0">Alege Judet</option>
                        <option value="Alba">Alba</option>
                        <option value="Arad">Arad</option>
                        <option value="Arges">Arges</option>
                        <option value="Bacau">Bacau</option>
                        <option value="Bihor">Bihor</option>
                        <option value="Bistrita Nasaud">Bistrita Nasaud</option>
                        <option value="Botosani">Botosani</option>
                        <option value="Brasov">Brasov</option>
                        <option value="Braila">Braila</option>
                        <option value="Bucuresti">Bucuresti</option>
                        <option value="Buzau">Buzau</option>
                        <option value="Caras Severin">Caras Severin</option>
                        <option value="Calarasi">Calarasi</option>
                        <option value="Cluj">Cluj</option>
                        <option value="Constanta">Constanta</option>
                        <option value="Covasna">Covasna</option>
                        <option value="Dambovita">Dambovita</option>
                        <option value="Dolj">Dolj</option>
                        <option value="Galati">Galati</option>
                        <option value="Giurgiu">Giurgiu</option>
                        <option value="Gorj">Gorj</option>
                        <option value="Harghita">Harghita</option>
                        <option value="Hunedoara">Hunedoara</option>
                        <option value="Ialomita">Ialomita</option>
                        <option value="Iasi">Iasi</option>
                        <option value="Ilfov">Ilfov</option>
                        <option value="Maramures">Maramures</option>
                        <option value="Mehedinti">Mehedinti</option>
                        <option value="Mures">Mures</option>
                        <option value="Neamt">Neamt</option>
                        <option value="Olt">Olt</option>
                        <option value="Prahova">Prahova</option>
                        <option value="Satu Mare">Satu Mare</option>
                        <option value="Salaj">Salaj</option>
                        <option value="Sibiu">Sibiu</option>
                        <option value="Suceava">Suceava</option>
                        <option value="Teleorman">Teleorman</option>
                        <option value="Timis">Timis</option>
                        <option value="Tulcea">Tulcea</option>
                        <option value="Vaslui">Vaslui</option>
                        <option value="Valcea">Valcea</option>
                        <option value="Vrancea">Vrancea</option>
                    </select>
                </div>
                <div class = "form-group">
                    <label> Cod Postal </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "codPostalDomiciliu"
                            value="<?php echo $data['codPostalDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Telefon fix </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "fixDomiciliu"
                            value="<?php echo $data['fixDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Mobil </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "mobilDomiciliu"
                            value="<?php echo $data['mobilDomiciliu']; ?>">
                </div>
                <div class = "form-group">
                    <label> Date de contact alternative (parinte, tutore etc.) </label> <br>
                    <label> Telfon fix </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "fixParinte"
                            value="<?php echo $data['fixParinte']; ?>">
                </div>
                <div class = "form-group">
                    <label> Telefon mobil </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "mobilParinte"
                            value="<?php echo $data['mobilParinte']; ?>">
                </div>
                <div class = "form-group">
                    <label> Email: </label>
                    <input
                            type = "text"
                            class= "form-control"
                            name = "emailParinte"
                            value="<?php echo $data['emailParinte']; ?>">
                </div>
            </div>

            <div id = "domeniu" class="collapse centrat">
                <form>
                    <div class="form-group">
                        <label for="domeniu">Domeniul:</label>
                        <div class="checkbox">
                            <label>
                                <input
                                        type="checkbox"
                                        name="matematica"
                                        onchange="afiseaza(this)"
                                        value="matematica"
                                        <?php if($data['matematica'] == 1) echo 'checked'; ?> >
                                Matematica
                            </label>
                        </div>
                        <div class="checkbox">
                            <label><input
                                        type="checkbox"
                                        name="informatica"
                                        onchange="afiseaza(this)"
                                        value="informatica"
                                        <?php if($data['informatica'] == 1) echo 'checked'; ?>>
                                Informatica</label>
                        </div>
                        <div class="checkbox">
                            <label><input
                                        type="checkbox"
                                        name="cti"
                                        onchange="afiseaza(this)"
                                        value="cti"
                                        <?php if($data['cti'] == 1) echo 'checked'; ?>>
                                CTI</label>
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

            <div id = "liceu" class = "collapse centrat">
                <form id = "liceuForm">
                    <div class = "form-group">
                        <label> Denumire: </label>
                        <input type = "text" name = "denumireLiceu" class="form-control" id = "denumireLiceu" value = "<?php echo $data['denumireLiceu']; ?>">
                    </div>

                    <div class = "form-group">
                        <!--<label> Tara: </label>
                        <input type = "text" class="form-control" id = "taraLiceu">-->
                        <select class="input-medium bfh-countries" data-country="US"></select>
                    </div>

                    <div class = "form-group">
                        <label> Localitatea: </label>
                        <input type = "text" name = "localitateLiceu" class="form-control" id = "localitateLiceu">
                    </div>


                    <div class = "">
                        <div class = "form-row">
                            <label> Am sustinut Bacul in sesiunea: </label>
                            <input type = "text" class="form-control" id = "sesiuneBac">
                        </div>
                        <div class="form-row">
                            <label> anul </label>
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

            <div id = "specialAdmitere" class = "collapse centrat">
                <div class = "form-group">
                    <label for="specialAdmitere">Statut special la admitere </label>
                    <div class = "checkbox">
                        <label><input type = "checkbox" name = "rromi" value = "1"> Locuri pentru rromi </label>
                    </div>
                    <div class = "checkbox">
                        <label><input type = "checkbox" name = "pretutindeni"> Locuri pentru romani de pretutindeni </label>
                    </div>
                    <div class = "checkbox">
                        <label><input type = "checkbox" name = "olimpicAdmitere"> Locuri pentru olimpici, admitere fara examen </label>
                    </div>
                </div>
            </div>

            <div id = "specialTaxaAdmitere" class = "collapse centrat">
                <div class = "form-group">
                    <label for="specialTaxaAdmitere">Statut special pentru scutirea de plata a taxei de admitere </label>
                    <div class = "checkbox">
                        <label><input type = "checkbox" name = "orfan"> Orfan de ambii părinți sau provenit din casă de copii sau plasament familial </label>
                    </div>
                    <div class = "checkbox">
                        <label><input type = "checkbox" name = "parinteProfesor"> Părinte cadru didactic sau angajat la Universitatea din București </label>
                    </div>
                    <div class = "checkbox">
                        <label><input type = "checkbox" name = "olimpicExamen"> Olimpic, admis fără examen </label>
                    </div>
                </div>
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

            <button type = "submit" form = "form" onclick="validare()" >Submit</button>
        </form>
    <?php var_dump($_SESSION); ?>
    </body>
</html>