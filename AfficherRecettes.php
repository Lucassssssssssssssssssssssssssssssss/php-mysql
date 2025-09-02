<?php
// Inclusion des données (utilisateurs + recettes)
include_once('recettes.php');

// Vérifie si une recette est valide
function isValidRecipe($recipe) {
    return isset($recipe['is_enabled']) && $recipe['is_enabled'];
}

// Récupère uniquement les recettes valides
function getRecipes($recipes) {
    $validRecipes = array();
    foreach ($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $validRecipes[] = $recipe;
        }
    }
    return $validRecipes;
}

// Retourne le nom et l’âge d’un auteur à partir de son email
function displayAuthor($authorEmail, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $authorEmail) {
            return $user['full_name'] . ' (' . $user['age'] . ' ans)';
        }
    }
    return 'Auteur inconnu';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Affichage des recettes</title>
</head>
<body>
    <h1>Liste des recettes activées</h1>
    <?php foreach (getRecipes($recipes) as $recipe): ?>
        <article>
            <h3><?php echo $recipe['title']; ?></h3>
            <div><?php echo $recipe['recipe']; ?></div>
            <i><?php echo displayAuthor($recipe['author'], $users); ?></i>
        </article>
    <?php endforeach; ?>
</body>
</html>
