// input field checker payment
function checkDonateData() {
    var price = document.getElementById("inputPrice");
    price.addEventListener("keydown", function() {
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
  
  function NoteDeletePopup() {
    
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