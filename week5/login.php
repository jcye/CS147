<!DOCTYPE html> 
<html>

<head>
	<title>VoteCaster | Login</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery.mobile-1.2.0.css" />
	<link rel="stylesheet" href="style.css" />
	<link rel="apple-touch-icon" href="appicon.png" />
	<link rel="apple-touch-startup-image" href="startup.png">
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>

</head>  
<body> 

<div data-role="page">
	<div data-role="header">
	<h1>Log in</h1>
	<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">
	




 <div id="fb-root"></div>
  <script>
    (function() {
      var e = document.createElement('script'); e.async = true;
          e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
          document.getElementById('fb-root').appendChild(e);
          }());
  </script>
  
  <script>
    window.fbAsyncInit = function() {
      FB.init({ appId: '296344457137837', 
      status: true, 
      cookie: true,
      xfbml: true,
      oauth: true});
 
      FB.Event.subscribe('auth.statusChange', handleStatusChange);	
    };
  </script>
  
  <script>
   function handleStatusChange(response) {
     document.body.className = response.authResponse ? 'connected' : 'not_connected';
    
     if (response.authResponse) {
       console.log(response);
       updateUserInfo(response);
     }
   }
   </script>
   
   <div id="login">
     <p><button onClick="loginUser();">Login</button></p>
   </div>
   <div id="logout">
     <div id="user-info"></div>
     <p><button  onClick="FB.logout();">Logout</button></p>
   </div>
   
  <script>
    function loginUser() {    
      FB.login(function(response) { }, {scope:'email'});  	
    }
  </script>
  
  <style>
    body.connected #login { display: none; }
    body.connected #logout { display: block; }
    body.not_connected #login { display: block; }
    body.not_connected #logout { display: none; }
  </style>
  
  <div id="user-info"></div>
  <script>
    function updateUserInfo(response) {
      FB.api('/me', function(response) {
        document.getElementById('user-info').innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
      });
    }
  </script>

  <a href="#" onclick="getUserFriends();">Get friends</a><br>
  <div id="user-friends"></div>
  <script>
  function getUserFriends() {
    FB.api('/me/friends&fields=name,picture', function(response) {
      console.log('Got friends: ', response);
      
      if (!response.error) {
        var markup = '';
        
        var friends = response.data;
        
        for (var i=0; i < friends.length && i < 25; i++) {
          var friend = friends[i];
          
          markup += '<img src="' + friend.picture.data.url + '"> ' + friend.name + '<br>';
        }
        
        document.getElementById('user-friends').innerHTML = markup;
      }
    });
  }
  </script>
 
  <a href="#" onclick="publishStory();">Publish feed story</a><br>
  <script>
  function publishStory() {
    FB.ui({
      method: 'feed',
      name: 'I\'m building a social mobile web app!',
      caption: 'This web app is going to be awesome.',
      description: 'Check out Facebook\'s developer site to start building.',
      link: 'http://www.facebookmobileweb.com/hello',
      picture: 'http://www.facebookmobileweb.com/hackbook/img/facebook_icon_large.png'
    }, 
    function(response) {
      console.log('publishStory response: ', response);
    });
    return false;
  }
  </script>
  
  <a href="#" onclick="sendRequest();">Send request</a><br>
  <script>
  function sendRequest() {
    FB.ui({
      method: 'apprequests',
      message: 'invites you to learn how to make your mobile web app social',
    }, 
    function(response) {
      console.log('sendRequest response: ', response);
    });
  }
  </script>








	<div data-role="fieldcontain">
		
	</div>	
	
		
	<div id="info">
		<p>Thank you for logging. You should be able to see all sorts of user information here.</p>
	</div>	
	</div><!-- /content -->

    <div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="c">
		<ul>
			<li><a href="index.php" id="home" data-icon="custom">Home</a></li>
			<li><a href="login.php" id="key" data-icon="custom" class="ui-btn-active">Login</a></li>
			<li><a href="filter.php" id="filter" data-icon="custom">Filter</a></li>
			<li><a href="#" id="setting" data-icon="custom">Settings</a></li>
		</ul>
		</div>
	</div>
	<script type="text/javascript">
	$("#logout").hide();
	$("#info").hide();
	var retrievedObject = localStorage.getItem('username');
	if (retrievedObject == "test") {
		$("#form").hide();	
		$("#logout").show();
		$("#info").show();
	}
	$("#logout").click(function() {
		localStorage.removeItem('username');
		$("#form").show();
		$("#logout").hide();
		$("#info").hide();
	});
	</script>
</div><!-- /page -->

</body>
</html>