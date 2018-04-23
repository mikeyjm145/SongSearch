<!DOCTYPE html>
<html>

<head>
        <title>WCIC Songs</title>
        <script type="text/javascript" charset="utf-8" src="/code/SongCollapsible.js"></script>
        <script type="text/javascript" charset="utf-8" src="/code/SongSearching.js"></script>
        
        <link rel="stylesheet" href="/code/main.css">
        <link rel="stylesheet" href="/code/menu.css">
        <link rel="stylesheet" href="/code/mediaQ.css">
</head>

<body>
        <div id="top"></div>
        <div id="navbar">
                <input type="text" class="rounded-input" id="myInput" onkeyup="limitedSearch()" onpaste="limitedSearch()" placeholder="Search for songs..." title="Type in a song">
                <select id="colSearch" class="custom-select rounded-input" onchange="reloadResults(event)">
                        <option selected class="defaultOption" value="-1">All Columns</option>
                        <option value="0">Song Name</option>
                        <option value="1">Song Artist</option>
                        <option value="2">Song Link</option>
                </select>
                <div id="headers" class="hide">
                        <table id="SongHeadersFloat">
                                <tr id="songTHR">
                                        <td class="songTH">Song Name</td>
                                        <td class="songTH">Artist</td>
                                        <td class="songTH">Link</td>
                                </tr>
                        </table>
                </div>
                <button id="backTop" onclick="window.location.href='#top'" class="hide">Back to top</button>
                <button id="minimize" onclick="hideSearch()">Hide Search</button>
        </div>
        
        <script type="text/javascript" charset="utf-8" src="/code/SongPageAnimations.js"></script>
        
        <div class="content">
                <?php include 'code/SongTableCreate.php';?>
        <div>
</body>

</html>