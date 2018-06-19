$(document).ready(function() {
	$("#login_button").on('click', function (e) {
		e.preventDefault();
		us=$('#inputEmail').val();
		pass=$('#inputPassword').val();
		if(us === '' || pass==='')
		{
			alert('Enter the Username/Password');
		}
		else
		{
			var dataString = "username="+us+"&password="+encodeURIComponent(pass);
		$.ajax({
			url: 'Home.php',
			type: 'POST',
			data: dataString,
			success: function(data){
				if(data == 'NotMatched') {
					alert('Username/Password Incorrect');
				} else if(data == 'NotPresent') {
					alert('User ID does not Exists');
				} else {
					window.location.href = 'dashboard.php';
				}
			}
		});
		
	}
});

});


function logout()
{
   window.location.href ="logout.php";
}