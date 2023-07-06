<footer>
    <div class="container-footer"><button class="play-button" id="play-button" onclick="togglePlay()"></button>
    </div>
</footer>
<script>
    var audio = new Audio('./sound/bg.mp3');
    var isPlaying = false;

    function togglePlay() {
        if (isPlaying) {
            audio.pause();
            isPlaying = false;
        } else {
            audio.play();
            isPlaying = true;
        }

        // Toggle the 'paused' class
        var playButton = document.getElementById('play-button');
        playButton.classList.toggle('paused');
    }
</script>
</body>

</html>