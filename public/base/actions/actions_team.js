const baseURL = '/base/controllers/'

const containerTeam = document.getElementById('containerTeam')

const listTeams = async () => {
  const dataTeams = await fetch(
    baseURL + 'teamControllers.php?typeForm=get_all_teams'
  )

  const response = await dataTeams.text()

  containerTeam.innerHTML = response
}

listTeams()
