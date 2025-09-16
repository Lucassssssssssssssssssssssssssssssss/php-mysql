<?php
$loggedUser = null;
$errorMessage = null;

// Validation du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] === $_POST['email']
            && password_verify($_POST['password'], $user['password'])
        ) {
            $loggedUser = ['email' => $user['email']];
            break;
        }
    }

    if (!$loggedUser) {
        $errorMessage = sprintf(
            'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
            isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '',
            isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''
        );
    }
}
?>

<!-- Si utilisateur/trice est non identifié(e), on affiche le formulaire -->
<?php if (!$loggedUser): ?>
<form action="" method="POST">
    <!-- si message d'erreur on l'affiche -->
    <?php if ($errorMessage): ?>
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
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
<?php else: ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo htmlspecialchars($loggedUser['email']); ?> et bienvenue sur le site !
    </div>
<?php endif; ?>
