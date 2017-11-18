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