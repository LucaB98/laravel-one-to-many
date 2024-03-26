const titleField = document.getElementById('title');
const slugField = document.getElementById('slug');

titleField.addEventListener('blur', () => {
    slugField.value = titleField.value.trim().toLowerCase().split(' ').join('-');
})