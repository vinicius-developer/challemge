function clearItens(fatherElement){
    while(fatherElement.firstChild) {
        fatherElement.removeChild(fatherElement.lastChild)
    }
}

function clearAllIitens(fields) {
    fields.map(id => {
        const fatherElement = document.querySelector(id)
        clearItens(fatherElement)
    })
}

function clearValue(input){
    input.value = ""
}   



function clearValues(fields) {
    fields.map(id => {
        const inputElement = document.querySelector(id)
        clearValue(inputElement)
    })
}

function clearAllValues(fields){
    fields.map(classes => {
        const group = document.querySelectorAll(classes)

        for(let i = 0; i < group.length; i++) {
            clearValue(group[i])
        }
    })
}

function setValue(input ,message){

    input.value = message
}

function setValues(fields, messages) {
    fields.map((id, index) => {
        const inputElement = document.querySelector(`#${id}`)
        setValue(inputElement, messages[index])
    })
}

function createListErrors(fatherElement, objectErrors) {
    const mergeObjectInArray = Object.values(objectErrors);
    const getOnlyFirstMessageError = mergeObjectInArray.map(val => val[0])

    getOnlyFirstMessageError.map((val, ind) => {

        childElement = document.createElement('li')
        childTextElement = document.createTextNode(val)
        childElement.appendChild(childTextElement);
        
        childElement.classList.add("list-group-item");
        childElement.classList.add("text-danger");
        childElement.classList.add("font-size-small");

        fatherElement.appendChild(childElement)

    })
}

function inputHandler(masks, max, event) {
    var c = event.target;
    var v = c.value.replace(/\D/g, '');
    var m = c.value.length > max ? 1 : 0;
    VMasker(c).unMask();
    VMasker(c).maskPattern(masks[m]);
    c.value = VMasker.toPattern(v, masks[m]);
}

function maskAll(classe, mask) {
    const elements = document.querySelectorAll(classe)
    for(let i = 0; i < elements.length; i++) {
        VMasker(elements[i]).maskPattern(mask[0])
        elements[i].addEventListener('input', inputHandler.bind(undefined, mask, 14), false);
    }
}

function mask(id, mask) {
    const element = document.querySelector(id);
    VMasker(element).maskPattern(mask[0]);
    element.addEventListener('input', inputHandler.bind(undefined, mask, 14), false);
}

function createMessagesError(keys, values, classes){
    keys.map((defaultField, index) => {        
        const formatedString = defaultField.replace(/[^A-Za-z]/g, '')

        const idErrorField = `#${formatedString}_error`

        const elementError = document.querySelector(idErrorField)

        const childElement = document.createElement('li')

        const textError = document.createTextNode(values[index][0])

        classes.map(val => childElement.classList.add(val))

        childElement.appendChild(textError)

        elementError.appendChild(childElement)
    })

}

function createMessageSuccess(fatheElement, message, classes = []) {
    const createElement = document.createElement('p')
    const createText = document.createTextNode(message)


    classes.map(val => createElement.classList.add(val))

    createElement.appendChild(createText)

    fatheElement.appendChild(createElement)
}


function createOptions(fatherElement, itens) {
    itens.map(value => {
        const childElement = document.createElement('option');
        const childTextNode = document.createTextNode(value.nome)

        childElement.value = value.id_lojas

        childElement.appendChild(childTextNode)
        fatherElement.appendChild(childElement)
    })
}

function checkToken() {
    const headers = getDefaultHeaderWithToken()
    const route = getDefaultRoute() + 'check-access'
    axios.get(route, { headers }).then(err => {
        if(err.data == "Expired token"){
            window.localStorage.removeItem('token')
            window.location.href = getUrl()
        }
    })
}

function checkLocalStorageUnset() {
    if(!localStorage.getItem('token')){
        window.location.href = getUrl()
    }
}

function checkLocalStorageSet() {
    if(localStorage.getItem('token')){
        window.location.href = getUrl() + "/pages/lista/lista.html"
    }
}

function getDefaultHeader() {
    return {
        'Content-Type': 'application/json'
    }
}

function getDefaultHeaderWithToken() {
    return {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.token}`
    }
}

function getDefaultRoute(){
    return 'http://127.0.0.1:8000/api/'
}

function getUrl() {
    return 'http://127.0.0.1:8001/'
}






