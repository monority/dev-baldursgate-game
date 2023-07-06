<?php
session_start();

$json = file_get_contents("characters.json");
$characters = json_decode($json, true);

include("templates/header.php");
$random = array_rand($characters, 1);
?>
<div class="video-container">
    <video autoplay muted loop id="background-video">
        <source src="img/animated.mp4" type="video/mp4">
    </video>
</div>
<div id="main">
    <div class="block">
        <div class="container">
            <div class="wrappers">
                <div class="wrapper-button">
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>

                </div>

                <div class="slideshow-container">
                    <?php foreach ($characters as $index => $character) { ?>
                        <div class="mySlides">
                            <p class="select-text">Select your character</p>
                            <div class="numbertext">
                                <?php echo $index + 1; ?> /
                                <?php echo count($characters); ?>
                            </div>

                            <a href="game.php?id=<?= $character["id"] ?>&opp=<?= $characters[$random]["id"] ?>">
                                <figure>
                                    <img src="img/characters/<?= $character['id'] ?>.webp" alt="" class="character-image">
                                    <figcaption>
                                        <div class="wrapper">
                                            <p>
                                                <?= $character["name"] ?>
                                            </p>
                                            <p>
                                                <?= $character["puissance"] ?>
                                            </p>
                                            <p>
                                                <?= $character["type"] ?>
                                            </p>
                                        </div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    <?php } ?>

                </div>
                <div class="wrapper-button">

                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include("templates/footer.php");
?>

<script src="./javascript/main.js"></script>