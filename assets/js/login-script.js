function validation(){
  let user = document.getElementById('email').value.trim();
  const pass = document.getElementById('password').value.trim();
  if(user.length === "" && pass.length){
	alert("Přihlašovací jméno a heslo jsou prázné")
	return false;
  }
  else{
	if(user.length === ''){
	  alert("Přihlašovací jméno je prázné");
	  return false;
	}
	if(pass.length === ''){
	  alert("Heslo je prázdné");
	  return false;
	}
  }
}
validation();

//Login form
const charsEmail = document.querySelector('.lab-email').textContent; //*
const labelEmail = document.querySelector('.lab-email');
const charsPw = document.querySelector('.lab-pw').textContent;
const labelPw = document.querySelector('.lab-pw');

let spanEmail = '';
let spanPw = '';
let counter = 0;
let counter2 = 0;

let splitted = charsEmail.split('');
console.log(splitted);
let splittedPw = charsPw.split('');

for (let i = 0; i < splitted.length; i++) {
  counter += 50;
  spanEmail = spanEmail + `<span class='spanEmail' style=transition-delay:${counter}ms>` + splitted[i] + '</span>'; //*jednotlivé písmenka*//
  labelEmail.innerHTML = spanEmail;
  console.log(spanEmail);
}

for (let i = 0; i < splittedPw.length; i++) {
  counter2 += 50;
  spanPw = spanPw + `<span class='spanPw' style=transition-delay:${counter2}ms>` + splittedPw[i] + '</span>'; //*jednotlivé písmenka*//
  labelPw.innerHTML = spanPw;
}

