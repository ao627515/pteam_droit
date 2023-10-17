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
