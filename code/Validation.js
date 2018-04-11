function validate() {
	var songName = document.getElementById("SongName");
	var songArtist = document.getElementById("SongArtist");
	var songURL = document.getElementById("SongURL");
	var errorShow = document.getElementsByClassName("errorMes");
	var errorMessages = document.getElementById("errorMessages");
	var errorMessage = "";

	if (!String.prototype.trim) {
		String.prototype.trim = function () {
			return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
		};
	}

	name = trim(document.forms["SongForm"]["Name"]);
	artist = trim(document.forms["SongForm"]["Artist"]);
	link = trim(document.forms["SongForm"]["Link"]);
	var expression = /((http|https):\/\/)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/gi
	var regex = new RegExp(expression);
	var validLink = link.match(regex);

	if (name.length === 0) {
		errorShow[0].classList.toggle("hide");
		songName.classList.add("error");
		errorMessage += "Enter a Song Name.\n";
	}

	if (artist.length === 0) {
		errorShow[1].classList.toggle("hide");
		songArtist.classList.add("error");
		errorMessage += "Enter a Artist Name.\n";
	}

	if (link.length === 0) {
		errorShow[2].classList.toggle("hide");
		songLink.classList.add("error");
		errorMessage += "Enter a Song Link.\n";
	} else if (!validLink) {
		errorShow[2].classList.toggle("hide");
		songLink.classList.toggle("hide");
		errorMessage += "Enter a valid Song Link.\n";
	}
	
	if (errorMessage.length === 0) {
		return true;
	}

	return false;

}