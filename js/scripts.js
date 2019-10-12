// Reload Pi-hole stats every 5 seconds
// this will refresh the .container-fluid div every 5 seconds to get fresh stats
function loadlink() {
  $('.container-fluid').load('index.php', function () {
    $(this).unwrap();
  });
}

loadlink(); // This will run on page load
setInterval(function () {
  loadlink() // This will run after every 5 seconds
}, 5000);