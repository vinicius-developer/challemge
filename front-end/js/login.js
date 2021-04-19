checkLocalStorageSet()

document
    .querySelector('#submit-form-login')
    .addEventListener('click', function(e) {

    e.preventDefault();

    const route = getDefaultRoute();
    const header = getDefaultHeader() 
    const info = {
        email: document.querySelector('#inputEmail').value,
        senha: document.querySelector('#inputPassword').value
    }

    axios.post(`${route}login`, info, { header })
        .then(res => {  

            window.localStorage.setItem('token', res.data.message.token)
            
            window.location.href = getUrl() + 'pages/lista/lista.html'

        })
        .catch(err => {
            const fatherElement = document.querySelector('#list-errors');
            clearItens(fatherElement)            
            createListErrors(fatherElement, err.response.data.errors, )
        })  
})
