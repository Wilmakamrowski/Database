var objPeople = [
	{ // Object @ 0 index
		username: "admin",
		password: "password"	}

]

function getInfo() {
	var username = document.getElementById('username').value
	var password = document.getElementById('password').value

	for(var i = 0; i < objPeople.length; i++) {
		// check is user input matches username and password of a current index of the objPeople array
		if(username == objPeople[i].username && password == objPeople[i].password) {
			location.replace("https://cs2s.yorkdc.net/~william.hill1/CRUDtest/AdminLogIndex.php")
			// stop the function if this is found to be true
			return
		}
	}
	console.log("incorrect username or password")
}