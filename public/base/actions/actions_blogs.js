const baseURL = '/base/controllers/'

const containerBlogs = document.getElementById('containerBlogs')
const containerRecentBlogs = document.getElementById('containerRecentBlogs')

const listBlogs = async () => {
  const dataBlogs = await fetch(
    baseURL + 'blogsControllers.php?typeForm=get_all_blogs'
  )

  const response = await dataBlogs.text()

  containerBlogs.innerHTML = response
}

listBlogs()

const listRecentBlogs = async () => {
  const dataBlogs = await fetch(
    baseURL + 'blogsControllers.php?typeForm=get_recent_blogs'
  )

  const response = await dataBlogs.text()

  containerRecentBlogs.innerHTML = response
}

listRecentBlogs()
