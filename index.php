<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de recettes</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container">

    <!-- inclusion du menu -->
    <?php include_once('header.php'); ?>

    <h1>Site de recettes</h1>

    <!-- inclusion des variables et fonctions -->
    <?php
    include_once('variables.php');
    include_once('functions.php');
    ?>

    <!-- affichage des recettes -->
    <?php foreach (getRecipes($recipes) as $recipe): ?>
        <article class="mb-3">
            <h3><?php echo $recipe['title']; ?></h3>
            <i><?php echo displayAuthor($recipe['author'], $users); ?></i>
        </article>
    <?php endforeach; ?>

    <!-- inclusion du pied de page -->
    <?php include_once('footer.php'); ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
