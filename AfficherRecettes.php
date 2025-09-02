<?php
// Déclaration du tableau associatif des recettes
$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => 'Etape 1 : flageolets, Etape 2 : mijoter...',
        'author' => 'mickael.andrieu@exemple.com',
        'enabled' => true
    ],
    [
        'title' => 'Couscous',
        'recipe' => 'Etape 1 : légumes, Etape 2 : semoule...',
        'author' => 'mickael.andrieu@exemple.com',
        'enabled' => false
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => 'Etape 1 : paner, Etape 2 : cuire...',
        'author' => 'mathieu.nebra@exemple.com',
        'enabled' => true
    ]
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Affichage des recettes</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .recipe { margin: 10px; padding: 15px; border: 1px solid #ccc; border-radius: 8px; background: #fff; }
        .recipe h3 { margin: 0; color: #2c3e50; }
        .recipe p { margin: 5px 0; }
        .author { font-size: 0.9em; color: #888; }
    </style>
</head>
<body>
    <h1>Liste des recettes activées</h1>
    <?php foreach ($recipes as $recipe): ?>
        <?php if ($recipe['enabled']): ?>
            <div class="recipe">
                <h3><?php echo $recipe['title']; ?></h3>
                <p><?php echo $recipe['recipe']; ?></p>
                <p class="author">Auteur : <?php echo $recipe['author']; ?></p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>