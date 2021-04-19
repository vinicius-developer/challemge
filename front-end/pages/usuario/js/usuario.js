document
    .querySelector('#register-user')
    .addEventListener('click', function(e) {
        e.preventDefault();

        const headers = getDefaultHeaderWithToken();
        const route = getDefaultRoute() + 'usuario/create';
        const body = {
            "id_lojas": document.querySelector("#lojas").value,
            "nome": document.querySelector("#nome").value,
            "email": document.querySelector("#email").value,
            "senha": document.querySelector("#senha").value,
            "senha_confirmation" : document.querySelector("#confirme_senha").value,
            "telefones": getTelefones()
        }

        axios.post(route, body, { headers })
            .then(res => {
                const fatherElementMessageSuccess = document.querySelector('#message_success');
                
                clearAllIitens(['#nome_error', '#idlojas_error', '#email_error', '#senha_error', '#telefones_error'])
                clearValues(['#nome', '#lojas', '#email', '#senha', '#confirme_senha'])
                clearAllValues(['.telefone'])

                if(fatherElementMessageSuccess.firstChild) {
                    clearItens(fatherElementMessageSuccess)
                }

                createMessageSuccess(fatherElementMessageSuccess, res.data.message, ['text-success', 'text-center', 'my-3'])

            })
            .catch(err => {
                const fatherElementMessageSuccess = document.querySelector('#message_success');

                if(fatherElementMessageSuccess.firstChild) {
                    clearItens(fatherElementMessageSuccess)
                }

                clearAllIitens(['#nome_error', '#idlojas_error', '#email_error', '#senha_error', '#telefones_error'])

                const keys = Object.keys(err.response.data.errors)
                const values = Object.values(err.response.data.errors)

                createMessagesError(keys, values, ["list-group-item", "text-danger", "font-size-small"])
            })

    })

document
    .querySelector('#add-telephone')
    .addEventListener('click', function(e) {
        e.preventDefault()

        const fatherElement = document.querySelector('#box-telefones')

        const boxInputs = document.createElement('div')
        const classesBoxInputs = ['d-flex', 'flex-column', 'my-2', 'box-input-telephone']
        classesBoxInputs.map(value => {boxInputs.classList.add(value)})

        const labelTelefone = document.createElement('label')
        const textLabelTelefone = document.createTextNode('Telefone*')
        labelTelefone.setAttribute('for', 'telefone')
        labelTelefone.append(textLabelTelefone)

        const inputTelefone = document.createElement('input')
        const classeInputTelefone = ['telefone', 'input-form-style', 'border']
        classeInputTelefone.map(value => inputTelefone.classList.add(value))
        inputTelefone.setAttribute('type', 'text')
        inputTelefone.setAttribute('arial-label', 'Telefone')

        boxInputs.append(labelTelefone)
        boxInputs.append(inputTelefone)

        fatherElement.append(boxInputs)

        maskAll('.telefone', ['(99) 99999-9999', '(99) 99999-9999'])
    })

document
    .querySelector('#remove-telephone')
    .addEventListener('click', function(e){

        e.preventDefault()
        const fatherElement = document.querySelector('#box-telefones')

        if(fatherElement.childNodes.length > 3) {
            fatherElement.removeChild(fatherElement.lastChild)
        }
    })

function getLojas() {

    const headers = getDefaultHeaderWithToken()
    
    const route = getDefaultRoute() + 'loja/list'
    
    axios.get(route, { headers } )
        .then(res => {
            const fatherElement = document.querySelector('#lojas')
            createOptions(fatherElement, res.data.message)
        })
        .catch(err => {
            console.error("Não foi possível concluir a busca das lojas")
        })
}

function getTelefones() {
    const telefones = document.querySelectorAll('.telefone')
    arr = []

    for(let i = 0; i < telefones.length; i++) {
        arr.push(telefones[i].value)
    }

    return arr
}


maskAll('.telefone', ['(99) 99999-9999', '(99) 99999-9999'])
checkToken()
getLojas()