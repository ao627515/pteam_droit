document.addEventListener('DOMContentLoaded', () => {
    const btnCreate = document.getElementById('btnCreate');
    const cardCreate = document.getElementById('cardCreate');

    btnCreate.addEventListener('click', function () {

        const bool = cardCreate.style.display == 'block' ? true : false;
        const search = document.querySelector('input[name="search"]');
        console.log(search);
        if (bool) {
            btnCreate.textContent = 'Créer';
            cardCreate.style.display = 'none';
            search.removeAttribute('disabled');
        } else {
            cardCreate.style.display = 'block';
            btnCreate.textContent = 'Annuler';
            search.setAttribute('disabled', 'true');
        }
    });
});
