var idf = localStorage.getItem('idf')
tel = localStorage.getItem('tel')
nom = localStorage.getItem('nom')
date = localStorage.getItem('date')
model = localStorage.getItem('model')
designation = localStorage.getItem('designation')
prix = localStorage.getItem('prix')
main = localStorage.getItem('main')
brute = localStorage.getItem('brute')
remise = localStorage.getItem('remise')
total = localStorage.getItem('total')
serie = localStorage.getItem('serie')
document.querySelector('#nom').textContent = nom
document.querySelector('#tel').textContent = tel
document.querySelector('#serie').textContent = serie
document.querySelector('#billNum').textContent = idf
document.querySelector('#date').textContent = date
document.querySelector('#modele').textContent = model
document.querySelector('#designation').textContent = designation
document.querySelector('#prix').textContent = prix
document.querySelector('#main').textContent = main
document.querySelector('#brute').textContent = brute
document.querySelector('#remise').textContent = remise
document.querySelector('#totale').textContent = total
function genpdf() {
  const pdf = document.querySelector('#pdf') //html2pdf().from(pdf).save()
  f = `facture${String(idf)}.pdf`
  var opt = {
    filename: f,
    html2canvas: { scale: 1.5 },
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },

    'page-size': 'A4',
    'margin-top': '0in',
    'margin-right': '5in',
    'margin-bottom': '0in',
    'margin-left': '5in',
    encoding: 'UTF-8',
  }

  // New Promise-based usage:
  html2pdf().set(opt).from(pdf).save()

  // Old monolithic-style usage:
  html2pdf(pdf, opt)
}
