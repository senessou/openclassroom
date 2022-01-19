<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Site de recettes - formulaire recu</title>
</head>
<body>
    <h1>Message bien recu </h1>

    <div class="card"> 
        <div class="card-body">
            <h5 class="card-title">Rappel de vos informations</h5>
            <?php if ( 
                (isset($_GET['email']) || filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
                || (isset($_GET['message']) && empty($_GET['message']) )   
                ) :?>
            <p class="card-text"><b>Email</b> : <?php echo $_GET['email']; ?></p>
            <p class="card-text"><b>Message</b> : <?php echo strip_tags($_GET['message']); ?></p>
            <?php endif ?>

            <!--verifier si le fichier est bien arriver-->
            <?php if(isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0){

                //verifier la taille du fichier
                if($_FILES['screenshot']['size'] <= 1000000)
                {
                    //verifier l'extension du fichier
                    $fileinfo =  pathinfo($_FILES['screenshot']['name']);
                    $extension  = $fileinfo['extension'];
                    $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
                    if(in_array($extension, $allowedExtensions)) {
                        //On valide le fichier 
                        move_uploaded_file($_FILES['screenshot']['tmp_name'], 'uploads/'. basename($_FILES['screenshot']['name']));
                        echo 'l envoi a été bien effectué !';
                    }
                }
            }
            ?>
        </div>
        
    </div>
</body>
</html>