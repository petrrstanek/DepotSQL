// Zabrání opětovnému vkládání dat do databáze F5tkou
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
})

//Modal-Form-remove
const btnRemove = document.getElementById('modal-btn-remove');
const modalRemove = document.getElementById('form-modal-remove');
const closeRemove = document.querySelector('.close-remove');

closeRemove.addEventListener('click', () => {
  console.log('click');
  modalRemove.style.display = "none";
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
const table = document.querySelector('.record-t-style');
table.scrollTop = table.scrollHeight;
console.log(table);

//Sumbit Record
function sumbit_record(){
  //Načtení dat z formuláře
  const formData = document.querySelector('.form-data');
  const fetchData = new FormData();

  //Vložení dat do objektu pomocí loopu
  for (let i = 0; i < formData.length; i++){
    fetchData.append(formData[i].name, formData[i].value);
  }
  const btnSumbit = document.getElementById('button-add');
  btnSumbit.disabled = true;

  //Žádost o poslání dat na server
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'add.php');
  xhr.send(fetchData);

  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4 && xhr.status == 200){
      btnSumbit.disabled = false;
      let response = JSON.parse(xhr.responseText);

      if(response.success != ''){
        const form = document.getElementById('form-add');
        form.reset();

        const span = document.getElementById('message-box');
        span.innerHTML = response.success;
      }
    }
  }
}
