<?php
session_start();
//check if session exists
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            text-align: left;
        }

        h2 {
            color: white;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .field {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 4px;
            border-bottom: 1px solid #ddd;
            width: 100%;
        }

        .field label {
            font-weight: bold;
            width: 30%;
            padding-right: 10px;
        }

        .field span {
            width: 65%;
            overflow-wrap: break-word;
        }

        .field-box {
            text-align: left;
            margin-bottom: 15px;
        }

        select {
            width: 60%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
        }

        input[type="submit"] {
            background-color: grey;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: black;
        }

        p {
            color: #555;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "song_details";

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if SongId is set in the POST data
            if (isset($_POST["SongId"])) {
                $selectedSongId = $_POST["SongId"];

                // Fetch the selected record from the database
                $querySelect = "SELECT * FROM Song WHERE SongId = $selectedSongId";
                $resultSelect = $conn->query($querySelect);

                if ($resultSelect->num_rows > 0) {
                    $selectedRow = $resultSelect->fetch_assoc();
                }
            }

            // Check if the form for updating status is submitted
            if (isset($_POST["updateStatus"])) {
                $newStatus = $_POST["newStatus"];
                $updateQuery = "UPDATE Song SET Registration_Status = '$newStatus' WHERE SongId = $selectedSongId";
                $conn->query($updateQuery);

                // Redirect back to the main page after updating the status
                header("Location: Songview_Admin.php");
                exit();
            }

            $conn->close();
        }
    ?>

    <h2>Edit Status</h2>

    <?php if (isset($selectedRow)) : ?>
        <div class="container">
            <div class="field">
                <label>Song Title:</label>
                <span><?php echo $selectedRow["SongTitle"]; ?></span>
            </div>
            <div class="field">
                <label>Artist/Band:</label>
                <span><?php echo $selectedRow["ArtistName"]; ?></span>
            </div>
            <div class="field">
                <label>Genre:</label>
                <span><?php echo $selectedRow["SongGenre"]; ?></span>
            </div>
            <div class="field">
                <label>Language:</label>
                <span><?php echo $selectedRow["SongLanguage"]; ?></span>
            </div>
            <div class="field">
                <label>Release Date:</label>
                <span><?php echo $selectedRow["ReleaseDate"]; ?></span>
            </div>
            <div class="field">
                <label>Audio/Video (URL):</label>
                <span><?php echo $selectedRow["Audio_Url"]; ?></span>
            </div>
            <div class="field">
                <label>User:</label>
                <span><?php echo $selectedRow["User_Song"]; ?></span>
            </div>
            <div class="field">
                <label>Current Status:</label>
                <span><?php echo $selectedRow["Registration_Status"]; ?></span>
            </div>

            <form action="EditUpdateStatus.php" method="POST">
                <div class="field-box">
                    <label for="newStatus"><b>New Status:</b></label>
                    <select name="newStatus" required>
                        <option value="">--Pending--</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>

                <input type="hidden" name="SongId" value="<?php echo $selectedRow["SongId"]; ?>">
                <input type="submit" name="updateStatus" value="Update Status">
            </form>
        </div>
    <?php else : ?>
        <p>No data selected or record not found.</p>
    <?php endif; ?>
</body>
</html>
<?php
}
else
{
echo "No session exists or session has expired. Please
log in again.<br>";
echo "<a href=login.html> Login </a>";
}
?>