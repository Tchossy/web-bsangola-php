const baseURL = '/base/controllers/'

const containerTeams = document.getElementById('containerTeams')
const containerTestimonial = document.getElementById('containerTestimonial')
const containerPortfolio = document.getElementById('containerPortfolio')
const containerBlogs = document.getElementById('containerBlogs')

const getTeams = async () => {
  const dataTeams = await fetch(
    baseURL + 'homePageControllers.php?typeForm=get_recent_teams'
  )

  const response = await dataTeams.text()

  containerTeams.innerHTML = response
}
getTeams()

const getTestimonial = async () => {
  const dataPortfolios = await fetch(
    baseURL + 'homePageControllers.php?typeForm=get_recent_testimonials'
  )

  const response = await dataPortfolios.text()

  containerTestimonial.innerHTML = response
}
getTestimonial()

const getPortfolios = async () => {
  const dataPortfolios = await fetch(
    baseURL + 'homePageControllers.php?typeForm=get_recent_portfolios'
  )

  const response = await dataPortfolios.text()

  containerPortfolio.innerHTML = response
}
getPortfolios()

const getBlogs = async () => {
  const dataBlogs = await fetch(
    baseURL + 'homePageControllers.php?typeForm=get_recent_blogs'
  )

  const response = await dataBlogs.text()

  containerBlogs.innerHTML = response
}
getBlogs()
