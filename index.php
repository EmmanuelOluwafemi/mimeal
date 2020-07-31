<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mimeal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" href="./assets/images/logo.png" type="image/x-icon">
</head>
<body>
    <!-- nav bar -->
    <nav>
        <div class="container">
            <div class="navbar-brand">
                <img src="./assets/images/logo.png" alt="mimeal logo">
            </div>
        </div>
    </nav>
    <section class="hero d-flex justify-content-center align-items-center flex-column">
        <div class="overlay"></div>
        <h1 data-aos="fade-left"
            data-aos-anchor="#example-anchor"
            data-aos-duration="1000">Are you Feeling Hungry?</h1>
        <h4 data-aos="fade-right"
            data-aos-anchor="#example-anchor"
            data-aos-duration="1000">You can randomly get an ideal meal by clicking on button below.</h4>
        <form method="post" class="button-group">
            <button class="btn bg-primary" id="generate" name="fetch" data-aos="zoom-in-left"
            data-aos-anchor="#example-anchor"
            data-aos-duration="1000">Get a meal</button>
            <button class="btn btn-outline" name="clear" data-aos="zoom-in-right"
            data-aos-anchor="#example-anchor"
            data-aos-duration="1000">Get another meal</button>
        </form>
        
    </section>
    <section class="meal"><br>
        <h2 class="text-center"><u>Your Meal Suggestion</u></h2><br><br>
<?php
    
    $getRandomMeal = file_get_contents('https://www.themealdb.com/api/json/v1/1/random.php');
    
    $fetchedMeal = json_decode($getRandomMeal, true);
    
    foreach ($fetchedMeal['meals'] as $meal) {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6" data-aos="zoom-in-right">
                    <img src="<?php echo $meal['strMealThumb']; ?>" alt="food image" class="image-fluid w-100">
                </div>

                <div class="col-sm-12 col-md-6" data-aos="zoom-in-left"
                data-aos-duration="1000">
                    <h2 class="color-primary mb-2"><?php echo $meal['strMeal']; ?></h2>
                    <div class="meal--categories">
                        <h6><span class="color-primary">Category: </span><?php echo $meal['strCategory']; ?></h6>
                        <h6><span class="color-primary">Area: </span><?php echo $meal['strArea']; ?></h6>
                        <?php
                            if(!empty($meal['strTags'])){
                        ?>
                            <h6><span class="color-primary">Tags: </span><?php echo str_replace(',', ', ', $meal['strTags']); ?></h6>
                        <?php 
                            }
                        ?>
                    </div>
                    
                    <h3>Ingredients</h3>
                    <ul>
                        <?php
                            $ingredients = array();
                            $i = 0;
                            while ($i <= 20) {
                                $strIngredient = 'strIngredient'.$i;
                                $strMeasure = 'strMeasure'.$i;
                                // echo $strIngredient .'-'. $strMeasure.'<br>';
                                if ($meal[$strIngredient]) {
                                    array_push($ingredients,  
                                        $meal[$strIngredient] .' - '. $meal[$strMeasure]
                                    );
                                } else {
                                    // Stop if there are no more ingredients
                                    // break;
                                }
                                $i++;
                            }
                            $recipe = 0;
                            while ($recipe <= (count($ingredients)-1)) {
                                echo '<li style="text-transform: capitalize;">'.$ingredients[$recipe].'</li>';
                                $recipe++;
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row bg-dark">
                    <div class="col-md-12">
                        <br>
                        <h3 class="text-white">Preparation</h3>
                        <p class="text-light">- <?php echo str_replace('.', '.<br><br>- ', $meal['strInstructions']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="meal--video mt-4">
            <div class="container">
                <iframe width="100%" height="500px" src="<?php echo str_replace('watch?v=', 'embed/', $meal['strYoutube']); ?>"></iframe>
            </div>
        </div>
        <?php
        
    }

?>

    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>
