import request from "./request.js";

const baseUrl = 'http://localhost:8888/handlers'
const button = document.querySelector('#submit')
const login = document.querySelector('#login')
const password = document.querySelector('#password')
const body = {login: '', password: ''}

button.addEventListener('click', async (e) => {
    e.preventDefault()
    console.log(body)
    const response = await request(`${baseUrl}/auth.handler.php`, {method: 'POST', body})
    if (response.error) alert('Неверно введены данные')
    else window.location.href = `${baseUrl}/users.php`
})

login.addEventListener('input', (e) => {body.login = e.target.value
})
password.addEventListener('input', (e) => {body.password = e.target.value
})
