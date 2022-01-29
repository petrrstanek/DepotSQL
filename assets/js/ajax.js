//AJAX - ADD

function sumbit_record(){
  //Načtení dat z formuláře
  const formData = document.getElementsByClassName('form-data');
  const fetchData = new FormData();
  let counter;
  //Vložení dat do objektu pomocí loopu
  for (let i = 0; i < formData.length; i++){
	fetchData.append(formData[i].name, formData[i].value);

  }

  //Žádost o poslání dat na server
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'add.php');
  xhr.send(fetchData);

  xhr.onreadystatechange = function(){
	if(xhr.readyState === 4 && xhr.status === 200){
	  const alert = document.querySelector('.alert');
	  alert.style.display = "block";
	  const form = document.getElementById('form-add');
	  form.reset();
	  const span = document.getElementById('message-box');
	  console.log(xhr.responseText)
	  span.innerHTML = xhr.responseText;
	}

  }
}

//AJAX - REMOVE

function sumbit_record_remove(){
  //Načtení dat z formuláře
  const formData = document.getElementsByClassName('data-remove');
  const fetchData = new FormData();
  let counter;
  //Vložení dat do objektu pomocí loopu
  for (let i = 0; i < formData.length; i++){
	fetchData.append(formData[i].name, formData[i].value);

  }

  //Žádost o poslání dat na server
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'remove.php');
  xhr.send(fetchData);

  xhr.onreadystatechange = function(){
	if(xhr.readyState === 4 && xhr.status === 200){
	  const alert = document.getElementById('alert');
	  alert.style.display = "block";
	  const form = document.getElementById('remove');
	  form.reset();
	  const span = document.getElementById('message-box-remove');
	  console.log(alert)
	  span.innerHTML = xhr.responseText;
	}

  }
}

//AJAX - LOGIN
function sumbit_record_login(){
  //Načtení dat z formuláře
  const formData = document.getElementsByClassName('data-login');
  const fetchData = new FormData();
  let counter;
  //Vložení dat do objektu pomocí loopu
  for (let i = 0; i < formData.length; i++){
	fetchData.append(formData[i].name, formData[i].value);

  }

  //Žádost o poslání dat na server
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'remove.php');
  xhr.send(fetchData);

  xhr.onreadystatechange = function(){
	if(xhr.readyState === 4 && xhr.status === 200){
	  const alert = document.getElementById('login-alert');
	  alert.style.display = "block";
	  const form = document.getElementById('form-login');
	  form.reset();
	  const span = document.getElementById('message-box-login');
	  console.log(alert)
	  span.innerHTML = xhr.responseText;
	}

  }
}