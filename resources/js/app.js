$(document).foundation()



function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}


function signOut(googleUser) {
	alert ("Sign Out Successful");
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
  });
}


function add_fields() {
   var d = document.getElementById("content");
  
   d.innerHTML += "<br /><span>Break Time <input type="time" name="breakTime" requried pattern="HH:MM" placeholder="breakTime" required></span>;"
 }