document.addEventListener('DOMContentLoaded', function() {
  
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    
    if (error === '2') {
      
        displayErrorNotification();
    } else if (error === '3') {
        
        alert("Password is incorrect.");
    }

  
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
             
                if (username.toLowerCase() === 'admin') {
                    window.location.href = 'https://localhost/project/admin.php';
                } else {
                    window.location.href = 'index.html';
                }
            }
        } else {
            alert("Please fill out both username and password fields to login.");
        }
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

});