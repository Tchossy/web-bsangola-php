const baseURL = '/base/controllers/'

const containerPortfolios = document.getElementById('containerPortfolios')
const containerRecentPortfolios = document.getElementById(
  'containerRecentPortfolios'
)

const listPortfolios = async () => {
  const dataPortfolios = await fetch(
    baseURL + 'portfolioControllers.php?typeForm=get_all_portfolios'
  )

  const response = await dataPortfolios.text()

  containerPortfolios.innerHTML = response
}

listPortfolios()

const listRecentPortfolios = async () => {
  const dataPortfolios = await fetch(
    baseURL + 'portfolioControllers.php?typeForm=get_recent_portfolios'
  )

  const response = await dataPortfolios.text()

  containerRecentPortfolios.innerHTML = response
}

listRecentPortfolios()
