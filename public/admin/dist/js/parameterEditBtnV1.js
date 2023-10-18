document.addEventListener('DOMContentLoaded', () => {
    // Sélectionnez tous les boutons "btnEdit" par leur classe
    var editButtons = document.querySelectorAll('.btnEdit');

    // Parcourez tous les boutons et ajoutez un gestionnaire d'événement de clic
    editButtons.forEach(function (button) {
        // Suivi de l'état d'édition pour chaque ligne
        var isEditing = false;

        button.addEventListener('click', function () {
            // Trouvez l'élément parent (la ligne <tr>) du bouton cliqué
            var row = button.closest('tr');

            // Trouvez l'élément <input> à l'intérieur de cette ligne
            var input = row.querySelector('input[type="text"]');

            // Vérifiez l'état d'édition actuel
            if (isEditing) {
                // Si l'édition est active, réactivez l'attribut "disabled"
                input.setAttribute('disabled', 'true');
                // Changez l'icône en 'annuler' (FontAwesome)
                button.classList.remove('fa-times-circle');
                button.classList.add('fa-pencil');
                button.style.color = "black";
            } else {
                // Si l'édition n'est pas active, supprimez l'attribut "disabled"
                input.removeAttribute('disabled');
                // Changez l'icône en 'édition' (FontAwesome)
                button.classList.remove('fa-pencil');
                button.classList.add('fa-times-circle');
                button.style.color = "red";
            }

            // Inversez l'état d'édition
            isEditing = !isEditing;
        });
    });
});


/*

document.addEventListener("DOMContentLoaded", function () {
    // Récupérer tous les éléments .formUpdate une seule fois
    var formUpdateElements = document.querySelectorAll(".formUpdate");

    // Récupérer tous les éléments .btnEdit une seule fois
    var btnEditElements = document.querySelectorAll(".btnEdit");

    btnEditElements.forEach(function (btnEditElement) {

        btnEditElement.addEventListener("click", function () {
            // Cacher tous les éléments .formUpdate
            formUpdateElements.forEach(function (formUpdateElement) {
                formUpdateElement.style.display = "none";
            });

            // Afficher le .formUpdate frère du tr parent de .btnEdit
            var parentTR = this.closest("tr").nextElementSibling;
            parentTR.style.display = "table-row";

            // Remplacer le contenu du td parent de .btnEdit par un bouton Annuler
            var parentTD = this.closest("td");
            let orginalContent = parentTD.innerHTML;

            // Restaurer le contenu d'origine du td parent des boutons "Annuler"
            document.querySelectorAll('.btnCancel').forEach(btnCancel => {
                let btnCancelParent = btnCancel.closest("td");
                if (btnCancelParent) {
                    btnCancelParent.innerHTML = orginalContent;
                }
            });

            parentTD.innerHTML = '<button class="btnCancel btn btn-secondary">Annuler</button>';

            // Gérer le clic sur le bouton Annuler
            var btnCancel = parentTD.querySelector(".btnCancel");

            btnCancel.addEventListener("click", function (event) {
                event.preventDefault();

                // Cacher le .formUpdate
                parentTR.style.display = "none";

                // Rétablir le bouton "Edit" dans le td parent
                parentTD.innerHTML = orginalContent; // Restaure le bouton "Edit"
            });
        });
    });
});


*/
