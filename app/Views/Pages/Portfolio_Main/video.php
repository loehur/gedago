<div class="modal-header">
    <button type="button" class="btn-close d-none closeBTN" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <iframe width="100%" height="315" src="https://www.youtube.com/embed/kBlcWM3SWjE?si=y0Qdj0mHS6hMHXOS&controls=0&start=1&autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    <div class="row mt-2 divAD">
        <div class="col text-center">
            Video dapat ditutup setelah <span class="text-danger fw-bold" id="time">00:10</span>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary d-none closeBTN" data-bs-dismiss="modal">Close</button>
</div>

<script>
    $(document).ready(function() {
        var waktu = 10,
            display = document.querySelector('#time');
        startTimer(waktu, display);
    });

    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        var countDown = setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(countDown);
                closeAd();
            }
        }, 1000);
    }

    function closeAd() {
        $('.closeBTN').removeClass("d-none");
        $('.divAD').addClass("d-none");
    }
</script>