<?php
        $host = "fdb19.awardspace.net";
        $user = "2664530_songs";
        $pass = "espn.com12";
        $name = "2664530_songs";
        $songs = array();
        
        function getID($url) {
                $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/';
                preg_match($regExp, $url, $match);

                if (strlen($match[2]) == 11) {
                        return $match[2];
                }
                
                return 0;
        }
        
        function brokenLink($link) {
                $theURL = "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=".getID($link)."&fields=etag%2CeventId%2Citems%2Ckind%2CnextPageToken%2CpageInfo%2CprevPageToken%2CtokenPagination%2CvisitorId&key=AIzaSyC8XTpq-sUC--ZjWJDySpKTe890rG45B_g";
                //$theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=".getID($link)."&format=json";
                $headers = @get_headers($theURL);
                //$code = substr($headers[0], 9, 3);
                var_dump($headers);
            
                return $code === "404";
        }
        
        function findDuplicates($link) {
                if (empty($songs)) {
                        return 0;
                }
                
                foreach ($songs as $key => $value) {
                    if ($link === $value['Link']) {
                        return 1;
                    }
                }

                return 0;
        }
        brokenLink('https://www.youtube.com/watch?v=mBwXHpKVS5I');
        $conn = mysqli_connect($host,$user,$pass,$name);
        if (!$conn) {
                die("Connection Failed: " . mysqli_connection_error());
        } else {
                $sql = "SELECT * FROM Songs";
                if ($result = mysqli_query($conn, $sql)) {
                        while($row = $result->fetch_assoc()) {
                                //brokenLink($row['Link']);
                                if (findDuplicates($row['Link']) === 0) {
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
function processDatabaseData() {
        var data = <?php echo json_encode($songs); ?>;
        return data;
}

function createLink(link) {
        var a = document.createElement("a");
        a.href = link;
        a.target = "_blank";
        a.innerHTML = "Link";
        return a;
}

function createButton(rowID) {
        const button = document.createElement("button");
        button.setAttribute("onclick", "copySongData(event, "+ rowID +")");
        button.setAttribute("class", "stdButton");
        button.id = "b" + rowID;
        button.setAttribute("name", "copy");
        button.appendChild(document.createTextNode("Copy"));

        return button;
}

function createTable() {
        var dataTH = ["Song Name", "Artist", "Link", "Actions"];
        var dataTD = processDatabaseData();
        var count = 0;
        
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
                var row = document.createElement("tr");
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
                count++;
        });
        
        document.body.appendChild(document.createTextNode(count))
        songs.appendChild(songTB);
        document.body.appendChild(songs);
}
createTable();
</script>