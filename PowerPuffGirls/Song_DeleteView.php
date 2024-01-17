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
            background-color: #f9ecc6; /* Light cream color */
            text-align: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333; /* Dark gray text color */
        }

        h2 {
            color:white;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        table, th, td {
            border: 1px solid #e0e0e0; /* Light gray border */
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: black;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8; /* Light gray background for even rows */
        }

        input[type="radio"] {
            transform: scale(1.5);
        }

        input[type="submit"], button {
            background-color: grey;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover, button:hover {
            background-color: black; /* Darker black on hover */
        }
    </style>
</head>

<body>
    

    <h2>Song Collection Details</h2>

    <form action="Song_Delete.php" method="POST" onsubmit="return confirm('Are you sure to delete this record?')">
        <table>
            <tr>
                <th>Choose</th>
                <th>Song Id</th>
                <th>Song Title</th>
                <th>Song Artist/Band</th>
                <th>Song Genre</th>
                <th>Song Language</th>
                <th>Release Date</th>
                <th>Audio/Video (URL)</th>
                <th>User</th>
                <th>Status</th>
            </tr>

            <?php
            $host = "localhost"; 
            $user = "root";
            $pass = "";
            $db = "song_details";

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $queryView = "SELECT * FROM SONG where User_Song = '".$_SESSION["UID"]."'";
                $resultView = $conn->query($queryView);

                if ($resultView->num_rows > 0) {
                    while($row = $resultView->fetch_assoc()) {
            ?>
                        <tr>
                            <td><input type="radio" name="SongId" value="<?php echo $row["SongId"]; ?>" required></td>
                            <td><?php echo $row["SongId"]; ?></td>
                            <td><?php echo $row["SongTitle"]; ?></td>
                            <td><?php echo $row["ArtistName"]; ?></td>
                            <td><?php echo $row["SongGenre"]; ?></td>
                            <td><?php echo $row["SongLanguage"]; ?></td>
                            <td><?php echo $row["ReleaseDate"]; ?></td>
                            <td><?php echo $row["Audio_Url"]; ?></td>
                            <td><?php echo $row["User_Song"]; ?></td>
                            <td><?php echo $row["Registration_Status"]; ?></td>
                        </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>NO data selected</td></tr>";
                }
            }
            $conn->close();
            ?>
        </table>

        <br><br>
        <input type="submit" value="Delete Selected Record">
        <p><button type="button" onclick="window.location.href='SongMenu.php'"><b>MENU</b></button></p>
    </form>

   
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
