function ajaxCall(id, conUrl) {
  var xmlHttp = new XMLHttpRequest();
  var url = conUrl;
  var parameters = "?JazzTicketId=" + id;
  xmlHttp.open("GET", url + parameters, true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.onreadystatechange = function() {
    if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      var jsonData = JSON.parse(xmlHttp.responseText);
      
      var errorMess = new Date(jsonData['errorMess']);
      
      // if(errorMess !== 'empty' && errorMess !== 'Something went wrong, please try again') {
      //   var startDate = new Date(jsonData['selectedTicket'].StartDateTime);
      //   var endDate = new Date(jsonData['selectedTicket'].EndDateTime);
      //   var ticketId = jsonData['selectedTicket'].TicketId;
        
      //   var dayLong = startDate.toLocaleString('en-US', {
      //     weekday: 'long'
      //   });
      //   var start = startDate.toLocaleString('en-US', {
      //     hour: "2-digit", 
      //     minute: "2-digit",
      //     hourCycle: "h24" 
      //   });
      //   var end = endDate.toLocaleString('en-US', {
      //     hour: "2-digit", 
      //     minute: "2-digit",
      //     hourCycle: "h24"  
      //   });
      //   if(dayLong !== null && dayLong !== "") {
      //     document.getElementById("jazzTicketId").value = ticketId;
      //     document.getElementById("selectedJazzName").textContent = jsonData['selectedTicket'].TicketName;
      //     document.getElementById("selectedJazzPrice").textContent = '€ ' + jsonData['selectedTicket'].Price;
      //     document.getElementById("jazzPriceHidden").value = jsonData['selectedTicket'].Price;
      //     document.getElementById("selectedJazzDay").textContent = dayLong;
      //     document.getElementById("selectedJazzTime").textContent = start + ' - ' + end;
      //   } else {
      //     document.getElementById("selectedJazzDay").textContent = '-';
      //     document.getElementById("selectedJazzTime").textContent = '-';

      //   }
      // } else {
      //   document.getElementById('jazzErrorMess').textContent = null;
      //   document.getElementById('jazzErrorMess').textContent = 'The ticket is sold out.';
      // }
    }
  }
  xmlHttp.send(parameters);
}

function validateDeleteNote() {
  
}
  
  
function ShowPopUp() {
  var popup = document.getElementById("jazzPopUp");
  popup.classList.toggle("noteDeletePopUpConShow"); 
}
  
  
function btnSwitch() {
  let btns = document.querySelectorAll('#jazzBtn1, #jazzBtn2, #jazzBtn3');
  let tables = document.querySelectorAll('#jazzTableBotDay, #jazzTableBotDay1, #jazzTableBotDay2');
  btns.forEach(function(btn) {
    btn.addEventListener('click', () => {
      btns.forEach(b => b.classList.remove('jazzSwitchActive'));
      btn.classList.add('jazzSwitchActive');
      tables.forEach(t => t.classList.remove('jazzTableBottomShow'));
      for(i = 0; i < btns.length; i++) {
        if(btn === btns[i]) {
          tables[i].classList.add('jazzTableBottomShow');
        }
      }
    });
  });  
}
  
  
  
function paymentSwitch() {
  let btns = document.querySelectorAll('.paymentSelector');
  let radio = document.querySelectorAll('.paymentSelectorRadio');
  
  btns.forEach(function(btn) {
      btn.addEventListener('click', () => {
      
          btns.forEach(b => b.classList.remove('btn-primary'));
          
          btn.classList.add('btn-primary');
          
          radio.forEach(t => t.checked = false);
          
          for(i = 0; i < btns.length; i++) {
              
              if(btn === btns[i]) {
                  radio[i].checked = true;  
              };
          };
      });
  });  
}
  

// input field checker
function checkLoginData() {
  var name = document.getElementById("inputUser");
  var password = document.getElementById("inputPassword");
  name.addEventListener("keyup", function() {
    if (checkInputName(name)) {    
      name.classList.remove("inputBorderRed");
      name.classList.add("inputBorderGreen");
    } else {
      name.classList.add("inputBorderRed");
    }
  })
  password.addEventListener("keyup", function() {
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
  const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;;
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

function checkRegisterData() {
  var name = document.getElementById("inputUserRegis");
  var email = document.getElementById("inputEmailRegis");
  var password = document.getElementById("inputPasswordRegis");
  name.addEventListener("keyup", function() {
    if (checkInputName(name)) {    
      name.classList.remove("inputBorderRed");
      name.classList.add("inputBorderGreen");
    } else {
      name.classList.add("inputBorderRed");
    }
  })
  email.addEventListener("keyup", function() {
    if (checkInputEmail(email)) {    
      email.classList. remove("inputBorderRed");
      email.classList.add("inputBorderGreen");
    } else {
      email.classList.add("inputBorderRed");
    }
  })
  password.addEventListener("keyup", function() {
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


// input field checker payment
function checkDonateData() {
  var price = document.getElementById("inputPrice");
  price.addEventListener("keyup", function() {
    if (checkInputNumb(price)) {    
      price.classList.remove("inputBorderRed");
      price.classList.add("inputBorderGreen");
    } else {
      price.classList.add("inputBorderRed");
    }
  })
}

// validate amount credential
function validateDonate() {
  var amount = document.getElementById("inputPrice");
  var errorMess = document.getElementById("donateError");
  errorMess.textContent = null;
  if(isEmptyValue(amount.value)) {
    errorMess.textContent = "The amount can not be empty.";
    return false;
  } else if   (!checkInputNumb(amount)) {    
    errorMess.textContent = "The amount is not valid.";
    return false;
  } 
}
