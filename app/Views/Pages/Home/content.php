<?php if (!isset($_SESSION['log'])) { ?>
    <div class="container-fluid border-0">
        <div class="container">
            <section class="py-1">
                <div class="row">
                    <div class="col-md-4 pt-2">
                        <h4 class="fw-bold">Digital Intelligence Service Center</h4>
                        <p>
                            More than 3,000 Fortune 500 and emerging high-growth brands
                            Using ST to bring consumers the ultimate service experience
                        </p>
                    </div>
                    <div class="col">
                        <img src="<?= PC::ASSETS_URL ?>img/banner/banner_en.png" class="img-fluid" alt="">
                    </div>
                </div>
            </section>

            <section class="py-1">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/kBlcWM3SWjE?si=y0Qdj0mHS6hMHXOS&controls=0&start=1&autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </section>

            <section class="py-3">
                <div class="row px-2">
                    <div class="col rounded text-center shadow-sm px-1 mx-1 my-2" style="min-width: 200px;">
                        <h5 class="fw-bold">Level</h5>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia facilis, sapiente architecto quae tempora error est aut consectetur assumenda minima atque itaque neque ut ea perferendis fugit, temporibus illum optio?</p>
                    </div>
                    <div class="col rounded text-center shadow-sm px-1 mx-1 my-2" style="min-width: 200px;">
                        <h5 class="fw-bold">Level</h5>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia facilis, sapiente architecto quae tempora error est aut consectetur assumenda minima atque itaque neque ut ea perferendis fugit, temporibus illum optio?</p>
                    </div>
                    <div class="col rounded text-center shadow-sm px-1 mx-1 my-2" style="min-width: 200px;">
                        <h5 class="fw-bold">Level</h5>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia facilis, sapiente architecto quae tempora error est aut consectetur assumenda minima atque itaque neque ut ea perferendis fugit, temporibus illum optio?</p>
                    </div>

                </div>
            </section>
        </div>

    </div>
<?php } else { ?>
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
                                <button class="btn btn-sm btn-warning">Withdraw</button>
                            </div>
                            <div class="col-auto p-1">
                                <button class="btn btn-sm btn-info">History</button>
                            </div>
                        </div>
                    </div>
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        Active Investment <br>
                        <h5 class="text-dark"><b><span class="level_name text-success"></span></b></h5>
                        <small><span><?= isset($_SESSION['portfolio']['expired_date']) ? "Expired Date: " . $_SESSION['portfolio']['expired_date'] : '' ?></span></small>
                    </div>
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <i class="bi bi-list-task text-warning"></i> Daily Task (0/<span class="daily_task"></span>)<br>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 0%"></div>
                        </div>
                        <?php
                        if (isset($_SESSION['portfolio']['level'])) { ?>
                            <a href="<?= PC::BASE_URL ?>Portfolio_Main"><span id="task" class="btn btn-outline-warning my-2">Kerjakan Tugas Harian</span></a>
                        <?php } ?>
                    </div>
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <i class="bi bi-calendar-check text-info"></i></i> Daily Check-in <br>
                        <h6 class="text-dark">
                            <?php
                            if (is_array($data['checkin']) && isset($data['checkin']['updateTime'])) { ?>
                                <i class="bi bi-check-circle-fill text-info"></i></i> <?= $data['checkin']['updateTime'] ?>
                                <?php
                            } else {
                                if (isset($_SESSION['portfolio']['user_id'])) { ?>
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
            </section>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {
        $("span.balance_amount").load("<?= PC::BASE_URL ?>Load/balance");
        $("span.level_name").load("<?= PC::BASE_URL ?>Load/level_name");
        $("span.daily_task").load("<?= PC::BASE_URL ?>Load/daily_task");
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