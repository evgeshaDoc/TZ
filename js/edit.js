import request from "./request.js";

const editBtn = document.querySelector('.edit-btn')
const baseUrl = 'http://localhost:8888/handlers'

editBtn.addEventListener('click', editUser)

window.addEventListener('load', getUser)

async function getUser() {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');

  const res = await request(`${baseUrl}/users.handler.php?id=${id}`, {method: 'GET'})

  if (res.error) return alert(res.error)

  document.getElementById('name').value = res.name
  document.getElementById('surname').value = res.surname
  document.getElementById('patronymic').value = res.patronymic
  document.getElementById('email').value = res.email
  document.getElementById('address').value = res.address

}

async function editUser() {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  const name = document.querySelector('#name').value
  const surname = document.querySelector('#surname').value
  const patronymic = document.querySelector('#patronymic').value
  const email = document.querySelector('#email').value
  const address = document.querySelector('#address').value

  const res = request(`${baseUrl}/users.handler.php`, {
    method: 'PUT',
    body: {
      name, surname, patronymic, email, address, id
    }
  })
  alert("Успешно изменено")

  window.location.href = 'http://localhost:8888/users.php'
}