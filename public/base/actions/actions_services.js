const baseURL = '/base/controllers/'

const containerServices = document.getElementById('containerServices')
const containerRecentServices = document.getElementById(
  'containerRecentServices'
)

const listServices = async () => {
  const dataServices = await fetch(
    baseURL + 'servicesControllers.php?typeForm=get_all_services'
  )

  const response = await dataServices.text()

  containerServices.innerHTML = response
}

listServices()

const listRecentServices = async () => {
  const dataServices = await fetch(
    baseURL + 'servicesControllers.php?typeForm=get_recent_services'
  )

  const response = await dataServices.text()

  containerRecentServices.innerHTML = response
}

listRecentServices()
