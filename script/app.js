let ajt = document.querySelector('#ajt')
let formclose = document.querySelector('#formclose')
let addrep = document.querySelector('.addrep')
ajt.addEventListener('click', () => {
  addrep.style.display = 'flex'
})
formclose.addEventListener('click', () => {
  addrep.style.display = 'none'
})
function verif() {
  let num_serie = document.getElementById('num_serie').value
  let tel = document.getElementById('tel').value
  let nom = document.getElementById('nom').value
  let model = document.getElementById('model').value
  let designation = document.getElementById('designation').value
  let prix = document.getElementById('prix').value
  let remise = document.getElementById('remise').value
  let main = document.getElementById('main').value

  if (num_serie.length > 50) {
    alert('la longeur du numero de chasis doit etre 50 caractere')
    event.preventDefault()
    return false
  }
  for (let i = 0; i < num_serie.length; i++) {
    if (
      isNaN(num_serie.charAt(i)) &&
      (num_serie.charAt(i).toUpperCase() < 'A' ||
        num_serie.charAt(i).toUpperCase() > 'Z')
    ) {
      alert('lle numero de chasis doit etre composee de chifre et alphabetique')
      event.preventDefault()
      return false
    }
  }
  if (tel.length != 8 || isNaN(tel)) {
    alert('le numero de tel est incorrecte ')
    event.preventDefault()
    return false
  }
  if (nom.length > 100) {
    alert('le nom est taille maximum de 100 caractere')
    event.preventDefault()
    return false
  }
  if (model.length > 50) {
    alert('le modele est taille maximum de 50 caractere')
    event.preventDefault()
    return false
  }
  if (designation.length > 500) {
    alert('la longeur du designation de taille maximum de 500 caractere')
    event.preventDefault()
    return false
  }
  if (isNaN(prix) || 0 > Number(prix) || Number(prix) > 9999) {
    alert('le prix doit 0 <= prix <=9999 et numerique')
    event.preventDefault()
    return false
  }
  if (isNaN(main) || 0 > Number(main) || Number(main) > 9999) {
    alert("le main d'oeuvre doit 0 <= main d'oeuvre <=9999 et numerique")
    event.preventDefault()
    return false
  }
  let prixtot = Number(prix) + Number(main)
  if (isNaN(remise) || 0 > Number(remise) || Number(remise) > prixtot) {
    alert('le remise doit 0 <= remise <= prix totale et numerique')
    event.preventDefault()
    return false
  }
}
let supp = document.querySelectorAll('.supp')
for (let sup of supp) {
  sup.addEventListener('click', (e) => {
    confirmer(e.target.getAttribute('value'))
  })
}
function confirmer(id) {
  /*
  <div class="confirmer">
      <h5>sur de supprimer cette reparation ?</h5>
      <div class="confirmer-content">
        <button>Annuler</button>
        <button>Confirmer</button>
  </div>
    </div>
  */
  const confdiv = document.createElement('div')
  confdiv.classList.add('confirmer')
  const h5 = document.createElement('h5')
  h5.textContent = 'sur de supprimer cette reparation ?'
  confdiv.appendChild(h5)
  const confForm = document.createElement('form')
  confForm.classList.add('confirmer-content')
  confForm.action = 'shop.php'
  confForm.method = 'POST'

  const annuler = document.createElement('button')
  annuler.textContent = 'Annuler'
  annuler.addEventListener('click', (e) => {
    confdiv.remove()
  })
  const confirmer = document.createElement('button')
  confirmer.textContent = 'Confirmer'
  confirmer.type = '' //submit
  confirmer.name = 'confbtn'
  confirmer.value = id

  confForm.appendChild(annuler)
  confForm.appendChild(confirmer)
  confdiv.appendChild(confForm)
  document.querySelector('body').appendChild(confdiv)
}
