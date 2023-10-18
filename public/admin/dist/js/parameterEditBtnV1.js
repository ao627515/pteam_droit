function enableEditButtons(buttonSelector, inputSelector, editIconClass = 'fa-pen', cancelIconClass =
    'fa-times-circle', editColor = 'black', cancelColor = 'red') {
    // Sélectionnez tous les boutons "btnEdit" par leur classe
    let editButtons = document.querySelectorAll(buttonSelector);

    // Parcourez tous les boutons et ajoutez un gestionnaire d'événement de clic
    editButtons.forEach(function (button) {
        // Suivi de l'état d'édition pour chaque ligne
        let isEditing = false;

        button.addEventListener('click', function () {


            let btnsCancel = document.querySelectorAll(`.${cancelIconClass}`);

            btnsCancel.forEach(function (btnCancel) {

                let rowCancel = btnCancel.closest('tr');
                let inputCancel = rowCancel.querySelector(inputSelector);
                inputCancel.setAttribute('disabled', 'true');

                btnCancel.classList.remove(cancelIconClass);
                btnCancel.classList.add(editIconClass);
                btnCancel.style.color = editColor;

            });

            // Trouvez l'élément parent (la ligne <tr>) du bouton cliqué
            let row = button.closest('tr');

            // Trouvez l'élément <input> à l'intérieur de cette ligne
            let input = row.querySelector(inputSelector);

            // Vérifiez l'état d'édition actuel
            if (isEditing) {
                // Si l'édition est active, réactivez l'attribut "disabled"
                input.setAttribute('disabled', 'true');
                // Changez l'icône en 'annuler' (FontAwesome)
                button.classList.remove(cancelIconClass);
                button.classList.add(editIconClass);
                button.style.color = editColor;
            } else {
                // Si l'édition n'est pas active, supprimez l'attribut "disabled"
                input.removeAttribute('disabled');
                // Changez l'icône en 'édition' (FontAwesome)
                button.classList.remove(editIconClass);
                button.classList.add(cancelIconClass);
                button.style.color = cancelColor;
            }

            // Inversez l'état d'édition
            isEditing = !isEditing;
        });
    });
}
