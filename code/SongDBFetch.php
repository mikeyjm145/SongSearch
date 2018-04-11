<?php
        $host = "fdb19.awardspace.net";
        $user = "2664530_songs";
        $pass = "espn.com12";
        $name = "2664530_songs";
        $songs = array();
        
        $conn = mysqli_connect($host,$user,$pass,$name);
        if (!$conn) {
                die("Connection Failed: " . mysqli_connection_error());
        } else {
                $sql = "SELECT * FROM Songs";
                if ($result = mysqli_query($conn, $sql)) {
                        while($row = $result->fetch_assoc()) {
                                $songs[] = array($row['SongName'], $row['SongArtist'], $row['Link']);
                        }
                } else {
                        echo "Please try again later.";
                }
        }
        
        mysqli_close($conn);
?>