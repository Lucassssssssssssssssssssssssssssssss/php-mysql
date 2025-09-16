<?php
// Déconnexion
if (isset($_POST['logout'])) {
    setcookie('LOGGED_USER', '', time() - 3600, "", "", true, true); // suppression cookie
    unset($loggedUser);
}

// Validation du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    $isAuthenticated = false;

    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            // Connexion réussie
            $loggedUser = ['email' => $user['email']];
            $isAuthenticated = true;

            // Cookie qui expire dans un an
            setcookie(
                'LOGGED_USER',
                $loggedUser['email'],
                time() + 365 * 24 * 3600,
                "",
                "",
                true,
                true
            );
            break;
        }
    }

    if (!$isAuthenticated) {
        $errorMessage = sprintf(
            'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
            $_POST['email'],
            $_POST['password']
        );
    }
}

// Si le cookie est présent, on restaure l'utilisateur connecté
if (isset($_COOKIE['LOGGED_USER'])) {
    $loggedUser = ['email' => $_COOKIE['LOGGED_USER']];
}
?>

<!-- Si utilisateur/trice est non identifié(e), on affiche le formulaire -->
<?php if (!isset($loggedUser)): ?>

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

<!-- Si utilisateur/trice bien connecté(e) on affiche un message de succès -->
<?php else: ?>
    <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
        <span>Bonjour <?php echo htmlspecialchars($loggedUser['email']); ?> et bienvenue sur le site !</span>
        <form action="index.php" method="post" class="m-0">
            <button type="submit" name="logout" class="btn btn-danger btn-sm">Déconnexion</button>
        </form>
    </div>
<?php endif; ?>
