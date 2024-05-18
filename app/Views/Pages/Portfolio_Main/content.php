<?php

$ada_port = false;
if (isset($data['port_balance']['data']['user_id'])) {
    $porto_bal = $data['port_balance'];
    foreach ($_SESSION['config']['level'] as $pl) {
        if ($pl['level'] == $porto_bal['data']['level']) {
            $fee_d = $pl['benefit'][1]['fee'];
            $w_qty = $pl['benefit'][1]['qty'];
        }
    }
    $level = $porto_bal['data']['level'];
    $ada_port = true;
} else {
    $porto_bal = [];
    $level = 0;
    $fee_d = 0;
    $w_qty = 0;
}
?>

<div class="px-4 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold text-dark">Portfolio <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<div class="container pb-5 mb-5">
    <section>
        <div class="row">
            <div class="col m-2 text-white rounded p-3 gedago_card" style="min-width: 300px;">
                <div class="row">
                    <div class="col">
                        <i class="bi bi-wallet2"></i> Total Portfolio <br>
                        <h6 class="fw-bold">Rp<span class="port_amount"><?= $ada_port == true ? number_format($porto_bal['saldo']) : 0 ?></span></h6>
                    </div>
                    <div class="col text-end">
                        <span class="fw-bold"><i class="bi bi-award-fill"> </i><span class="level_name"></span><br>
                        </span><small><span><?= isset($porto_bal['data']['expired_date']) ? "Exp: " . $porto_bal['data']['expired_date'] : '' ?></span></small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <?php
                    $ac_pr = $porto_bal['fee_dc'] + $porto_bal['fee_dw'];
                    $persen = ($ac_pr / $porto_bal['saldo']) * 100;
                    ?>

                    <div class="col">
                        Accumulated Profits<br><span class="fw-bold">+Rp<?= number_format($ac_pr) ?></span>
                    </div>
                    <div class="col-auto text-end">
                        <?php
                        $ac_pr = $porto_bal['fee_dc'] + $porto_bal['fee_dw'];
                        $persen = ($ac_pr / $porto_bal['saldo']) * 100;
                        ?>
                        Profit Gain<br><span class="fw-bold">+Rp<?= number_format($persen) ?>%</span>
                    </div>
                </div>
            </div>

            <div class="col m-2 text-white rounded gedago_card p-3" style="min-width: 300px;">
                <i class="bi bi-list-task me-1"></i> Daily Task (<?= count($data['watch']) ?>/<span class="daily_task"></span>)<br>
                <div class="progress mt-1">
                    <?php
                    if (count($data['watch']) == 0) {
                        $persen = 0;
                    } else {
                        $persen = (count($data['watch']) / $w_qty) * 100;
                    }
                    ?>
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $persen ?>%"></div>
                </div>
                <div class="mt-3">
                    <?php
                    if (isset($porto_bal['data']['level'])) {
                        if (count($data['watch']) < $w_qty) { ?>
                            <span class="btn btn-sm btn-outline-warning" id="btnW" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Watch Video</span>
                            <span class="float-end">Bonus Rp<?= number_format(($fee_d / 100) * $data['port_balance']['saldo']) ?></span>
                    <?php }
                    } ?>
                    <hr>

                    <?php
                    foreach ($data['watch'] as $dw) { ?>
                        <div class="row">
                            <div class="col">
                                <span><small><?= $dw['dw_id'] ?></small></span><span class="float-end text-white">+Rp<?= number_format($dw['fee']) ?></span><br>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col m-2 text-white rounded gedago_card p-3" style="min-width: 300px;">
                <i class="bi bi-calendar-check me-1"></i> Daily Check-in <br>
                <span>
                    <?php
                    if (isset($data['checkin']['insertTime'])) {
                    ?>
                        <i class="bi bi-check-circle-fill"></i> <?= $data['checkin']['insertTime'] ?>
                        <hr>
                        <h6>Check-in Today</h6>
                        <div class="row">
                            <div class="col">
                                <?php $df = $data['checkin'];
                                if (isset($df['insertTime'])) {
                                    echo substr($df['insertTime'], 0, 10)  . " <span class='text-white float-end'>+Rp" . number_format($df['fee']) . "</span><br>";
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        if (isset($porto_bal['data']['user_id'])) { ?>
                            <span id="checkin" class="btn btn-outline-info my-2">Check-in</span>
                        <?php } else { ?>
                            <br>
                            <small><span>Anda belum memiliki produk investasi aktif</span></small>
                    <?php }
                    }
                    ?>
                </span>
            </div>
            <div class="col m-2 text-white rounded gedago_card p-3" style="min-width: 300px;">
                <h6>Portfolio History</h6>
                <?php foreach ($data['porto_history'] as $pr) {
                    if ($pr['port_status'] == 1) {
                ?>
                        <div class="row border-top pt-2">
                            <div class="col">
                                <small><span class="fw-bold"><?= $this->func("Level")->level_nm($pr['level']) ?></span></small><br>
                                <small><span><?= substr($pr['insertTime'], 0, 10) ?></span> &#8594; <span><?= substr($pr['doneDate'], 0, 10)  ?></span></small></small>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade px-2" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-warning bg-opacity-75" id="video_content"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("span.level_name").load("<?= PC::BASE_URL ?>Load/level_name/<?= $level ?>");
        $("span.daily_task").load("<?= PC::BASE_URL ?>Load/daily_task/<?= $level ?>");
        spinner(0);
    });

    $("span#btnW").click(function() {
        $("div#video_content").load("<?= PC::BASE_URL ?>Portfolio_Main/load_video");
    })

    $("#checkin").click(function() {
        $.post("<?= PC::BASE_URL ?>Load/checkin", function(res) {
            if (res == 0) {
                content();
            } else {
                alert(res);
            }
        });
    })
</script>