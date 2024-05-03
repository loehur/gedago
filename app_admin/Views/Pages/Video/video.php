<div class="modal-header">
    <button type="button" class="btn-close closeBTN" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body" id="yt_body">
    <iframe width="100%" class="ytplayer" height="315" src="https://www.youtube.com/embed/<?= $data ?>?si=y0Qdj0mHS6hMHXOS&controls=0&start=1&autoplay=1&mute=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
<div class="modal-footer d-none">
    <button type="button" class="btn btn-secondary closeBTN" data-bs-dismiss="modal">Close</button>
</div>

<script>
    $('.closeBTN').click(function() {
        $("#yt_body").html("");
    })
</script>