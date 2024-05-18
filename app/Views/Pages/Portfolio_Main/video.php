<div class="modal-header border-0">
    <button type="button" class="btn-close d-none closeBTN" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body border-0 pb-0">
    <iframe width="100%" class="ytplayer" height="315" src="https://www.youtube.com/embed/<?= $data['yt'] ?>?si=y0Qdj0mHS6hMHXOS&controls=0&start=1&autoplay=1&mute=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
<div class="modal-footer border-0">
    <div class="row mt-2 divAD">
        <div class="col text-center">
            Video dapat ditutup setelah <span class="text-danger fw-bold" id="time">00:10</span>
        </div>
    </div>
    <button type="button" class="btn btn-light d-none closeBTN rounded-pill" data-bs-dismiss="modal">Close</button>
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
                fee();
            }
        }, 1000);
    }

    function closeAd() {
        $('.closeBTN').removeClass("d-none");
        $('.divAD').addClass("d-none");
    }

    $('.closeBTN').click(function() {
        content();
    })

    function fee() {
        $.post("<?= PC::BASE_URL ?>Load/watch/<?= $data['video_id'] ?>", function(res) {
            if (res != 0) {
                alert(res);
            }
        });
    }
</script>