<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation - Site de recettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        header.confirm-header {
            background: linear-gradient(90deg, #11998e, #38ef7d);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container-fluid p-0">
    <?php include_once('header.php'); ?>

    <header class="confirm-header text-center">
        <h1 class="fw-bold">✅ Message bien reçu</h1>
        <p class="lead">Merci de nous avoir contactés</p>
    </header>

    <main class="container mb-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>

                <?php
                    if (
                        (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                        || (!isset($_POST['message']) || empty($_POST['message']))
                    ) {
                        echo '<div class="alert alert-danger">❌ Il faut un email et un message valides pour soumettre le formulaire.</div>';
                        return;
                    }
                ?>
                <p><strong>Email :</strong> <?php echo htmlspecialchars($_POST['email']); ?></p>
                <p><strong>Message :</strong> <?php echo nl2br(htmlspecialchars($_POST['message'])); ?></p>

                <?php
                    if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0) {
                        if ($_FILES['screenshot']['size'] <= 1000000) {
                            $fileInfo = pathinfo($_FILES['screenshot']['name']);
                            $extension = strtolower($fileInfo['extension']);
                            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                            if (in_array($extension, $allowedExtensions)) {
                                $uploadPath = 'uploads/' . basename($_FILES['screenshot']['name']);
                                move_uploaded_file($_FILES['screenshot']['tmp_name'], $uploadPath);
                                echo '<div class="alert alert-success mt-3">📎 Fichier reçu et enregistré avec succès.</div>';
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </main>

    <?php include_once('footer.php'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
