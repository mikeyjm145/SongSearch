<?php
        $host = "fdb19.awardspace.net";
        $user = "2664530_songs";
        $pass = "espn.com12";
        $name = "2664530_songs";
        $songs = array();

        function findDuplicates($link) {
                $isDup = 0;
                foreach ($songs as $key => $value) {
                    if ($link == $song['Link']) {
                            $isDup = 1;
                            break;
                    }
                }

                return $isDup;
        }
        
        $conn = mysqli_connect($host,$user,$pass,$name);
        if (!$conn) {
                die("Connection Failed: " . mysqli_connection_error());
        } else {
                $sql = "SELECT * FROM Songs";
                if ($result = mysqli_query($conn, $sql)) {
                        while($row = $result->fetch_assoc()) {
                                if (findDuplicates($row['Link']) == 0) {
                                        $songs[] = array($row['SongName'], $row['SongArtist'], $row['Link'], $row['id']);
                                }
                        }
                } else {
                        echo "Please try again later.";
                }
        }
        
        mysqli_close($conn);

?>

<script type="text/javascript" charset="utf-8">
var songList = <?php echo json_encode($songs); ?>;

function processDatabaseData() {
        const data = <?php echo json_encode($songs); ?>;
        return data;
}

function createLink(link) {
        const a = document.createElement("a");
        a.href = link;
        a.target = "_blank";
        a.innerHTML = "Link";
        return a;
}

function createButton(rowID) {
        const button = document.createElement("button");
        button.setAttribute("onclick", "copySongData(event, "+ rowID +")");
        button.setAttribute("class", "copyButton");
        button.id = "b" + rowID;
        button.setAttribute("name", "copy");
        button.appendChild(document.createTextNode("Copy"));

        return button;
}

function createTable() {
        var dataTH = ["Song Name", "Artist", "Link", ""];
        var dataTD = processDatabaseData();
        
        var songs = document.createElement("table");
        songs.setAttribute("id", "Songs");
        var songTB = document.createElement("tbody");
        
        var tr = document.createElement("tr");
        tr.setAttribute("id", "songTHR");
        
        dataTH.forEach(function (dataRow) {
                var thn = document.createElement("td");
                thn.setAttribute("class", "songTH");
                thn.appendChild(document.createTextNode(dataRow));
                tr.appendChild(thn);
        });
        
        songTB.appendChild(tr);
        
        dataTD.forEach(function (dataRow) {
                var row = document.createElement("tr")
                row.setAttribute("id", dataRow[3]);
                row.setAttribute("class", "dataRows");
                row.style.display = "";
                
                
                for (var i = 0; i < dataRow.length; i++) {
                        if (i === 2) {
                                var songURL = createLink(dataRow[i]);
                                cell = document.createElement("td");
                                cell.setAttribute("class", "dataCells");
                                cell.appendChild(songURL);
                                row.appendChild(cell);
                        } else if (i === 3) {
                                var songCopy = createButton(dataRow[i]);
                                cell = document.createElement("td");
                                cell.setAttribute("class", "dataCells");
                                cell.appendChild(songCopy);
                                row.appendChild(cell);
                        } else {
                                cell = document.createElement("td");
                                cell.setAttribute("class", "dataCells");
                                cell.appendChild(document.createTextNode(dataRow[i]));
                                row.appendChild(cell);
                        }
                }
                songTB.appendChild(row);
        });
        
        
        songs.appendChild(songTB);
        document.body.appendChild(songs);

        return processDatabaseData();
}
</script>