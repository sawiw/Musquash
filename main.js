formInscription = document.getElementById("testPopUpInscription");

btnInscription = document.getElementById("btnInscription");

btnInscription.addEventListener('click', function () {
    formInscription.classList.toggle("cachee");
});


function validationInscription() {
    let mdp = document.getElementById('modifMdp1');
    let mdpConfirmation = document.getElementById('modifMdp2');
    let mdpProvisoire = document.getElementById('mdpProvisoire');

    if (mdp.value !== mdpConfirmation.value) {
        alert("Attention, les mots de passe ne correspondent pas !");
        return false;
    }
    else if (mdpProvisoire.value == "") {
        alert("Saisissez le mot de passe provisoire !");
        return false;
    }
    

}


formConnexion = document.getElementById("testPopUpConnexion");

btnConnexion = document.getElementById("btnConnexion");

btnConnexion.addEventListener('click', function () {
    formConnexion.classList.toggle("cachee");
});