<div class="px-4 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold text-dark">Wallet <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<div class="container mt-4 pb-5 mb-5">
    <div style="max-width: 500px;" class="m-auto">
        <span class="fw-bold mb-2">Main Wallet History</span>
        <?php
        foreach ($data as $d) { ?>
            <div class="row px-2 my-2">
                <div class="col bg-warning bg-gradient bg-opacity-75 rounded py-2">
                    <div class="row">
                        <div class="col">
                            <?php
                            $bt = "None";
                            $opr = "";
                            if ($d['balance_type'] == 1) {
                                if ($d['flow'] == 1) {
                                    $bt = "Deposit";
                                    $opr = "+";
                                } else {
                                    $bt = "Withdraw";
                                    $opr = "-";
                                }
                            } elseif ($d['balance_type'] == 10) {
                                if ($d['flow'] == 2) {
                                    $bt = "Invest";
                                    $opr = "-";
                                } else {
                                    $bt = "Portfolio";
                                    $opr = "+";
                                }
                            } elseif ($d['balance_type'] == 22) {
                                if ($d['flow'] == 1) {
                                    $bt = "Donwline Bonus";
                                    $opr = "+";
                                }
                            } elseif ($d['balance_type'] == 23) {
                                if ($d['flow'] == 1) {
                                    $bt = "Sub_Donwline Bonus";
                                    $opr = "+";
                                }
                            } elseif ($d['balance_type'] == 50) {
                                if ($d['flow'] == 1) {
                                    $bt = "Daily Check-in";
                                    $opr = "+";
                                }
                            } elseif ($d['balance_type'] == 51) {
                                if ($d['flow'] == 1) {
                                    $bt = "Watching Ads";
                                    $opr = "+";
                                }
                            }
                            ?>
                            <span class="fw-bold text-<?= $d['flow'] == 1 ? "success" : "danger"  ?>"><?= $bt ?></span><br>
                            <small><?= substr($d['insertTime'], 0, 16) ?></small>
                        </div>
                        <div class="col fw-bold text-end">
                            <span class="text-<?= $d['flow'] == 1 ? "success" : "danger"  ?>"><?= $opr ?><?= number_format($d['amount']) ?></span>
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