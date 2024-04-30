<?php
$level = 0;
$ada_port = false;
if (!isset($_SESSION['log'])) { ?>
    <div class="container">
        <section class="py-2 my-2 mt-4 text-center bg-dark">
            <video controls autoplay muted width="100%" style="max-width: 500px;" id="video_play">
                <source src="<?= PC::ASSETS_URL ?>video/gedago.mp4" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </section>
        <section class="py-2">
            <div class="row px-2">
                <!-- <div class="col-auto mb-2" style="min-width: 200px;">
                    <img src="assst/img/banner/banner_en2.png" class="img-fluid" alt="">
                </div> -->
                <div class="col rounded mx-1 bg-white shadow-sm p-3" style="min-width: 200px;">
                    <h4 class="fw-bold">Financial Freedom Begins Here</h4>
                    <p align="justify">
                        Welcome to our investment platform that revolutionizes the way you approach finance. Here, we understand that each individual has unique financial goals. With our inclusive vision, we present investment opportunities accessible to anyone, from beginners to seasoned investors. We offer a diverse range of investment instruments designed to optimize your potential returns, from the stock market to bonds, and beyond.
                    </p>
                    <p align="justify">
                        We build relationships based on trust and transparency. Our team of experts will guide you through every step of your investment journey, from portfolio selection to risk management. With our advanced technology, you can access your portfolio anytime, anywhere, giving you full control over your investments.
                    </p>
                </div>
            </div>
        </section>
        <section class="py-2">
            <div class="row px-2">
                <div class="col bg-white rounded text-center shadow-sm p-3 mx-1 my-2" style="min-width: 200px;">
                    <h5 class="fw-bold"><i class="bi bi-safe"></i></h5>
                    <p>Investing allows you to grow your wealth over time, providing financial security for the future.</p>
                </div>
                <div class="col bg-white rounded text-center shadow-sm p-3 mx-1 my-2" style="min-width: 200px;">
                    <h5 class="fw-bold"><i class="bi bi-archive"></i></h5>
                    <p>Embracing the benefits of investing empowers you to take control of your financial destiny and achieve your dreams.</p>
                </div>
                <div class="col bg-white rounded text-center shadow-sm p-3 mx-1 my-2" style="min-width: 200px;">
                    <h5 class="fw-bold"><i class="bi bi-back"></i></h5>
                    <p>Investing teaches valuable financial discipline and encourages responsible wealth management practices.</p>
                </div>

            </div>
        </section>
    </div>

    </div>
<?php } else {
    if (count($data['port_balance']) > 0) {
        $porto_bal = $data['port_balance'];
        foreach (PC::LEVEL as $pl) {
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
    <div class="container-fluid border-0">
        <div class="container">
            <section>
                <div class="row">
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <div class="row">
                            <div class="col">
                                <i class="bi bi-wallet"></i> Main Wallet <br>
                                <h5 class="fw-bold text-dark">Rp<span class="balance_amount">0</span></h5>
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="col-auto p-1">
                                <a href="<?= PC::BASE_URL ?>Deposit"><button class="btn btn-sm btn-success">Deposit</button></a>
                            </div>
                            <div class="col-auto p-1">
                                <a href="<?= PC::BASE_URL ?>Withdraw"><button class="btn btn-sm btn-warning">Withdraw</button></a>
                            </div>
                        </div>
                    </div>
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
                        <div class="row">
                            <div class="col">
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
                            </div>
                            <div class="col">
                                <i class="bi bi-calendar-check text-info"></i></i> Daily Check-in <br>
                                <h6 class="text-dark">
                                    <?php
                                    if (isset($data['checkin']['insertTime'])) { ?>
                                        <i class="bi bi-check-circle-fill text-info"></i></i> <?= substr($data['checkin']['insertTime'], -8)  ?>
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
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {
        $("span.balance_amount").load("<?= PC::BASE_URL ?>Load/balance");
        $("span.level_name").load("<?= PC::BASE_URL ?>Load/level_name/<?= $level ?>");
        $("span.daily_task").load("<?= PC::BASE_URL ?>Load/daily_task/<?= $level ?>");
        spinner(0);
    });

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