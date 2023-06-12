let reparations = document.querySelectorAll('.point')
for (let rep of reparations) {
  rep.addEventListener('click', (e) => {
    gettingValues(e)
  })
}

function gettingValues(e) {
  let idf = e.target.getAttribute('idf')
  let tel = e.target.getAttribute('tel')
  let nom = e.target.getAttribute('nom')
  let date = e.target.getAttribute('date')
  let model = e.target.getAttribute('model')
  let serie = e.target.getAttribute('serie')
  let designation = e.target.getAttribute('designation')
  let prix = e.target.getAttribute('prix')
  let main = e.target.getAttribute('main')
  let brute = e.target.getAttribute('brute')
  let remise = e.target.getAttribute('remise')
  let total = e.target.getAttribute('total')
  localStorage.setItem('idf', idf)
  localStorage.setItem('tel', tel)
  localStorage.setItem('nom', nom)
  localStorage.setItem('date', date)
  localStorage.setItem('model', model)
  localStorage.setItem('designation', designation)
  localStorage.setItem('prix', prix)
  localStorage.setItem('main', main)
  localStorage.setItem('brute', brute)
  localStorage.setItem('remise', remise)
  localStorage.setItem('serie', serie)
  localStorage.setItem('total', total)
  console.log(serie)
  window.location.href = 'facture.html'
}
