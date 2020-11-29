$(document).ready(function() {
    const form=  document.getElementById('form');
    const errorElement= document.getElementById('error');
    const title= document.getElementById('title');

    form.addEventListener('submit', (e) => {

        if(title.value.length < 10){
            errorElement.innerHTML = 'titolo troppo corto';
            e.preventDefault();
        }

        if(typeof title.value !== 'string'){
            errorElement.innerHTML = 'formato titolo non supportato, non inserire numeri';
            e.preventDefault();
        }
    });
})