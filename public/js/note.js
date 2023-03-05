function ajaxGetNotes(id, conUrl) {
  var xmlHttp = new XMLHttpRequest();
  var url = conUrl;
  var parameters = "?JazzTicketId=" + id;
  xmlHttp.open("GET", url + parameters, true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.onreadystatechange = function() {
    if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      var jsonData = JSON.parse(xmlHttp.responseText);
      
      
      
    }
  }
  xmlHttp.send(parameters);
}