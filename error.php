<?php

$users = [
    [
        'full_name' => 'Mickaël Andrieu',
        'email' => 'mickael.andrieu@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Mathieu Nebra',
        'email' => 'mathieu.nebra@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Laurène Castor',
        'email' => 'laurene.castor@exemple.com',
        'age' => 28,
    ],
];

$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => '',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Salade Romaine',
        'recipe' => '',
        'author' => 'laurene.castor@exemple.com',
        'is_enabled' => false,
    ],
];

// Fonction pour afficher une recette
function display_recipe($recipe) {
    $recipe_content = '';

    if ($recipe['is_enabled']) {
        $recipe_content = '<article>';
        $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
        $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
        $recipe_content .= '<i>' . $recipe['author'] . '</i>';
        $recipe_content .= '</article>';
    }
    
    return $recipe_content;
}

// Fonction pour afficher l'auteur à partir de son email
function display_author($authorEmail, $users) {
    foreach ($users as $author) {
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . ' (' . $author['age'] . ' ans)';
        }
    }
    return "Auteur inconnu";
}

// Fonction pour filtrer uniquement les recettes valides
function get_recipes($recipes) {
    $valid_recipes = [];

    foreach($recipes as $recipe) {
        if ($recipe['is_enabled']) {
            $valid_recipes[] = $recipe;
        }
    }

    return $valid_recipes;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Les recettes corrigées</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body>
    <div class="container">
        <h1>Liste des recettes</h1>
        <?php foreach(get_recipes($recipes) as $recipe) : ?>
            <article>
                <h3><?php echo $recipe['title']; ?></h3>
                <div><?php echo $recipe['recipe']; ?></div>
                <i><?php echo display_author($recipe['author'], $users); ?></i>
            </article>
        <?php endforeach ?>
    </div>   
</body>
</html>
