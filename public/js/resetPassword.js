import { 
  colorPasswordInputField,
  colorEmailInputField,
  colorNameInputField,
  checkFormNamePasswordEmail
} from './template.js';

let inputUser = "inputUserReset";
let inputPassword = "inputPasswordReset";
let inputEmail = "inputEmailReset";

document.getElementById(inputUser).addEventListener("keyup", function() {
  colorNameInputField(inputUser);
});

document.getElementById(inputEmail).addEventListener("keyup", function() {
  colorEmailInputField(inputEmail);
});

document.getElementById(inputPassword).addEventListener("keyup", function() {
  colorPasswordInputField(inputPassword);
});

document.querySelector("#resetPassword").addEventListener("submit", function(event) {
  checkFormNamePasswordEmail(inputUser, inputEmail, inputPassword, "errorMess", event);
});