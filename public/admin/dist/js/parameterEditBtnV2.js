document.addEventListener("DOMContentLoaded", function () {
    // Récupérer tous les éléments .formUpdate une seule fois
    var formUpdateElements = document.querySelectorAll(".formUpdate");

    // Gérer le clic sur .btnEdit (utilisation d'un gestionnaire d'événements délégué)
    document.body.addEventListener("click", function (event) {
        var target = event.target;
        if (target.classList.contains("btnEdit")) {
            var parentTR = target.closest("tr").nextElementSibling;

            formUpdateElements.forEach(function (formUpdateElement) {
                formUpdateElement.style.display = "none";
            });

            // Afficher le .formUpdate frère du tr parent de .btnEdit
            parentTR.style.display = "table-row";

            var parentTD = target.closest("td");
            var orginalContent = parentTD.innerHTML;
            document.querySelectorAll('.btnCancel').forEach(btnCancel => {
                let btnCancelParent = btnCancel.closest("td");
                if (btnCancelParent) {
                    btnCancelParent.innerHTML = orginalContent;
                }
            });
            parentTD.innerHTML = '<button class="btnCancel btn btn-secondary">Annuler</button>';

            var btnCancel = parentTD.querySelector(".btnCancel");

            btnCancel.addEventListener("click", function (event) {
                event.preventDefault();
                parentTR.style.display = "none";
                parentTD.innerHTML = orginalContent;
            });
        }
    });
});
