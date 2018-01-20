/**
index.js 
This file strictly is dealing with the authentication of the page.
currently authentication is being trusted to google sign in due to it being the most secure
without having to create all the security on the web developer side. 
All authentication is taken care of with the google.api 
*/

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  $_SESSION['userName'] = profile;
  window.location.replace("http://augsac/userpage.php");
}

function signOut() {
   var auth2 = gapi.auth2.getAuthInstance();
   auth2.signOut().then(function () {
   console.log('User signed out.');
  });
}