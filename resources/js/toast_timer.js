const toast = document.getElementById('liveToast');
if (toast) setTimeout(() => {
    toast.classList.remove('show')
}, 3000)