function openNav() {
    $('.overlay').fadeIn();
    document.getElementById("rosaSidenav").style.width = "300px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    $('.overlay').fadeOut();
    document.getElementById("rosaSidenav").style.width = "0";
    document.body.style.backgroundColor = "mistyrose";
}
