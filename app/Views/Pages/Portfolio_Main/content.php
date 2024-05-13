<?php

$ada_port = false;
if (isset($_SESSION['log'])) {
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
    <div class="container">
        <section>
            <div class="row">
                <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                    <div class="row">
                        <div class="col">
                            <i class="bi bi-wallet2"></i> Total Portfolio <br>
                            <h6 class="fw-bold text-dark">Rp<span class="port_amount">
                                    <?= $ada_port == true ? number_format($porto_bal['saldo'] + $porto_bal['fee_dc'] + $porto_bal['fee_dw']) : 0 ?></span>
                            </h6>
                        </div>
                        <div class="col">
                            <span class="text-dark"><b><span class="level_name text-success"></span></b><br>
                            </span><small><span><?= isset($porto_bal['data']['expired_date']) ? "Expired: " . $porto_bal['data']['expired_date'] : '' ?></span></small>
                        </div>
                    </div>
                    <hr>
                    <h6>Daily Checkin Fee</h6>
                    <div class="row">
                        <div class="col">
                            <?php $df = $data['checkin'];
                            if (isset($df['insertTime'])) {
                                echo substr($df['insertTime'], 0, 10)  . " <span class='text-success float-end'>+Rp" . number_format($df['fee']) . "</span><br>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                    <i class="bi bi-list-task text-warning"></i> Daily Task (<?= count($data['watch']) ?>/<span class="daily_task"></span>)<br>
                    <div class="progress">
                        <?php
                        if (count($data['watch']) == 0) {
                            $persen = 0;
                        } else {
                            $persen = (count($data['watch']) / $w_qty) * 100;
                        }
                        ?>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $persen ?>%"></div>
                    </div>
                    <div class="mt-2">
                        <?php
                        if (isset($porto_bal['data']['level'])) {
                            if (count($data['watch']) < $w_qty) { ?>
                                <span class="btn btn-sm btn-outline-warning" id="btnW" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Watch Video</span>
                                <span class="float-end">Fee Rp<?= number_format(($fee_d / 100) * $data['port_balance']['saldo']) ?> <i class="bi bi-circle"></i></span>
                        <?php }
                        } ?>
                        <hr>

                        <?php
                        foreach ($data['watch'] as $dw) { ?>
                            <div class="row">
                                <div class="col">
                                    <span><small><?= $dw['dw_id'] ?></small></span><span class="float-end text-success">+Rp<?= number_format($dw['fee']) ?></span><br>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                    <i class="bi bi-calendar-check text-info"></i></i> Daily Check-in <br>
                    <span>
                        <?php
                        if (isset($data['checkin']['insertTime'])) {
                        ?>
                            <i class="bi bi-check-circle-fill text-info"></i></i> <?= $data['checkin']['insertTime'] ?>
                            <?php
                        } else {
                            if (isset($porto_bal['data']['user_id'])) { ?>
                                <span id="checkin" class="btn btn-outline-info my-2">Check-in Harian</span>
                            <?php } else { ?>
                                <br>
                                <small><span>Anda belum memiliki produk investasi aktif</span></small>
                        <?php }
                        }
                        ?>
                    </span>
                </div>
                <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
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
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" id="video_content"></div>
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