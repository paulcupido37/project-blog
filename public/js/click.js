$(document).ready(function() {
   
   obj = document.getElementById('testLink');
   div1 = $('#button1').click(function(){
       $('#testing1').toggle();
   });
   div2 = $('#button2').click(function(){
       $('#testing2').toggle();
   });
   
   div1.onclick = showDiv1;
   
   obj.onmousedown = mouseStatus;
   obj.onmouseup   = mouseStatus;
   obj.onclick     = mouseStatus;
   obj.ondblclick  = mouseStatus;
  
});

function showDiv1() {
    
}

function showDiv2() {
    document.getElementById("testing2").toggle();
}

function mouseStatus(e) {
  
    if (!e) {
        e = window.event;
    }
    
    btn = e.button;
    whichone = (btn < 2) ? "Left" : "Right";
    message = e.type + " : " + whichone + "</br>";
    document.getElementById("testarea").innerHTML += message;

}