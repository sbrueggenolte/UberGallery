function openNav() {
    $('.overlay').fadeIn();
    document.getElementById("rosaSidenav").style.width = "300px";
    // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    $('.overlay').fadeOut();
    document.getElementById("rosaSidenav").style.width = "0";
    // document.body.style.backgroundColor = "mistyrose";
}

$(document).bind('cbox_open', function() {
    if (window.location.hash !== "#gallery_opened") {
        window.location.hash = "gallery_opened";
    }
});

function locationHashChanged() {
    if (window.location.hash !== "#gallery_opened" && 'block' === $('#colorbox').css('display')) {
        $('#cboxClose').click();
    }
}

window.onhashchange = locationHashChanged;