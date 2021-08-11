import request from "./request.js";

const baseUrl = 'http://localhost:8888/handlers'
const deleteButton = document.querySelector('#delete-btn')
const addButton = document.querySelector('#add-btn')
const list = document.querySelector('.list');
const ids = []
const select = document.querySelector('select')

select.addEventListener('change', (e) => {
  initLoad(e.target.value)
})

list.addEventListener('dragstart', (e) => {
  e.target.classList.add('selected');
});

list.addEventListener('dragend', (e) => {
  e.target.classList.remove('selected');
});

list.addEventListener('dragover', dragLogic);

window.addEventListener('load', initLoad())

addButton.addEventListener('click', addUser)

deleteButton.addEventListener('click', deleteUsers)

async function addUser() {
  const name = document.querySelector('#name').value
  const surname = document.querySelector('#surname').value
  const patronymic = document.querySelector('#patronymic').value
  const email = document.querySelector('#email').value
  const address = document.querySelector('#address').value

  const res = await request(`${baseUrl}/users.handler.php`, {
    method: 'post',
    body: {
      name, surname, patronymic, email, address
    }
  })
  console.log(res);
  if (res.error) return alert(res.error)

  addItemOnPage(res.id, name, surname, patronymic, email, address)
}

async function deleteUsers() {
  const checkboxes = document.querySelectorAll('input[type=checkbox]')
  checkboxes.forEach(box => {
    if (box.checked) ids.push(box.id)
  })

  const res = await request(`${baseUrl}/users.handler.php`, {
    method: 'delete',
    body: {ids}
  })
  if (res.error) return alert(res.error)

  location.reload()
}

function addItemOnPage(id, name, surname, patronymic, email, address) {
  const checkBox = document.createElement('input')
  checkBox.type = 'checkbox'
  checkBox.id = id
  checkBox.className = 'check'

  const button = document.createElement('button')
  button.addEventListener('click', () => {
    window.location.href = `edit_user.php?id=${id}`
  })
  button.className = 'edit-btn'
  button.innerText = 'Изменить'

  const span = document.createElement('span')
  span.innerText = `ФИО: ${surname} ${name} ${patronymic}, почта: ${email}, адрес: ${address}`

  const mock = document.createElement('div')
  mock.className = 'item'
  mock.id = id
  mock.draggable = true
  mock.appendChild(checkBox)
  mock.appendChild(span)
  mock.appendChild(button)

  list.appendChild(mock)
}


async function initLoad(order = 'asc') {
  list.innerHTML = ''
  const res = await request(`${baseUrl}/users.handler.php?order=${order}`, {
    method: 'GET'
  })

  console.log(res);
  res.forEach(value => {
    addItemOnPage(value.id, value.name, value.surname, value.patronymic, value.email, value.address)
  })
}

function dragLogic(e) {
  e.preventDefault();
  const active = list.querySelector('.selected');
  const current = e.target;
  const isMovable = active !== current && current.classList.contains('item');

  if (!isMovable) return;

  const nextElement =
    current === active.nextElementSibling
      ? current.nextElementSibling
      : current;

  list.insertBefore(active, nextElement);
}