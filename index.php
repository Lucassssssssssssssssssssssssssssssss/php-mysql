<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        header {
            background: linear-gradient(90deg, #ff7e5f, #feb47b);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .recipe-card {
            transition: transform 0.2s ease;
        }

        .recipe-card:hover {
            transform: scale(1.02);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navigation -->
    <?php include_once('header.php'); ?>

    <!-- Bandeau d'accueil -->
    <header class="text-center">
        <div class="container">
            <h1 class="fw-bold">🍽 Bienvenue sur le Site de Recettes</h1>
            <p class="lead">Partagez et découvrez vos plats préférés</p>
        </div>
    </header>

    <main class="container flex-grow-1">
        <?php 
        // Connexion à la base
        include_once('mysql.php'); 

        // Vérification que la connexion marche
        if (!$db) {
            die("Erreur de connexion à la base de données.");
        }

        // Inclusion des fonctions
        include_once('functions.php'); 

        // Formulaire ou message de connexion
        include_once('login.php'); 

        // --- TRAITEMENT DU FORMULAIRE AJOUT DE RECETTE ---
        if (isset($loggedUser) && !empty($_POST['title']) && !empty($_POST['recipe'])) {
            $title = trim($_POST['title']);
            $recipeText = trim($_POST['recipe']);
            $author = $loggedUser['email']; // auteur = utilisateur connecté
            $is_enabled = 1;

            try {
                $sqlQuery = 'INSERT INTO recipes (title, recipe, author, is_enabled) 
                             VALUES (:title, :recipe, :author, :is_enabled)';
                $insertRecipe = $db->prepare($sqlQuery);
                $insertRecipe->execute([
                    'title' => $title,
                    'recipe' => $recipeText,
                    'author' => $author,
                    'is_enabled' => $is_enabled
                ]);
                echo '<div class="alert alert-success mt-3">✅ Recette ajoutée avec succès !</div>';
            } catch (Exception $e) {
                echo '<div class="alert alert-danger mt-3">Erreur SQL : ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }

        // Récupération des recettes valides
        try {
            $sqlQuery = 'SELECT * FROM recipes WHERE is_enabled = 1';
            $recipesStatement = $db->prepare($sqlQuery);
            $recipesStatement->execute();
            $recipes = $recipesStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur SQL : ' . $e->getMessage());
        }
        ?>

        <!-- Si connecté, afficher formulaire + recettes -->
        <?php if (isset($loggedUser)): ?>
            
            <!-- Formulaire d'ajout de recette -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    ✍️ Ajouter une nouvelle recette
                </div>
                <div class="card-body">
                    <form method="post" action="index.php">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipe" class="form-label">Recette</label>
                            <textarea class="form-control" id="recipe" name="recipe" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </form>
                </div>
            </div>

            <!-- Affichage des recettes -->
            <div class="row mt-4">
                <?php foreach (getRecipes($recipes) as $recipe): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card recipe-card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo htmlspecialchars($recipe['title']); ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo nl2br(htmlspecialchars($recipe['recipe'])); ?>
                                </p>
                            </div>
                            <div class="card-footer text-muted">
                                <?php echo displayAuthor($recipe['author'], $users); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- Pied de page -->
    <?php include_once('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
