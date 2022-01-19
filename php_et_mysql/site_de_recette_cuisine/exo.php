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
/*
    function displayAuthor(string $authorEmail, array $user) : string 
    {
        for($i = 0; $i < count($user); $i++) {
            $author = $user[$i];
            if($authorEmail === $author['email']) {
                return $author['full_name']. '('.$author['age']. ')';
            }
        }
    }
    function isValidRecipe(array $recipe) : bool
    {
        if(array_key_exists("is_enabled", $recipe)){
            $isEnabled = $recipe["is_enabled"];
        }
        else {
            $isEnabled = false;
        }
        return $isEnabled;
    }
    function getRecipes(array $recipes) : array 
    {
        $validRecipes = [];
        foreach ($recipes as $recipe) {
            if(isValidRecipe($recipe)) {
                $validRecipes[] = $recipe;
            }
        }
        return $validRecipes;
    }
*/
    function display_recipe(array $recipe) : string
    {
        $recipe_content = '';

        if ($recipe['is_enabled']) {
            $recipe_content = '<article>';
            $recipe_content .= '<h3>' . $recipe['title'] . '</h3>';
            $recipe_content .= '<div>' . $recipe['recipe'] . '</div>';
            $recipe_content .= '<i>' . $recipe['author'] . '</i>';
            $recipe_content .= '</article>';
        }
        
        return $recipe;
    }


    function get_recipes(array $recipes) : array
    {
        $valid_recipes = [];

        foreach($recipes as $recipe) {
            if ($recipe['is_enabled']) {
            $valid_recipes[] = $recipe;
            }
            }
        return $valid_recipes;
    }

    function display_author(string $authorEmail, array $users) : string
    {
        for ($i = 0; $i < count($users); $i++) {
            $author = $users[$i];
            if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
            }
        }
    }


?>
<!DOCTYPE html>
<html>
<head>
    <title>Affichage des recettes</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body> 
    <div class="container">
        <h1>Liste des recettes</h1>
        <!-- Plus facile à lire -->
        <?php foreach(get_recipes($recipes) as $recipe) : ?>
            <article>
                <h3><?php echo($recipe['title']); ?></h3>
                <div><?php echo($recipe['recipe']); ?></div>
                <i><?php echo(display_author($recipe['author'], $users)); ?></i>
            </article>
        <?php endforeach ?>
    </div>
</body>
</html>