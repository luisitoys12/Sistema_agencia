<?php
// URL del stream de AzuraCast
$streamURL = "https://radio.trabullnetwork.pro/listen/estacionkusfm/radio.mp3";
// URL de la API de AzuraCast para obtener el DJ en vivo
$apiURL = "https://radio.trabullnetwork.pro/api/station/estacionkusfm/nowplaying";

// Valor por defecto si no hay DJ en vivo
$djName = "estacionkusfm";

// Consultar la API de AzuraCast para ver si hay DJ en vivo
$apiResponse = @file_get_contents($apiURL);
if ($apiResponse !== false) {
    $json = json_decode($apiResponse, true);
    // Si hay un DJ en vivo, mostrar su nombre
    if (isset($json['live']) && $json['live']['is_live'] && !empty($json['live']['streamer_name'])) {
        $djName = $json['live']['streamer_name'];
    }
}
?>
<div class="radio-container text-center" style="padding: 20px; background: #111; color: #fff; border-radius: 12px; width: 330px; margin: 30px auto; box-shadow: 0 2px 18px #0008;">
    <img src="/public/assets/custom_general/custom_radio/img/dj.ico" class="radio-cover" alt="Radio Cover" style="width: 85px; border-radius: 50%; margin-bottom: 10px;">
    <div class="radio-info" style="margin-bottom: 8px;">
        <p class="dj-label" style="margin:0;font-size:16px;">DJ: <span><?= htmlspecialchars($djName) ?></span></p>
        <p class="mount-point-status" style="margin:0;font-size:12px;color:#ccc;">Radio en vivo...</p>
    </div>
    <audio id="radio" src="<?= htmlspecialchars($streamURL) ?>" preload="none"></audio>
    <div class="radio-controls" style="margin-top:12px;">
        <button id="playButton" class="btn btn-danger" onclick="playRadio()" style="margin-right:3px;"><i class="bi bi-play-fill"></i>▶️</button>
        <button id="pauseButton" class="btn btn-danger" onclick="pauseRadio()" disabled style="margin-right:3px;"><i class="bi bi-pause-fill"></i>⏸️</button>
        <button id="muteButton" class="btn btn-danger" onclick="toggleMute()" style="margin-right:3px;"><i class="bi bi-volume-up-fill"></i>🔊</button>
        <button id="volumeDownButton" class="btn btn-danger" onclick="volumeDown()" style="margin-right:3px;"><i class="bi bi-volume-down-fill"></i>🔉</button>
        <button id="volumeUpButton" class="btn btn-danger" onclick="volumeUp()"><i class="bi bi-volume-up-fill"></i>🔊+</button>
    </div>
</div>
<script>
    var radio = document.getElementById("radio");
    var playButton = document.getElementById("playButton");
    var pauseButton = document.getElementById("pauseButton");
    var muteButton = document.getElementById("muteButton");

    function playRadio() {
        try {
            radio.play();
            playButton.disabled = true;
            pauseButton.disabled = false;
        } catch (error) {
            console.error("Error al reproducir:", error);
        }
    }
    function pauseRadio() {
        radio.pause();
        playButton.disabled = false;
        pauseButton.disabled = true;
    }
    function toggleMute() {
        radio.muted = !radio.muted;
        muteButton.innerHTML = radio.muted ? '🔇' : '🔊';
    }
    function volumeDown() {
        if (radio.volume > 0.1) radio.volume -= 0.1;
        else radio.volume = 0;
    }
    function volumeUp() {
        if (radio.volume < 0.9) radio.volume += 0.1;
        else radio.volume = 1;
    }
</script>