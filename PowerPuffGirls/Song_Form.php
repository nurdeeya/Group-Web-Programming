<?php
session_start();
//check if session exists
if (isset($_SESSION["UID"])) {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
  <title> Song Collection </title>
    <meta charset="UTf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Form.css">
    
        <style>
            body {
                display: flex;
                height: 100vh;
                justify-content: center;
                align-items: center;
                padding: 10px;
            }

            .container {
                max-width: 500px;
                width: 100%;
                background-color:white;
                border-radius: 5px;
                padding: 20px;
            }

            .container .title {
                font-size: 25px;
                font-weight: 500;
                position: relative;
            }

            .container .title::before {
                content: "";
                position: absolute;
                left: 0;
                bottom: 0;
                height: 3px;
                width: 30px;
               
            }
        </style>
    </head>
    <body>
        <div class="container">
        <h1>Song Collection Form</h1>
            <p><b>Enter song details:</b></p>
            <p style="color:red;"><i>*ALL fields are required</i></p>
            <form name="songForm" action="Song_Register.php" method="POST">

                Song Title: <input type="text" name="Song" size="15" required autofocus>
                <br><br> Song Artist/Band: <input type="text" name="Artist" size="15" required autofocus>
                <br><br> Song Genre:
               
                <select id="songs" name="Genre" class="form-control" onchange="showfield(this.options[this.selectedIndex].value)" required autofocus>
                    <option value="">-Please Choose-</option>
                    <option value="rock">Rock</option>
                    <option value="jazz">Jazz</option>
                    <option value="country">Country</option>
                    <option value="pop">Pop</option>
                </select>
                <br>
                <br> Song Language: <input type="text" name="Language" size="15" maxlength="50" required autofocus>
                <br><br> Release Date: <input type="date" name="Date" required autofocus>
                <br><br> Audio/Video (URL): <input type="url" name="Link" size="30"  required autofocus>

                <br><br>
                <div class="button-container">
        <input type="submit" value="Display Song Details" class="form-button">
        <input type="reset" value="Cancel" class="form-button" onclick="window.location.href='SongMenu.php';">
        
    </div>

            </form>
        </div>
        <script>
            function validateForm() {
                var urlInput = document.getElementById("urlInput");
                var urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;

                if (!urlPattern.test(urlInput.value)) {
                    alert("Please enter a valid URL for Audio/Video.");
                    urlInput.focus();
                    return false;
                }

                return true;
            }
        </script>
    </body>

    </html>
<?php
} else {
    echo "No session exists or session has expired. Please log in again.<br>";
    echo "<a href=login.html> Login </a>";
}
?>