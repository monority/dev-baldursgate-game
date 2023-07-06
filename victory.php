<?php
session_start();
session_destroy();
require("templates/header.php");


?>
<div class="video-container">
    <video autoplay muted loop id="background-video">
        <source src="img/animated.mp4" type="video/mp4">
    </video>
</div>
<div id="end">
    <div class="container">
        <h1>Vous avez gagné</h1>
        <a href="./">Rejouer</a>

    </div>

</div>
