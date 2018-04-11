<form name="SongForm" action="/../code/AddSongAction.php" onsubmit="return validate()" method="post">
	<p class="errorMes hide"></p>
	Song Name<span class="errorMes hide">***</span>:
	<br>
	<input id="SongName" type="text" name="Name">
	<br><br>

	Artist<span class="errorMes hide">***</span>:
	<br>
	<input id="SongArtist" type="text" name="Artist">
	<br><br>

	Link<span class="errorMes hide">***</span>:<br>
	<input id="SongURL" type="url" name="Link">
	<br><br>
	<input type="submit" value="Add">
</form> 