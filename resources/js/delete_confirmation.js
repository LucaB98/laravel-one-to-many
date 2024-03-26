const deleteForms = document.querySelectorAll('.delete-form');

deleteForms.forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();

        const hasConfirmed = confirm('Sei sicuro di voler eliminare questo elemento?')

        if (hasConfirmed) form.submit();
    })
})