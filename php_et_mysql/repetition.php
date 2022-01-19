<?php

$email = isset($_POST['mail']);
$message = isset($_POST['message']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
>
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" class="m-3">
        <div class="mb-3">
            <label for="mail" class="form-label">E-mail</label>
            <input type="mail" name="mail" id="mail" class="form-control">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Votre message</label>
            <textarea name="message" id="message" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Votre capteur d'ecrean</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <!--data form-->
    <?php if( (isset($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) || (isset($_POST['message']) && empty($_POST['message']))) :?>

        <h1>Message bien recu</h1>
        <p><strong>Email</strong> : <?= $email ?></p>
        <p><strong>Message</strong> : <?= strip_tags($message) ?></p>

    <?php endif ?>

    <!--verrify file error-->
    <?php if(isset($_FILES['file']) && $_FILES['file']['error'] ==0) : ?>
        <?php if($_FILES['file']['size'] <= 1000000) : ?>

            <?php
                $fileInof = pathinfo($_FILES['file']['name']);
                $extension = $fileInof['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if(in_array($extension, $allowedExtensions)) {
                    
                    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.basename($_FILES['file']['name']));
                }
            ?>
        <?php endif ?>
    <?php endif ?>
</body>
</html>
<?php

