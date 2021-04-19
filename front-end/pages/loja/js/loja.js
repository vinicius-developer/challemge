document
    .querySelector('#cep')
    .addEventListener('blur', function (e) {
        const headers = getDefaultHeaderWithToken()
        const route = getDefaultRoute() + `helpers/endereco/${this.value}`

        axios.get(`${route}`, { headers })
            .then(res => {
                const fatherElementErrorCep = document.querySelector('#cep_error')
                const ids = Object.keys(res.data.message)
                const values = Object.values(res.data.message)

                clearItens(fatherElementErrorCep)
                setValues(ids, values)
            })
            .catch(err => {
                const keys = ['cep']
                const values = Object.values(err.response.data.errors)
                const fatherElementErrorCep = document.querySelector('#cep_error')

                clearItens(fatherElementErrorCep)
                createMessagesError(keys, values, ["list-group-item", "text-danger", "font-size-small"])
            })

    })

document
    .querySelector('#register-shop')
    .addEventListener('click', function (e) {
        e.preventDefault()

        const headers = getDefaultHeaderWithToken()
        const route = getDefaultRoute() + 'loja/create'
        const body = {
            "nome": document.querySelector('#nome').value,
            "cnpj": document.querySelector('#cnpj').value,
            "endereco": {
                "logradouro": document.querySelector('#logradouro').value,
                "numero": parseInt(document.querySelector('#numero').value),
                "complemento": document.querySelector('#complemento').value,
                "cep": document.querySelector('#cep').value,
                "bairro": document.querySelector('#bairro').value,
                "cidade": document.querySelector('#localidade').value,
                "UF": document.querySelector('#uf').value
            }
        }

        axios.post(route, body, { headers })
            .then(res => {
                const fatherElementMessageSuccess = document.querySelector('#message_success')

                if(fatherElementMessageSuccess.firstChild) {
                    clearItens(fatherElementMessageSuccess)
                }

                clearAllIitens(
                    [
                        '#nome_error',
                        '#cnpj_error',
                        '#uf_error',
                        '#bairro_error',
                        '#cep_error',
                        '#cidade_error',
                        '#logradouro_error',
                        '#numero_error'
                    ]
                )

                createMessageSuccess(fatherElementMessageSuccess, res.data.message, ['text-success', 'text-center', 'my-3'])

            })
            .catch(err => {

                const fatherElementMessageSuccess = document.querySelector('#message_success')

                if(fatherElementMessageSuccess.firstChild) {
                    clearItens(fatherElementMessageSuccess)
                }

                clearAllIitens(
                    [
                        '#nome_error',
                        '#cnpj_error',
                        '#uf_error',
                        '#bairro_error',
                        '#cep_error',
                        '#cidade_error',
                        '#logradouro_error',
                        '#numero_error'
                    ]
                )

                const keys = Object.keys(err.response.data.errors)
                const values = Object.values(err.response.data.errors)

                const formatedKeys = keys.map(val => {
                    const arr = val.split('.')
                    return arr[arr.length - 1].toLocaleLowerCase()
                })

                createMessagesError(formatedKeys, values, ["list-group-item", "text-danger", "font-size-small"])

            })

    })

mask('#cnpj', ['99.999.999/9999-99', '99.999.999/9999-99'])
mask("#cep", ['99999-999', '99999-999'])
checkLocalStorageUnset()
checkToken()