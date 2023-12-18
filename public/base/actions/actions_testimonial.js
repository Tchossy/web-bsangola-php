const baseURL = '/base/controllers/'

const containerTestimonial = document.getElementById('containerTestimonial')

const listTestimonials = async () => {
  const dataTestimonials = await fetch(
    baseURL + 'testimonialControllers.php?typeForm=get_all_testimonials'
  )

  const response = await dataTestimonials.text()

  containerTestimonial.innerHTML = response
}

listTestimonials()
