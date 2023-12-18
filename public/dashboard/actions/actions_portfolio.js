const baseURL = '/dashboard/controllers/'

const tbody = document.querySelector('tbody')
const cardForm = document.getElementById('registerForm')
const cardEditForm = document.getElementById('editForm')
const msgAlerta = document.getElementById('msgAlertaErroCad')
const msgEditAlerta = document.getElementById('msgAlertaErroEditCad')

const btnExit = document.getElementById('btn_exit')

const inputImagens = document.getElementById('inputImagens')
const containerImagens = document.getElementById('containerImagens')
const inputImagensEdit = document.getElementById('inputImagensEdit')
const containerImagensEdit = document.getElementById('containerImagensEdit')

const numRegister = document.getElementById('numRegister')
const searchRegister = document.getElementById('searchRegister')
const searchRegisterForm = document.getElementById('searchRegister')
const searchRegisterValue = document.getElementById('searchRegisterValue')

searchRegisterForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(searchRegisterForm)
  dataForm.append('add', 1)

  const dataFetch = await fetch(
    baseURL +
      'portfolioControllers.php?typeForm=get_all_portfolio_search&searchRegisterValue=' +
      searchRegisterValue.value
  )

  const response = await dataFetch.json()

  if (response['error']) {
    listCustomer(numRegister.value)
    alert(response['msg'])
  } else {
    tbody.innerHTML = response['msg']
    cardForm.reset()
  }
})

numRegister.addEventListener('change', () => {
  listCustomer(numRegister.value)
})

inputImagens.addEventListener('change', function () {
  containerImagens.innerHTML = ''
  const files = this.files

  console.log(files[0])

  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    const reader = new FileReader()

    reader.addEventListener('load', function () {
      const imagem = document.createElement('img')
      imagem.src = reader.result
      containerImagens.appendChild(imagem)
    })

    reader.readAsDataURL(file)
  }
})
inputImagensEdit.addEventListener('change', function () {
  containerImagensEdit.innerHTML = ''
  const files = this.files

  console.log(files[0])

  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    const reader = new FileReader()

    reader.addEventListener('load', function () {
      const imagem = document.createElement('img')
      imagem.src = reader.result
      containerImagensEdit.appendChild(imagem)
    })

    reader.readAsDataURL(file)
  }
})

const listCustomer = async limitRegister => {
  const dataUsers = await fetch(
    baseURL +
      'portfolioControllers.php?typeForm=get_portfolios&numRegister=' +
      limitRegister
  )

  const response = await dataUsers.text()

  tbody.innerHTML = response
}

listCustomer(numRegister.value)

cardForm.addEventListener('submit', async event => {
  event.preventDefault()

  const dataForm = new FormData(cardForm)
  dataForm.append('add', 1)

  const dataNewUser = await fetch(
    baseURL + 'portfolioControllers.php?typeForm=create_portfolio',
    {
      method: 'POST',
      body: dataForm
    }
  )

  const response = await dataNewUser.json()

  if (response['error']) {
    msgAlerta.innerHTML = response['msg']
  } else {
    msgAlerta.innerHTML = response['msg']
    cardForm.reset()
    closeModalCreate()
    listCustomer(numRegister.value)
  }

  listCustomer(numRegister.value)
  setTimeout(() => {
    msgAlerta.innerHTML = ''
  }, 4000)
})

async function confirmDelete(idCustomer) {
  await fetch(
    baseURL +
      'portfolioControllers.php?typeForm=delete_portfolios&idCustomer=' +
      idCustomer
  )
  listCustomer(numRegister.value)
}

function deleteCustomer(idCustomer) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
    // buttonsStyling: false
  })

  swalWithBootstrapButtons
    .fire({
      title: 'Tem certeza que pretende eliminar este portifolio?',
      text: 'Você não será capaz de reverter está acção!',
      icon: 'warning',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      showCancelButton: true,
      confirmButtonText: 'Sim, exclua!',
      cancelButtonText: 'Não, cancelar!',
      reverseButtons: true
    })
    .then(result => {
      if (result.isConfirmed) {
        confirmDelete(idCustomer)
        swalWithBootstrapButtons.fire(
          'Excluído!',
          'Cliente foi excluído.',
          'success'
        )
        listCustomer(numRegister.value)
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Não excluído',
          'O portifolio não foi excluído :)',
          'error'
        )
      }
    })
}

async function editeCustomer(idCustomer) {
  const dataUsers = await fetch(
    baseURL +
      'portfolioControllers.php?typeForm=get_portfolio&idCustomer=' +
      idCustomer
  )

  const response = await dataUsers.json()
  if (response['error']) {
    alert(response['msg'])
  } else {
    const portfolioData = response['dados']

    openModalEdit()

    const image_portfolio_array = JSON.parse(portfolioData.image_portfolio)

    document.getElementById('id_edit').value = portfolioData.id
    document.getElementById('images_files_edit').src = image_portfolio_array
    document.getElementById('title_portfolio_edit').value =
      portfolioData.title_portfolio
    document.getElementById('description_portfolio_edit').value =
      portfolioData.description_portfolio
    document.getElementById('occupation_portfolio_edit').value =
      portfolioData.occupation_portfolio
  }
}

cardEditForm.addEventListener('submit', async event => {
  event.preventDefault()
  const dataEditForm = new FormData(cardEditForm)

  // for (var dados of dataEditForm.entries()) {
  //   console.log(dados[0] + ' ' + dados[1] + ' ' + dados[2])
  // }

  dataEditForm.append('add', 1)

  const dataNewUser = await fetch(
    baseURL + 'portfolioControllers.php?typeForm=edite_portfolio',
    {
      method: 'POST',
      body: dataEditForm
    }
  )

  const response = await dataNewUser.json()

  if (response['error']) {
    msgEditAlerta.innerHTML = response['msg']
  } else {
    msgEditAlerta.innerHTML = response['msg']
  }

  listCustomer(numRegister.value)
  cardEditForm.reset()
  closeModalEdit()

  setTimeout(() => {
    msgEditAlerta.innerHTML = ''
  }, 4000)
})

function openModalEdit() {
  const cadModal = document.getElementById('modalEdite')

  cadModal.style.visibility = 'visible'
  cadModal.classList.add('show')
}
function closeModalEdit() {
  const cadModal = document.getElementById('modalEdite')

  cadModal.style.visibility = 'visible'
  cadModal.classList.remove('show')
}
function closeModalCreate() {
  const cadModal = document.getElementById('modalCreate')

  cadModal.style.visibility = 'visible'
  cadModal.classList.remove('show')
}
