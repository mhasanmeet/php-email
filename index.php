<?php 

    require 'script.php';

    if(isset($_POST['submit'])){
        if(empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])){
            $response = "All fields are required";
        }else{
            $response = sendMail($_POST['email'], $_POST['subject'], $_POST['message']);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send email using PHPmailer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Send email to yourself</h1>
            
            <div class="">
                <label for="email">Enter your email</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="">
                <label for="subject">Enter your subject</label>
                <input type="text" id="subject" name="subject">
            </div>

            <div class="">
                <label for="message">Enter your subject</label>
                <textarea id="message" rows="10" cols="30" name="message"></textarea>
            </div>

            <input type="submit" value="Submit" name="submit">

            <?php 
                if(@$response == 'success'){
                ?>
                    <p class="success">Email send successfully</p>
                <?php
                }else{
                ?>
                    <p class="error"><?php echo @$response; ?></p>
                <?php
                }
            ?>
        </form>
    </div>
</body>
</html>