

document.addEventListener("DOMContentLoaded", function (event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle2 = document.getElementById("li_servicios");

        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId);

        nav.classList.add('show');

        // Validate that all variables exist
        // if(toggle){
        toggle.addEventListener('click', () => {
            // show navbar
            nav.classList.toggle('show')
            // change icon
            toggle.classList.toggle('bx-x')
            // add padding to body
            bodypd.classList.toggle('body-pd')
            // add padding to header
            headerpd.classList.toggle('body-pd')
        })

        toggle2.addEventListener('click', () => {
            if ((window.getComputedStyle(document.getElementById('submenu_servicio')).display) == "none") {
                document.getElementById('submenu_servicio').style.display = "block";
            } else {
                document.getElementById('submenu_servicio').style.display = "none";
            }
        })
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');



    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink))

    // Your code to run since DOM is loaded and ready
});
