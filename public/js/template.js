// check input name field
export function checkInputName(input) {
  if (input.length >= 3 && input !== null) {    
    return true;
  } else {
    return false;
  }
}

// check input password field
export function checkInputPassword(input) {
  const regex = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/;
  if (input.match(regex)) {    
    return true;
  } else {
    return false;
  }
}

// check input password field
export function checkInputNumb(input) {
  const regex = /^[1-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/;
  if (input.match(regex)) {    
    return true;
  } else {
    return false;
  }
}

// check input email field
export function checkInputEmail(input) {
  const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (input.match(regex)) {    
    return true;
  } else {
    return false;
  }
}

//check if value is empty
export const isEmptyValue = (value) => {
  if (value === '' || value === null || value === undefined) {
      return true
  } else {
      return false
  }
}

//color name input field
export function colorNameInputField(element) {
  let name = document.getElementById(element);
  if (checkInputName(name.value)) {    
    name.classList.remove("inputBorderRed");
    name.classList.add("inputBorderGreen");
  } else {
    name.classList.add("inputBorderRed");
  }
}

//color email input field
export function colorEmailInputField(element) {
  let email = document.getElementById(element);
  if (checkInputEmail(email.value)) {
    email.classList.remove("inputBorderRed");
    email.classList.add("inputBorderGreen");
  } else {
    email.classList.add("inputBorderRed");
  }
}

//color password input field
export function colorPasswordInputField(element) {
  let password = document.getElementById(element);
  if (checkInputPassword(password.value)) {
    password.classList.remove("inputBorderRed");
    password.classList.add("inputBorderGreen");
  } else {
    password.classList.add("inputBorderRed");
  }
}

//form checker for name, email and password
export function checkFormNamePasswordEmail(inputUser, inputEmail, inputPassword, error, event) {
  let name = document.getElementById(inputUser);
  let password = document.getElementById(inputPassword);
  let email = document.getElementById(inputEmail);
  let errorMess = document.getElementsByClassName(error)[0];
  errorMess.textContent = null;
  if(isEmptyValue(name.value)) {
    errorMess.textContent = "The user can not be empty.";
    event.preventDefault();
  }
  if(isEmptyValue(password.value)) {
    errorMess.textContent = "The password can not be empty.";
    event.preventDefault();
  }
  if(isEmptyValue(email.value)) {
    errorMess.textContent = "The email can not be empty.";
    event.preventDefault();
  }
  if(!checkInputEmail(email.value)) {
    errorMess.textContent = "The email is not valid.";
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
}