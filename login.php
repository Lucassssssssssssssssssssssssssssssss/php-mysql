<?php
// Déconnexion
if (isset($_POST['logout'])) {
    setcookie('LOGGED_USER', '', time() - 3600, "", "", true, true);
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
            $loggedUser = ['email' => $user['email']];
            $isAuthenticated = true;

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
        $errorMessage = "❌ Email ou mot de passe incorrect.";
    }
}

if (isset($_COOKIE['LOGGED_USER'])) {
    $loggedUser = ['email' => $_COOKIE['LOGGED_USER']];
}
?>

<?php if (!isset($loggedUser)): ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">Connexion</h4>

                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                <?php endif; ?>

                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@exemple.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Afficher le mot de passe" aria-pressed="false">
                                <!-- Icône œil (SVG inline) -->
                                <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5"/>
                                </svg>
                                <svg id="icon-eye-slash" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" style="display:none">
                                    <path d="M13.359 11.238C15.06 9.879 16 8 16 8s-3-5.5-8-5.5a7.03 7.03 0 0 0-2.79.588l.743.743A6.02 6.02 0 0 1 8 3.5C12 3.5 15 8 15 8s-.594 1.06-1.84 2.238l-.8-.8z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.473-4.473l.823.823a2.5 2.5 0 0 1 2.827 2.827l.823.823z"/>
                                    <path d="M3.35 5.47 1.646 3.765l.708-.708 12.39 12.39-.708.708-2.06-2.06A7.03 7.03 0 0 1 8 13.5C3.999 13.5 1 9 1 9s.936-1.874 2.65-3.53zm1.28 1.279C3.63 7.71 2.66 8.916 2.31 9.41 3.5 10.93 5.91 12.5 8 12.5c.71 0 1.39-.13 2.02-.36l-1.29-1.29a3.5 3.5 0 0 1-4.1-4.1z"/>
                                </svg>
                            </button>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php else: ?>
<div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
    <span>✅ Bonjour <strong><?php echo htmlspecialchars($loggedUser['email']); ?></strong>, bienvenue sur le site !</span>
    <form action="index.php" method="post" class="m-0">
        <button type="submit" name="logout" class="btn btn-danger btn-sm">Déconnexion</button>
    </form>
</div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePassword');
    const eye = document.getElementById('icon-eye');
    const eyeSlash = document.getElementById('icon-eye-slash');

    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            toggleBtn.setAttribute('aria-pressed', String(isHidden));
            toggleBtn.setAttribute('aria-label', isHidden ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
            eye.style.display = isHidden ? 'none' : 'inline';
            eyeSlash.style.display = isHidden ? 'inline' : 'none';
        });
    }
});
</script>

