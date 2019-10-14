// Refresh the .container-fluid div every 5 seconds to get the latest details.
function loadlink() {
  $('.container-fluid').load('index.php', function () {
    $(this).unwrap();
  });
}

// Disable div refresh if disableRefresh = "true"
if (disableRefresh == "false") {
loadlink();
setInterval(function () {
  loadlink()
}, 5000);
}