<?php
session_start();
if(isset ($_SESSION["UID"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Collection</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: White;
			font-style: 
        }

        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, td {
            border-radius: 10px solid #e0e0e0;
        }

        td {
            padding: 12px;
            text-align: left;
        }

        td b {
            color: black;
						
        }

        a {
            color: black;
            text-decoration: none;
            font-weight: bold;
			font-family: 'palatino';			

        }

		.font .a {
			font-family: 'palatino';
		}
        a:hover {
            text-decoration: underline;
        }

        .success-message {
            color: White;
        }

        .error-message {
            color: #f00;
        }

		.button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 8px;
			
        }

		.button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 8px;
            margin-top: 10px;
			margin-left: 50px;
			
			
			
        }

		.button {
            height: 45px;
            background: grey;
            border: none;
            outline: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            color: white;
            font-weight: 500;
            flex: 1;
           
		
        }
    </style>
</head>

<body>
    <?php
   
        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $songTitle = $_POST["Song"];
            $songArtist = $_POST["Artist"];
            $songGenre = $_POST["Genre"];
            $songLanguage = $_POST["Language"];
            $songDate = $_POST["Date"];
            $songLink = $_POST["Link"];

            // Database connection
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "song_details";

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $DBquery = "INSERT INTO SONG (SongTitle, ArtistName, SongGenre, SongLanguage, ReleaseDate, Audio_Url, User_Song)
                        VALUES ('$songTitle', '$songArtist', '$songGenre', '$songLanguage', '$songDate', '$songLink', '{$_SESSION["UID"]}')";

            if ($conn->query($DBquery) === TRUE) {
                $message = "Success: Song data inserted!";
                $messageClass = "success-message";
            } else {
                $message = "Error: " . $conn->error;
                $messageClass = "error-message";
            }

            $conn->close();
        }
   
    ?>

    <h1>Song Collection Details</h1>

    <?php if (isset($message)) : ?>
        <p class="<?php echo $messageClass; ?>"><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION["UID"])) : ?>
        <table border="1">
			<class="font">
            <tr>
                <td><a> Song Title:</a></td>
                <td><?php echo $songTitle; ?></td>
            </tr>
            <tr>
                <td><a>Song Artist/Band:</a></td>
                <td><?php echo $songArtist; ?></td>
            </tr>
            <tr>
                <td><a>Song Genre:</a></td>
                <td><?php echo $songGenre; ?></td>
            </tr>
            <tr>
                <td><a>Song Language:</a></td>
                <td><?php echo $songLanguage; ?></td>
            </tr>
            <tr>
                <td><a>Release Date:</a></td>
                <td><?php echo $songDate; ?></td>
            </tr>
            <tr>
                <td><a>Audio/Video (URL):</a></td>
                <td><b><a>CLICK <a href="<?php echo $songLink; ?>" target="_blank" style="font-family:palatino;">LINK</a></td>
            </tr>
        </table>

        <br><br>

	<div class="button-container">
		<form action="Song_Form.php" method="POST">
		<button type="submit" class="button" > Enter new Song </button>
		</form>
		<br><br>
	
		<form action="Songview.php" method="POST">
		<button type="submit"  class="button"  >  View Song details</button>
		</form>
	</div>
    <?php endif; ?>
</body>
</html>
<?php
}
else
{
echo "No session exists or session has expired. Please log in again.<br>"; 
echo "<a href='login.html'> Login </a>";
}
?>
