<?php
session_start();
require("templates/header.php");
require("class/characters.php");
$json = file_get_contents("characters.json");
$characters = json_decode($json, true);

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    foreach ($characters as $character) {
        if ($character["id"] == $_GET["id"]) {
            $player = new Champion($character["id"], $character["name"], 100, $character["puissance"], $character["type"]);
            foreach ($character["attacks"] as $atk) {
                $player->addAttack($atk["name"], $atk["damage"]);
            }
        }
        if ($character["id"] == $_GET["opp"]) {
            $opponent = new Champion($character["id"], $character["name"], 100, $character["puissance"], $character["type"]);
            foreach ($character["attacks"] as $atk) {
                $opponent->addAttack($atk["name"], $atk["damage"]);
            }
        }
    }
    $_SESSION["player"] = serialize($player);
    $_SESSION["opponent"] = serialize($opponent);
}



$player = unserialize($_SESSION["player"]);
$opponent = unserialize($_SESSION["opponent"]);

// affichage avec des tableaux
$array = [$player->name, $player->type, $player->power];
$arrayimplode = implode(", ", $array);
$arraytwo = [$opponent->name, $opponent->type, $opponent->power];
$arrayimploderng = implode(", ", $arraytwo);

$playerAttacks = $player->getAttacks();
$opponentAttacks = $opponent->getAttacks();
$random = array_rand($opponentAttacks, 1);



if (isset($_GET["atk"])) {
    $atk = $_GET["atk"];
    if ($player->hp > 0) {
        foreach ($playerAttacks as $attack) {

            if ($atk == $attack->name) {
                $damage = ceil($attack->damage) * ($player->power / 100);


                $opponent->hp = $opponent->hp - $damage;
                if ($opponent->hp < 0) {
                    $opponent->hp = 0;
                }
                $playerdmg = "{$player->name} lance l'attaque {$attack->name} et inflige {$damage} à {$opponent->name}";
                $_SESSION["opponent"] = serialize($opponent);
            }
        }
    }
    if ($opponent->hp > 0) {
        $damage = ceil($opponentAttacks[$random]->damage) * ($opponent->power) / 100;
    }
    $player->hp = ($player->hp) - $damage;

    if ($player->hp < 0) {
        $player->hp = 0;
    }
    $opponentdmg = "{$opponent->name} lance l'attaque {$opponentAttacks[$random]->name} et inflige {$damage} à {$player->name}";
    $_SESSION["player"] = serialize($player);


    if ($opponent->hp === 0 || $player->hp === 0) {
        if ($opponent->hp <= 0) {

            header("Location: ./victory.php");

        } else {

            header("Location: ./defeat.php");
        }

    }
}
?>
<div class="video-container">
    <video autoplay muted loop id="background-video">
        <source src="img/animated.mp4" type="video/mp4">
    </video>
</div>
<div id="game">
    <div class="wrapper-left">
        <figure>
            <img src="img/characters/<?= $player->id ?>.webp" alt="">
            <figcaption>
                <progress class="progress-player" value="<?= $player->hp ?>" max="100"></progress>
                <span>
                    <?= $player->hp ?>
                </span>
                <div class="wrapper">
                    <?= $arrayimplode ?>
                </div>
                <div class="wrapper-attacks">
                    <?php
                    foreach ($player->attacks as $attack) {
                        ?>

                        <a class="attack" href="game.php?atk=<?= $attack->name ?>">
                            <?= $attack->name ?>
                        </a>
                    <?php } ?>
                </div>
            </figcaption>
        </figure>
    </div>

        <div class="wrappers-mid">
            <div class="wrapper-middle-box">
                <?php if ((empty($playerdmg)) || (empty($opponentdmg))) {
                    ?>
                    <p></p>

                <?php } else { ?>
                    <p>
                        <?= $playerdmg ?>
                    </p>
                    <p>
                        <?= $opponentdmg ?>
                    </p>
                <?php } ?>


            </div>
    </div>
    <div class="wrapper-right">
        <figure>
            <img src="img/characters/<?= $opponent->id ?>.webp" alt="">
            <figcaption>
                <progress class="progress-rng" value="<?= $opponent->hp ?>" max="100"></progress>
                <span>
                    <?= $opponent->hp ?>
                </span>
                <div class="wrapper">
                    <?= $arrayimploderng ?>
                </div>
                <div class="wrapper-attacks">
                    <?php
                    foreach ($opponent->attacks as $attack) {
                        ?>

                        <p class="attack-two" href="game.php?atk=<?= $attack->name ?>">
                            <?= $attack->name ?>
                        </p>
                    <?php } ?>
                </div>
            </figcaption>
        </figure>
    </div>
</div>

<script>

    function redirection() {

        window.location.href = "index.php";

    }

</script>
<?php
include("templates/footer.php");
?>