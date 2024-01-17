<?php
session_start();
//check if session exists
if(isset($_SESSION["UID"])) {
?>

<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Collection - Update Details</title>
  <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: white;
            padding: 10px;
      background-color: grey;

        }

        p {
            color: white;
        }

        table {
            width: 50%;
            margin: 50px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        table, th {
            border: 1px solid #ddd;
        }

        th, td{
            padding: 15px;
            text-align: left;
        }
    td{
      font-weight:bold;
      border: 1px solid #ddd;
    }

        th {
            background-color: #333;
            color: white;
        }

        input[type="text"],
        input[type="date"],
        input[type="url"],
        select {
            width: calc(100% - 10px);
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid grey;
            box-sizing: border-box;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: grey;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    input[type="submit"]:hover {
      background-color: black;

    }
    </style>
</head>

<body>
<h2>Song Collection Details</h2>

<p style="color:green;font-weight:bold;"> Update Song details </p>

<?php 
$SongId = $_POST["SId"];

$host = "localhost"; 
$user = "root";
$pass = "";
$db = "song_details";

$conn = new mysqli ($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

else
{
  $queryGet = "SELECT * FROM SONG WHERE SongId = '".$SongId."' ";
  $resultGet = $conn->query($queryGet);
  
  if ($resultGet->num_rows > 0) {
?>

<form action="SongEdit_Save.php" name="UpdateForm" method="POST" >
<?php
 while($row = $resultGet->fetch_assoc()) {
?>
<table>  
<tr>
        <th colspan="2">Song Id:<?php echo $row["SongId"]; ?></th>
    </tr>
<br><br>
<tr>
 <td>Song Title:</td> <td> <input type="text" name="Song" value="<?php echo $row["SongTitle"]; ?>" size="15"  required></td>
 </tr>
<br><br>
<tr>
<td>Song Artist/Band:</td> <td><input type="text" name="Artist" value="<?php echo $row["ArtistName"]; ?>" size="15"  required></td>
</tr>
<br><br>
<tr>
<td>Song Genre:</td> 
<?php $songGenre = $row["SongGenre"]; ?>
<td>
<select id="songs" name="Genre" class="form-control" onchange="showfield(this.options[this.selectedIndex].value)" required autofocus>
  <option value="">-Please Choose-</option>
  <option value="rock" <?php if ($songGenre == "rock") echo "selected"; ?>> Rock</option>
  <option value="jazz" <?php if ($songGenre == "jazz") echo "selected"; ?>> Jazz</option>
  <option value="country" <?php if ($songGenre == "country") echo "selected"; ?>> Country</option>
  <option value="pop" <?php if ($songGenre == "pop") echo "selected"; ?>> Pop</option>
</select>
</td>
</tr>
<br><br>
<tr>
<td>Song Language:</td> <td><input type="text" name="Language" value="<?php echo $row["SongLanguage"]; ?>" size="15" maxlength="50" required></td>
</tr>
<br><br>
<tr>
<td>Release Date:</td><td> <input type="date" name="Date" value="<?php echo $row["ReleaseDate"]; ?>" required ></td>
</tr>
<br><br>
      <tr>
<td>Audio/Video (URL):</td><td> <input type="text" name="Link" value="<?php echo $row["Audio_Url"]; ?>" size="15" min="5" required></td>
      </tr>
<br>
</table>
<br>
<input type="hidden" name="SongId" value="<?php echo $row["SongId"]; ?>">
<input type="Submit" value="Update New Details">
</form>

<?php
    }
  }
}
$conn->close();
?>

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