


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




/*Toggle checkboksene på artistboksene og albumboksene*/
$(document).ready(function(){
    $("#slettArtister").click(function(){
      $(":checkbox").toggle();
    });
  });





