


/*

//Funksjon for å putte variablene til alle checkboksene i et array
var values = (function() {
    var a = [];
    
    $(":checkbox:checked").each(function() {
        a.push(this.value);
    });
    return a;
})()
*/


$(document).ready(function(){
    $("#slettArtister").click(function(){
      $(":checkbox").toggle();
    });
  });





