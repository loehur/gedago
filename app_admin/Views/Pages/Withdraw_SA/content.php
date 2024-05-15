<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <div class="row mb-2">
            <div class="col">
                <h5>Withdraw - <span class="text-danger">SuperAdmin Approval</span></h5>
                <?php
                foreach ($data[0] as $d) { ?>
                    <div class="row px-2 my-1">
                        <div class="col bg-white border border-success rounded py-2">
                            <div class="row py-1">
                                <div class="col">
                                    <small><?= substr($d['insertTime'], 0, 10) ?></small><br>
                                    <?= strtoupper($d['rek_name']) ?><br>
                                    <?= strtoupper($d['bank']) ?><br>
                                    <span class=""><?= strtoupper($d['rek_no']) ?></span> <button class="btn p-0 shadow-none" data-clipboard-text="<?= $d['rek_no'] ?>"><i class="bi bi-clipboard"></i></button><br>
                                    <span class="fw-bold text-success"><?= number_format($d['amount']) ?></span> <button class="btn p-0 shadow-none" data-clipboard-text="<?= $d['amount'] ?>"><i class="bi bi-clipboard"></i></button>
                                </div>
                                <div class="col text-end">
                                    <a class="a_confirm" href="<?= PC::BASE_URL_ADMIN . $con ?>/confirm/<?= $d['balance_id'] ?>/2"><button class="btn shadow-none btn-sm btn-outline-success mb-2">Confirm</button></a><br>
                                    <div class="btn-group">
                                        <button class="btn btn-sm dropdown-toggle shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Option
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <a href="<?= PC::BASE_URL_ADMIN . $con ?>/confirm/<?= $d['balance_id'] ?>/4" class="dropdown-item text-center a_confirm">Reject</a>
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
        <div class="row mb-2">
            <div class="col">
                <h5>Confirmed Withdraw</h5>
                <?php
                foreach ($data[1] as $d) { ?>
                    <div class="row px-2 my-1">
                        <div class="col bg-white border rounded py-2">
                            <div class="row py-1">
                                <div class="col">
                                    <small><?= substr($d['insertTime'], 0, 16) ?></small><br>
                                    <?= strtoupper($d['rek_name']) ?><br>
                                    <?= strtoupper($d['bank']) ?><br>
                                    <span class=""><?= strtoupper($d['rek_no']) ?></span><br>
                                    <span class="fw-bold"><?= number_format($d['amount']) ?></span>
                                </div>
                                <div class="col text-end">
                                    <b><?= $d['tr_status'] == 1 ? '<span class="text-success"><small>Accepted</small></span>' : '<span class="text-danger"><small>Rejected</small></span>' ?></b><br>
                                    <?php if ($d['tr_status'] == 1) {
                                        echo '<i class="bi bi-check-all text-success"></i> ' . $d['cs'];
                                        echo '<br><i class="bi bi-check-all text-success"></i> ' . $d['sv'];
                                    } else {
                                        switch ($d['wd_step']) {
                                            case 2:
                                                echo '<i class="bi bi-x-lg text-danger"></i> ' . $d['cs'];
                                                break;
                                            case 4:
                                                echo '<i class="bi bi-check-all text-success"></i> ' . $d['cs'];
                                                echo '<br><i class="bi bi-x-lg text-danger"></i> ' . $d['sv'];
                                                break;
                                            default:
                                                # code...
                                                break;
                                        }
                                    }
                                    ?>
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

<script src="<?= PC::ASSETS_URL ?>plugins/clipboard/clipboard.min.js"></script>
<script>
    $(document).ready(function() {
        spinner(0);
    });

    var clipboard = new ClipboardJS('.btn');

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