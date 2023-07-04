$("#data-structure-button").on("click", function(){
    
$("#collapseOne").toggleClass("show");
})
// Čekamo da se dokument učita
document.addEventListener("DOMContentLoaded", function () {
    // Pronalazimo sve collapse dugmad
    const collapseButtons = document.querySelectorAll(".btn.btn-link");

    collapseButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            // Toggling collapse stanje kada se dugme klikne
            const targetId = button.getAttribute("data-target");
            const targetElement = document.querySelector(targetId);
            targetElement.classList.toggle("show");
        });
    });
});

  
