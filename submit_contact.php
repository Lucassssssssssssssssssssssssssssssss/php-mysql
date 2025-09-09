<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de recettes</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container">

    <!-- inclusion du menu -->
    <?php include_once('header.php'); ?>

    <h1>Message bien reçu !</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Rappel de vos informations</h5>

            <?php
                if (
                    !isset($_GET['email']) || !isset($_GET['message']) ||
                    empty($_GET['email']) || empty($_GET['message'])
                ) {
                    echo('<h1>Il faut un email et un message pour soumettre le formulaire.</h1>');
                    // Arrête l'exécution de PHP
                    return;
                }
            ?>
            <p class="card-text"><b>Email</b> : <?php echo $_GET['email']; ?> </p>
            <p class="card-text"><b>Message</b> : <?php echo $_GET['message']; ?> </p>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
