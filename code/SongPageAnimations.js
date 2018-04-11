
var desktopMode = true;
var navbar = document.getElementById("navbar");
var floatingHeaders = document.getElementById("headers");
var floatingTopButton = document.getElementById("backTop");
var searchInput = document.getElementById("myInput");
var colSearch = document.getElementById("colSearch");
var minimize = document.getElementById("minimize");

var sticky = navbar.offsetTop;

function isDesktop() {
        desktopMode = document.body.clientWidth >= 560 && screen.availWidth >= 560;
        return desktopMode;
}

function stickyNav() {
        if (window.pageYOffset >= sticky ) {
                navbar.classList.add("sticky");
                floatingHeaders.classList.remove("hide");
                floatingTopButton.classList.remove("hide");
        } else {
                navbar.classList.remove("sticky");
                floatingHeaders.classList.add("hide");
                floatingTopButton.classList.add("hide");
        }
}

function makeSticky() {
        if(isDesktop()) {
                navbar.classList.add("sticky");
                floatingHeaders.classList.remove("hide");
                floatingTopButton.classList.remove("hide");
                searchInput.classList.remove("hide");
                colSearch.classList.remove("hide");
                window.onscroll = null;
        } else {
                window.onscroll = function() {stickyNav()};
                stickyNav();
        }
}

makeSticky();

function hideSearch() {
        searchInput.classList.toggle("hide");
        colSearch.classList.toggle("hide");
                
        if (minimize.innerHTML === "Show Search") {
                minimize.innerHTML = "Hide Search";
        } else {
                minimize.innerHTML = "Show Search";
        }
}

function debounce(func){
        var timer;
        return function(event){
                if(timer) clearTimeout(timer);
                timer = setTimeout(func,50,event);
        };
}

window.addEventListener("resize",debounce(function(e){
        makeSticky();
}));