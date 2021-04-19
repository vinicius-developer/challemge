checkLocalStorageUnset()
checkToken()

function listFunc(idLoja = 0) {
    const headers = getDefaultHeaderWithToken()
    const route = idLoja ? getDefaultRoute() + `usuario/list/${idLoja}` : getDefaultRoute() + `usuario/list/`

    axios.get(route, { headers })
        .then(res => {
            const fatherElement = document.querySelector('#body-table')

            clearItens(fatherElement)

            createRows(res.data.message, fatherElement)
        })
        .catch(err => {
            console.error(err.response.data.message)
        })

}


function createRows(info, fatherElement) {
    info.map((linesContent) => {
        const line = document.createElement('tr')
        line.classList.add('style-line-table')
        line.classList.add('border')

        const columnName = document.createElement('th')
        const createTextName = document.createTextNode(linesContent.nome_usuario)
        const columnEmail = document.createElement('th')
        const createTextEmail = document.createTextNode(linesContent.email)
        const columnNomeLoja = document.createElement('th')
        const createTextNomeLoja = document.createTextNode(linesContent.nome_loja)
        const columnTelefone = document.createElement('th')
        const stringTelefone = linesContent.telefone.join(' | ')
        const createTextTelefone = document.createTextNode(stringTelefone)
        const columnAlter = document.createElement('th')
        const buttonAlter = document.createElement('button')
        const textButtonAlter = document.createTextNode('Alt')

        columnName.appendChild(createTextName)
        columnEmail.appendChild(createTextEmail)
        columnNomeLoja.appendChild(createTextNomeLoja)
        columnTelefone.appendChild(createTextTelefone)

        columnName.classList = 'm-2 p-2 font-size-small'
        columnEmail.classList = 'm-2 p-2 font-size-small'
        columnNomeLoja.classList = 'm-2 p-2 font-size-small'
        columnTelefone.classList = 'm-2 p-2 font-size-small'
        columnAlter.classList = 'm-2 p-2 font-size-small'

        buttonAlter.setAttribute('onclick', `modalAlt(${linesContent.id_usuarios})`)
        buttonAlter.classList = 'color-button'

        buttonAlter.appendChild(textButtonAlter)
        columnAlter.appendChild(buttonAlter)

        line.appendChild(columnName)
        line.appendChild(columnEmail)
        line.appendChild(columnNomeLoja)
        line.appendChild(columnTelefone)
        line.appendChild(buttonAlter)

        fatherElement.appendChild(line)
    })
}

document
    .querySelector('#filtro')
    .addEventListener('change', function (e) {
        listFunc(this.value)
    })


function getLojas() {
    const headers = getDefaultHeaderWithToken()

    const route = getDefaultRoute() + 'loja/list'

    axios.get(route, { headers })
        .then(res => {
            const fatherElement = document.querySelector('#lojas')
            const filter = document.querySelector('#filtro')
            createOptions(fatherElement, res.data.message)
            createOptions(filter, res.data.message)
        })
        .catch(err => {
            console.error("Não foi possível concluir a busca das lojas")
        })
}

function modalAlt(id) {
    toggleModal()
    document.querySelector('#id_usuarios').value = id
}

document
    .querySelector('#enviar-formulario')
    .addEventListener('click', function (e) {
        e.preventDefault()


        const headers = getDefaultHeaderWithToken()
        const route = getDefaultRoute() + 'usuario/change-loja'
        const body = {
            'id_usuarios': document.querySelector('#id_usuarios').value,
            'id_lojas': document.querySelector('#lojas').value
        }

        console.log(body)

        axios.patch(route, body, { headers })
            .then(res => {

                clearAllIitens(['#idlojas_error'])
                listFunc()
                toggleModal()

            })
            .catch(err => {
                clearAllIitens(['#idlojas_error'])

                const keys = Object.keys(err.response.data.errors)
                const values = Object.values(err.response.data.errors)

                createMessagesError(keys, values, ["list-group-item", "text-danger", "font-size-small"])

            })


    })

document
    .querySelector('#button-close')
    .addEventListener('click', function (e) {
        toggleModal()
    })

function toggleModal() {
    document.querySelector('#modal').classList.toggle('d-none')
}



getLojas()
listFunc()