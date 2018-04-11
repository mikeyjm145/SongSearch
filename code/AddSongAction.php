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
                $sql = "SELECT * FROM Songs WHERE id='" + $_POST['id'] + "'" ;
                //Get add query
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
function copySongData(index) {
    var copy = ""
    songData.forEach(function (dataRow) {
            if (index == dataRow[4]) {
                    copy = dataRow[0] + " - " + dataRow[1] + "\nLink" + dataRow[2];
                    document.execCommand("copy", false, copy);
                    return;
            }
    });
}
</script>