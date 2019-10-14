// Refresh the .container-fluid div every 5 seconds to get the latest details.
function loadlink() {
  $('.container-fluid').load('index.php', function () {
    $(this).unwrap();
  });
}

// If 
if (disableRefresh == "false") {
loadlink();
setInterval(function () {
  loadlink()
}, 5000);
}