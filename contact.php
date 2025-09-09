<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container">

    <!-- inclusion du menu -->
    <?php include_once('header.php'); ?>

    <h1>Contactez nous</h1>

    <form action="submit_contact.php" method="post" class="mt-4">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control">
            <div class="form-text">Nous ne revendrons pas votre email.</div>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Votre message</label>
            <textarea id="message" name="message" rows="4" class="form-control" placeholder="Exprimez-vous"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <!-- inclusion du pied de page -->
    <?php include_once('footer.php'); ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
