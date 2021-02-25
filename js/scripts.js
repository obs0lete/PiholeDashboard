// // Refresh the #results div every 1 second to get the latest details.

$(document).ready(function(){
  setInterval(function(){
        $("#results").load(window.location.href + " #results" );
  }, 1000);
  });
  