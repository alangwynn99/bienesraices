document.addEventListener('DOMContentLoaded', function() {
    eventListeners();

    darkMode();
});

function eventListeners() {

    // const prefiereDarkMode = window.matchMedia('(prefers-color-schema: dark)');

    // console.log(prefiereDarkMode,matches);

    // if(prefiereDarkMode.matches) {
    //     document.body.classList.add('dark-mode');
    // } else {
    //     document.body.classList.remove('dark-mode');
    // }

    // prefiereDarkMode.addEventListener('change', function () {
    //     if(prefiereDarkMode.matches) {
    //         document.body.classList.add('dark-mode');
    //     } else {
    //         document.body.classList.remove('dark-mode');
    //     }
    // })

    const mobileMenu = document.querySelector('.mobile-menu')

    mobileMenu.addEventListener('click',navegacionResponisve)
}

function darkMode() {
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    console.log('func');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    })
}

function navegacionResponisve() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');
}