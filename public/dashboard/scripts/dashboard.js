const Divwrapper = document.getElementById("wrapper");
const btnTagolle = document.getElementById("menu-toggle");
btnTagolle.addEventListener("click",function () {
    Divwrapper.classList.toggle('toggled');
    btnTagolle.classList.toggle('change');
});