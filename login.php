<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validation du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    $isAuthenticated = false;

    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            $_SESSION['LOGGED_USER'] = $user['email'];
            $isAuthenticated = true;
        }
    }

    if (!$isAuthenticated) {
        $errorMessage = "Email ou mot de passe incorrect.";
    }
}
?>

<!-- Si utilisateur non identifié, on affiche le formulaire -->
<?php if (!isset($_SESSION['LOGGED_USER'])): ?>

<form action="index.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email"
            aria-describedby="email-help" placeholder="you@exemple.com" required>
        <div id="email-help" class="form-text">
            L'email utilisé lors de la création de compte.
        </div>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Connexion</button>
</form>

<!-- Si utilisateur bien connecté on affiche un message de succès -->
<?php else: ?>
    <div class="alert alert-success" role="alert">
        Bonjour et bienvenue sur le site <?php echo $_SESSION['LOGGED_USER']; ?> !
    </div>
<?php endif; ?>
