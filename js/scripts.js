// // Refresh the #results div every 1 second to get the latest details.

$(document).ready(function(){
  setInterval(function(){
        $("#showresults").load(window.location.href + " #showresults" );
  }, 1000);
  });
  