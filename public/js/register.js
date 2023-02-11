// validate register credential input fields
function checkRegisterData() {
    var name = document.getElementById("inputUserRegis");
    var email = document.getElementById("inputEmailRegis");
    var password = document.getElementById("inputPasswordRegis");
    name.addEventListener("keydown", function() {
      if (checkInputName(name)) {    
        name.classList.remove("inputBorderRed");
        name.classList.add("inputBorderGreen");
      } else {
        name.classList.add("inputBorderRed");
      }
    })
    email.addEventListener("keydown", function() {
      if (checkInputEmail(email)) {    
        email.classList. remove("inputBorderRed");
        email.classList.add("inputBorderGreen");
      } else {
        email.classList.add("inputBorderRed");
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
  
  
  // validate register credential
  function validateRegister() {
    let name = document.getElementById("inputUserRegis");
    let email = document.getElementById("inputEmailRegis");
    let password = document.getElementById("inputPasswordRegis");;
    let errorMess = document.getElementById("registerError");
    errorMess.textContent = null;
    if(isEmptyValue(name.value)) {
      errorMess.textContent = "The user can not be empty.";
      return false;
    } 
    if(isEmptyValue(email.value)) {
      errorMess.textContent = "The email can not be empty.";
      return false;
    } 
    if(isEmptyValue(password.value)) {
      errorMess.textContent = "The password can not be empty.";
      return false;
    }
    if(isEmptyValue(password.value) && isEmptyValue(email.value) && isEmptyValue(name.value)) {
      errorMess.textContent = "The fields can not be empty.";
      return false;
    } else {
      if (!checkInputName(name)) {    
        errorMess.textContent = "The user is not valid.";
        return false;
      } else {
        if (!checkInputEmail(email)) {    
          errorMess.textContent = "The email is not valid.";
          return false;
        } else {
          if (!checkInputPassword(password)) {    
            errorMess.textContent = "The password is not valid.";
            return false;
          }
        }
      }
    }
  }
  