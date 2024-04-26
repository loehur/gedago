<?php if (isset($_SESSION['log'])) {
    $porto_bal = $this->func("Portfolio")->portfolio() ?>
    <div class="container-fluid border-0">
        <div class="container">
            <section>
                <div class="row">
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <div class="row">
                            <div class="col">
                                <i class="bi bi-wallet2"></i> Total Portfolio <br>
                                <h6 class="fw-bold text-dark">Rp<span class="port_amount"><?= number_format($porto_bal['saldo'] + $porto_bal['fee_dc']) ?></span></h6>
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
                                <?php foreach ($data['fee_dc'] as $df) {
                                    echo substr($df['insertTime'], 0, 10)  . " <span class='text-success float-end'>+Rp" . number_format($df['amount']) . "</span><br>";
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <i class="bi bi-list-task text-warning"></i> Daily Task (0/<span class="daily_task"></span>)<br>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 0%"></div>
                        </div>
                        <div class="mt-2">
                            <?php
                            if (isset($porto_bal['data']['level'])) {
                                $fee_d = $this->func("Level")->watch_fee($porto_bal['data']['level']); ?>
                                <span class="btn btn-sm btn-outline-warning" id="btnW" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Watch Video</span>
                                <span class="float-end">Fee Rp<?= number_format(($fee_d / 100) * $data['port_balance']['saldo']) ?> <i class="bi bi-circle"></i></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <i class="bi bi-calendar-check text-info"></i></i> Daily Check-in <br>
                        <span>
                            <?php
                            if (is_array($data['checkin']) && isset($data['checkin']['updateTime'])) {
                                $fee = $this->db(0)->get_where_row("balance", "ref = '" . $data['checkin']['dc_id'] . "'")['amount'];
                            ?>
                                <i class="bi bi-check-circle-fill text-info"></i></i> <?= $data['checkin']['updateTime'] ?>
                                <span class="float-end">Fee Rp<?= number_format($fee) ?> <i class="bi bi-check-circle text-info"></i></span>
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
                        <?php foreach ($data['porto'] as $pr) { ?>
                            <div class="row border-top">
                                <div class="col">
                                    <small><?= $pr['insertTime'] ?></small><br>
                                    Level <?= $this->func("Level")->level_nm($pr['level']) ?> <?= $pr['port_status'] == 0 ? "Active" : "Expired" ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
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
        $("span.level_name").load("<?= PC::BASE_URL ?>Load/level_name");
        $("span.daily_task").load("<?= PC::BASE_URL ?>Load/daily_task");
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