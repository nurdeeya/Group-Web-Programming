<?php
session_start();
if(isset ($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Song Collection - Update Save</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .success-message {
            color: #008000;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .error-message {
            color: #FF0000;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        
            $SongId = $_POST["SongId"];
            $songTitle = $_POST["Song"];
            $songArtist = $_POST["Artist"];
            $songGenre = $_POST["Genre"];
            $songLanguage = $_POST["Language"];
            $songDate = $_POST["Date"];
            $songLink = $_POST["Link"];

            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "song_details";

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $queryUpdate = "UPDATE SONG SET
                                SongTitle = '".$songTitle."', ArtistName = '".$songArtist."', SongGenre = '".$songGenre."',
                                SongLanguage =  '".$songLanguage."', ReleaseDate =  '".$songDate."', Audio_Url ='".$songLink."'
                                WHERE SongId ='".$SongId."'";

                if ($conn->query($queryUpdate) === TRUE) {
                    echo "<h2>Song Update Saved Successfully</h2>";
                    echo "<div class='success-message'>Record has been updated into the database</div>";
                    echo "<div class='back-link'><a href='Songview.php'>Back to Song Details</a></div>";
                } else {
                    echo "<h2>Error Updating Song</h2>";
                    echo "<div class='error-message'>Error updating record: " . $conn->error . "</div>";
                    echo "<div class='back-link'><a href='Songview.php'>Back to Song Details</a></div>";
                }
            }
            $conn->close();
        
        ?>
    </div>
</body>
</html>
<?php
 } else {
            echo "<h2>No session exists or session has expired</h2>";
            echo "<div class='error-message'>Please log in again.<br><a href='login.html'>Login</a></div>";
        }
?>