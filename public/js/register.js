import { 
  colorPasswordInputField,
  colorEmailInputField,
  colorNameInputField,
  checkFormNamePasswordEmail
} from './template.js';

let inputUser = "inputUserRegis";
let inputPassword = "inputPasswordRegis";
let inputEmail = "inputEmailRegis";

document.getElementById(inputUser).addEventListener("keyup", function() {
  colorNameInputField(inputUser);
});

document.getElementById(inputEmail).addEventListener("keyup", function() {
  colorEmailInputField(inputEmail);
});

document.getElementById(inputPassword).addEventListener("keyup", function() {
  colorPasswordInputField(inputPassword);
});

document.getElementById("registerUserForm").addEventListener("submit", function(event) {
  checkFormNamePasswordEmail(inputUser, inputEmail, inputPassword, "errorMess", event);
});