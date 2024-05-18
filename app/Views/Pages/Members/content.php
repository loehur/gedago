<?php $members2 = 0; ?>
<div class="px-5 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold text-dark">Bank Account <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="m-auto" style="max-width: 600px;">
        <div class="row">
            <div class="col m-1 rounded bg-warning bg-gradient bg-opacity-75 p-3" style="min-width: 300px;">
                <div class="row">
                    <div class="col">Downline Langsung</div>
                    <div class="col text-end"><?= count($data) ?></div>
                </div>
                <div class="row">
                    <div class="col">Turunan</div>
                    <div class="col text-end" id="turunan">0</div>
                </div>
                <hr class="my-1">
                <div class="row">
                    <div class="col">Total</div>
                    <div class="col text-end" id="total_d">0</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col m-1 rounded bg-warning bg-gradient bg-opacity-75 p-3" style="min-width: 300px;">
                <?php foreach ($data as $d) { ?>
                    <div class="row">
                        <div class="col">
                            <span class=""><?= strtoupper($d['nama']) ?></span>
                            <?php
                            $data2 = $this->db(0)->get_where("user", "up = '" . $d['user_id'] . "'");
                            $members2 += count($data2);
                            if (count($data2) > 0) {
                                foreach ($data2 as $d2) { ?>
                                    <div class="row ps-2">
                                        <div class="col">
                                            <small><i class="bi bi-arrow-return-right"></i> <?= strtoupper($d2['nama']) ?></small>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            <?php }
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <pre>
                </pre>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("div#turunan").html("<?= $members2 ?>");
            $("div#total_d").html(<?= $members2 + count($data) ?>);
            spinner(0);
        });
    </script>