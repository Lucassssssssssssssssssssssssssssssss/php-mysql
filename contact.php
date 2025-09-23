<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        header.contact-header {
            background: linear-gradient(90deg, #36d1dc, #5b86e5);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        .contact-card {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container-fluid p-0">
    <?php include_once('header.php'); ?>

    <header class="contact-header text-center">
        <h1 class="fw-bold">📩 Contactez-nous</h1>
        <p class="lead">Une question, une suggestion ? Nous sommes à votre écoute</p>
    </header>

    <main class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card contact-card p-4">
                    <form action="submit_contact.php" method="post" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" required>
                            <div class="form-text">Nous ne revendrons pas votre email.</div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Votre message</label>
                            <textarea id="message" name="message" rows="5" class="form-control" placeholder="Exprimez-vous..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="screenshot" class="form-label">Capture d'écran (optionnel)</label>
                            <input type="file" class="form-control" id="screenshot" name="screenshot" accept=".jpg,.jpeg,.png,.gif">
                            <div class="form-text">Formats acceptés : JPG, PNG, GIF (max 1 Mo)</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">📨 Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include_once('footer.php'); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
