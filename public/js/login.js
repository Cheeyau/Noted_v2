// input field checker login
function checkLoginData() {
    var name = document.getElementById("inputUser");
    var password = document.getElementById("inputPassword");
    name.addEventListener("keydown", function() {
      if (checkInputName(name)) {    
        name.classList.remove("inputBorderRed");
        name.classList.add("inputBorderGreen");
      } else {
        name.classList.add("inputBorderRed");
      }
    })
    password.addEventListener("keydown", function() {
      if (checkInputPassword(password)) {    
        password.classList.remove("inputBorderRed");
        password.classList.add("inputBorderGreen");
      } else {
        password.classList.add("inputBorderRed");
      }
    })
  }
  
  // check input name field
  function checkInputName(input) {
    let inputValue = input.value;
    if (inputValue.length >= 3 && inputValue !== null) {    
      return true;
    } else {
      return false;
    }
  }
  
  // check input password field
  function checkInputPassword(input) {
    let inputValue = input.value;
    const regex = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/;
    if (inputValue.match(regex)) {    
      return true;
    } else {
      return false;
    }
  }
  
  // check input password field
  function checkInputNumb(input) {
    let inputValue = input.value;
    const regex = /^[1-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/;
    if (inputValue.match(regex)) {    
      return true;
    } else {
      return false;
    }
  }
  
  // check input email field
  function checkInputEmail(input) {
    let inputValue = input.value;
    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (inputValue.match(regex)) {    
      return true;
    } else {
      return false;
    }
  }
  
  //check if value is empty
  const isEmptyValue = (value) => {
    if (value === '' || value === null || value === undefined) {
        return true
    } else {
        return false
    }
  }
  
  // validate login credential
  function validateLogin() {
    var name = document.getElementById("inputUser");
    var password = document.getElementById("inputPassword");;
    var errorMess = document.getElementById("loginError");
    errorMess.textContent = null;
    if(isEmptyValue(name.value)) {
      errorMess.textContent = "The user can not be empty.";
      return false;
    }
    if(isEmptyValue(password.value)) {
      errorMess.textContent = "The password can not be empty.";
      return false;
    }
    if(isEmptyValue(password.value) && isEmptyValue(name.value)) {
      errorMess.textContent = "The fields can not be empty.";
      return false;
    } else {
      if (!checkInputName(name)) {    
        errorMess.textContent = "The user is not valid.";
        return false;
      } else {
        if (!checkInputPassword(password)) {    
          errorMess.textContent = "The password is not valid.";
          return false;
        } 
      }
    }
  }
  
  
  