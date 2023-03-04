import { 
  colorNameInputField,
  colorPasswordInputField,
  checkFormNamePassword
} from './template.js';

let inputUser = "inputUser";
let inputPassword = "inputPassword";

document.getElementById(inputUser).addEventListener("keyup", function() {
  colorNameInputField(inputUser);
});

document.getElementById(inputPassword).addEventListener("keyup", function() {
  colorPasswordInputField(inputPassword);
});

document.querySelector("#loginForm").addEventListener("submit", function(event) {
  let name = document.getElementById(inputUser);
  let password = document.getElementById(inputPassword);
  let errorMess = document.getElementsByClassName("errorMess")[0];
  errorMess.textContent = null;
  if(isEmptyValue(name.value)) {
    errorMess.textContent = "The user can not be empty.";
    event.preventDefault();
  }
  if(isEmptyValue(password.value)) {
    errorMess.textContent = "The password can not be empty.";
    event.preventDefault();
  }
  if (!checkInputName(name.value)) {    
    errorMess.textContent = "The user is not valid.";
    event.preventDefault();
  } 
  if (!checkInputPassword(password.value)) {    
    errorMess.textContent = "The password is not valid.";
    event.preventDefault();
  }
});