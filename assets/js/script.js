// Zabrání opětovnému vkládání inputů
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

//Logout-Button
const logout = document.querySelector('.logout');
logout.addEventListener('click', () => {
  alert('Úspěšně jste se odhlásili');
})

//Modal-Form
const modalBtn = document.getElementById('modal-btn');
const modal = document.getElementById('form-modal');
const close = document.querySelector('.close');

modalBtn.addEventListener('click', () => {
  modal.style.display = "block";

})

close.addEventListener('click', () => {
  modal.style.display = "none";
  location.reload();
  return false;
})

//Modal-Form-remove
const btnRemove = document.getElementById('modal-btn-remove');
const modalRemove = document.getElementById('form-modal-remove');
const closeRemove = document.querySelector('.close-remove');

closeRemove.addEventListener('click', () => {
  modalRemove.style.display = "none";
  location.reload();
  return false;
})

btnRemove.addEventListener('click', () => {
  modalRemove.style.display = "block";
})


//Updating Time Function
function updateTime(){
  let today = new Date();
  let minutes = today.getMinutes();
  let sec = today.getSeconds();
  const months = ["Ledna", "Února", "Března", "Dubna", "Května", "Června", "Července", "Srpna", "Září", "Října", "Listopadu", "Prosince"];
  let date = today.getDate() + "." + (today.getMonth()+1) + '.' + today.getFullYear();

  if(minutes < 10){
    minutes  = "0" + minutes;
  }
  if(sec < 10) {
    sec = "0" + sec
  }
  let time = today.getHours() + ":" + minutes + ":" + sec;
  let dateTime = `${date} ${time}`;
  const span = document.querySelector('.cur-time');
  const timeForm = document.querySelector('.time-form')
  timeForm.innerHTML = dateTime;
  span.innerHTML = dateTime;
  setTimeout('updateTime()', 1000);
}

//Inputs Time
let today = new Date();
const months = ["Ledna", "Února", "Března", "Dubna", "Května", "Června", "Července", "Srpna", "Září", "Října", "Listopadu", "Prosince"];
let date = today.getFullYear() + "/" + (today.getMonth()+1) + '/' + today.getDate();
let minutes = today.getMinutes();
let sec = today.getSeconds();
if(minutes < 10){
  minutes = "0" + minutes;
}
if(sec < 10){
  sec = "0" + sec;
}
let time = today.getHours() + ":" + minutes + ":" + sec;
let dateTime = `${date} ${time}`;

      //Zakázat vstup pro datum
      const field = document.getElementById('date');
      field.setAttribute('value', date)
      field.disabled = true;


      //Zakázat vstup pro datum2
      const fieldRemove = document.getElementById('date-remove')
      fieldRemove.setAttribute('value', date);
      fieldRemove.disabled = true;


//Zakázat vstup pro email
const email = document.getElementById('email');
email.disabled = true;

//Zakázat vstup pro email-remove
const emailRemove = document.getElementById('email-remove');
emailRemove.disabled = true;

//Scroll-Bottom
window.addEventListener('load', (e) => {
  const table = document.querySelector('.ev-style');
  table.scrollTop = table.scrollHeight;
})




//Roll inventáře
function roll() {
  const inventory = document.querySelector('.status-t-style');
  const btnRoll = document.querySelector('.btn-roll');
  const bodyProfile = document.querySelector('.transform-body');
  inventory.classList.toggle('active');
  bodyProfile.classList.toggle('active');
}
const rolls = document.querySelectorAll('.trigg');






