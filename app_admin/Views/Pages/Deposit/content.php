<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <h5>Requested Deposit List</h5>
        <?php
        foreach ($data as $d) { ?>
            <div class="row px-2 my-1">
                <div class="col bg-white border rounded py-2">
                    <div class="row py-1">
                        <div class="col">
                            <small><?= substr($d['insertTime'], 0, 10) ?></small><br>
                            <?= strtoupper($d['sender_name']) ?><br>
                            <span class="fw-bold text-success"><?= number_format($d['amount']) ?></span>
                        </div>
                        <div class="col text-end">
                            <a class="a_confirm" href="<?= PC::BASE_URL_ADMIN . $con ?>/confirm/<?= $d['balance_id'] ?>/1"><button class="btn shadow-none btn-sm btn-outline-success mb-2">Confirm</button></a><br>
                            <div class="btn-group">
                                <button class="btn btn-sm dropdown-toggle shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Option
                                </button>
                                <ul class="dropdown-menu">
                                    <a href="<?= PC::BASE_URL_ADMIN . $con ?>/confirm/<?= $d['balance_id'] ?>/2" class="dropdown-item text-center a_confirm">Reject</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        spinner(0);
    });

    $(".a_confirm").click(function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $.post(href, function(res) {
            if (res == 0) {
                content();
            } else {
                alert(res);
            }
        });
    })
</script>