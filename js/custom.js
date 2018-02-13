var alegere;
window.onload = function() {
    alegere = document.getElementById('alegereAn');
    //alert(alegere);

    if(alegere) {
        alegere.addEventListener("change", function () {
            if (alegere.value = 2017) {
                document.getElementById('tabel2017').visibility = visible;
                document.getElementById('tabel2016').visibility = hidden;
                document.getElementById('tabel2015').visibility = hidden;
                document.getElementById('tabel2014').visibility = hidden;
            }
            if (alegere.value = 2016) {
                document.getElementById('tabel2017').visibility = hidden;
                document.getElementById('tabel2016').visibility = visible;
                document.getElementById('tabel2015').visibility = hidden;
                document.getElementById('tabel2014').visibility = hidden;
            }
            if (alegere.value = 2015) {
                document.getElementById('tabel2017').visibility = hidden;
                document.getElementById('tabel2016').visibility = hidden;
                document.getElementById('tabel2015').visibility = visible;
                document.getElementById('tabel2014').visibility = hidden;
            }
            if (alegere.value = 2014) {
                document.getElementById('tabel2017').visibility = hidden;
                document.getElementById('tabel2016').visibility = hidden;
                document.getElementById('tabel2015').visibility = hidden;
                document.getElementById('tabel2014').visibility = visible;
            }
        });
    }
    //else
      //  alert('Nullwee');


    if(document.getElementsByName("matematica").checked = true){
        var x = document.getElementsByClassName("matematica");
        if(x[0].style.display === "inline"){
            x[0].style.display = "none";
        }
        else {
            x[0].style.display = "inline";
        }
    }
    if(document.getElementsByName("informatica").checked = true){
        //var x = document.getElementsByClassName("informatica");
        document.getElementsByName("informaticaSpecializare").checked = true;
        if(x[0].style.display === "inline"){
            x[0].style.display = "none";
        }
        else {
            x[0].style.display = "inline";
        }
    }
    if(document.getElementsByName("cti").checked = true){
        //var x = document.getElementsByClassName("cti");
        document.getElementsByName("ctiSpecializare").checked = true;

        if(x[0].style.display === "inline"){
            x[0].style.display = "none";
        }
        else {
            x[0].style.display = "inline";
        }
    }

};

function gogo(){
    alert(document.getElementById('selectAn').value);
    if (document.getElementById('selectAn').value === 2017) {
        document.getElementById('tabel2017').style.display = inline;
        document.getElementById('tabel2016').style.display = none;
        document.getElementById('tabel2015').style.display = none;
        document.getElementById('tabel2014').style.display = none;
    }
    if (document.getElementById('selectAn').value === 2016) {
        document.getElementById('tabel2017').style.display = none;
        document.getElementById('tabel2016').style.display = inline;
        document.getElementById('tabel2015').style.display = none;
        document.getElementById('tabel2014').style.display = none;
    }
    if (document.getElementById('selectAn').value === 2015) {
        document.getElementById('tabel2017').style.display = none;
        document.getElementById('tabel2016').style.display = none;
        document.getElementById('tabel2015').style.display = inline;
        document.getElementById('tabel2014').style.display = none;
    }
    if (document.getElementById('selectAn').value === 2014) {
        document.getElementById('tabel2017').style.display = none;
        document.getElementById('tabel2016').style.display = none;
        document.getElementById('tabel2015').style.display = none;
        document.getElementById('tabel2014').style.display = inline;
    }
}

function validare(){
    var denumireLiceu = document.getElementById("denumireLiceu");

    if(denumireLiceu.value === ''){
        denumireLiceu.className += ' inputWrong';
    } else {
        denumireLiceu.classList.remove("inputWrong");
    }
}

function coll(e){
    $('.collapse').collapse('hide');
    for(i = 1; i < document.getElementById("accordion").childElementCount; i++) {
        if (e.className == document.getElementById("accordion").childNodes[i].classList) {
            document.getElementById("accordion").childNodes[1].collapse('show');
        }
    }
}

function afiseaza(checkbox){
    var x = document.getElementsByClassName(checkbox.value);
    if(x[0].style.display === "inline"){
        x[0].style.display = "none";
    }
    else {
        x[0].style.display = "inline";
    }
}


function tabele(e){
    tabele = document.getElementsByClassName('externe');

}
