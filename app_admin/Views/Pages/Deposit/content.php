<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <div class="row mb-3">
            <div class="col">
                <h5>Requested Deposit List</h5>
                <?php
                foreach ($data[0] as $d) { ?>
                    <div class="row px-2 my-1">
                        <div class="col bg-white border border-success rounded py-2">
                            <div class="row py-1">
                                <div class="col">
                                    <small><?= substr($d['insertTime'], 0, 16) ?></small><br>
                                    <?= strtoupper($d['sender_name']) ?><br>
                                    <span class="fw-bold text-success"><?= number_format($d['amount']) ?></span>
                                    <hr class="my-1">
                                    <a class="a_confirm float-end mt-2" href="<?= PC::BASE_URL_ADMIN . $con ?>/confirm/<?= $d['balance_id'] ?>/1"><button class="btn shadow-none btn-sm btn-outline-success mb-2">Confirm</button></a>
                                    <div class="btn-group float-start">
                                        <button class="btn btn-sm dropdown-toggle shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Option
                                        </button>
                                        <ul class="dropdown-menu p-0">
                                            <a href="<?= PC::BASE_URL_ADMIN . $con ?>/confirm/<?= $d['balance_id'] ?>/2" class="dropdown-item text-center a_confirm"><span class="btn btn-sm">Reject</span></a>
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
        <div class="row">
            <div class="col">
                <h5>Confirmed Deposit</h5>
                <?php
                foreach ($data[1] as $d) { ?>
                    <div class="row px-2 my-1">
                        <div class="col bg-white border rounded py-2">
                            <div class="row py-1">
                                <div class="col">
                                    <small><?= substr($d['insertTime'], 0, 16) ?></small><br>
                                    <?= strtoupper($d['sender_name']) ?><br><span class="fw-bold"><?= number_format($d['amount']) ?></span>
                                    <div class="text-end">
                                        <hr class="my-1">
                                        <?= $d['tr_status'] == 1 ? '<i class="bi bi-check-all text-success"></i> <small>Accepted</small>' : '<i class="bi bi-x-lg text-danger"></i> <small>Rejected</small>' ?> by <span class="text-secondary"><?= $d['cs'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
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