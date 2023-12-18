const baseURL = '/base/controllers/'

const containerProducts = document.getElementById('containerProducts')
const containerRecentProducts = document.getElementById(
  'containerRecentProducts'
)

const listProducts = async () => {
  const dataProducts = await fetch(
    baseURL + 'productsControllers.php?typeForm=get_all_products'
  )

  const response = await dataProducts.text()

  containerProducts.innerHTML = response
}

listProducts()
