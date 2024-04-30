<?php $members2 = 0; ?>
<div class="container-fluid border-0">
    <div class="container">
        <section>
            <div class="row">
                <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
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
                <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
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
        </section>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("div#turunan").html("<?= $members2 ?>");
        $("div#total_d").html(<?= $members2 + count($data) ?>);
        spinner(0);
    });
</script>