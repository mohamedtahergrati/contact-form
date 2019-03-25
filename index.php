<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body{
            padding-top: 50px;
        }

        .starter-template{
            padding-top: 40px;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Contact</a>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="starter-template">

            <?php if(array_key_exists('errors', $_SESSION)): ?>
                <div class="alert alert-danger">
                    <?= implode('<br/>', $_SESSION['errors']); ?>
                </div>
            <?php endif; ?>
            <?php if(array_key_exists('success', $_SESSION)): ?>
                <div class="alert alert-success">
                    Votre mail a été bien envoyé
                </div>
            <?php endif; ?>
            <form action="post_contact.php" method="POST">

                <div class="row">
                    <div class="col-xs-4 row">
                        <div class="form-group">
                            <label for="inputname">Votre nom</label>
                            <input required type="text" name="name" class="form-control" id="inputname" value="<?= isset($_SESSION['inputs']['name']) ? $_SESSION['inputs']['name'] : ''; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="inputemail">Votre email</label>
                            <input required type="email" name="email" class="form-control" id="inputemail"  value="<?= isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email'] : ''; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="inputservice">Service</label>
                            <select required name="service" id="inputservice">
                                <option value="0">Contact</option>
                                <option value="1">Dépanage</option>
                                <option value="2">Salon</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="inputmessage">Votre message</label>
                            <textarea required id="inputmessage" name="message" class="form-control"><?= isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message'] : ''; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</body>
</html>

<?php
unset($_SESSION['inputs']);
unset($_SESSION['success']);
unset($_SESSION['error']);
?>