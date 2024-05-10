document.addEventListener('DOMContentLoaded', function() {
    // Check if the error parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    
    if (error === '2') {
        // If error parameter is present, display the notification
        displayErrorNotification();
    } else if (error === '3') {
        // If error parameter is 3, show alert for incorrect password
        alert("Password is incorrect.");
    }

    // Function to display error notification
    function displayErrorNotification() {
        const notificationDiv = document.createElement('div');
        notificationDiv.innerHTML = '<div class="alert alert-danger" role="alert">Username or password is incorrect or not registered in our system. Please contact the developer if you forgot username or password.</div>';
        document.body.appendChild(notificationDiv);
    }

    
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var username = document.getElementsByName('username')[0].value;
        var password = document.getElementsByName('password')[0].value;

        if (username.trim() !== '' && password.trim() !== '') {
            var confirmation = confirm("Are you sure you want to login?");
            if (confirmation) {

                this.submit();
            }
        } else {
            alert("Please fill out both username and password fields to login.");
        }
    });
}); 
var showInfoButtons = document.querySelectorAll('.show-info-btn');

showInfoButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    var profileInfo = this.nextElementSibling;
    if (profileInfo.style.display === 'block') {
      profileInfo.style.display = 'none';
    } else {
      profileInfo.style.display = 'block';
    }
  });

});
