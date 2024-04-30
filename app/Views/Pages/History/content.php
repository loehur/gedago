<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <h5>Main Wallet History</h5>
        <?php
        foreach ($data as $d) { ?>
            <div class="row px-2 my-1">
                <div class="col bg-white border rounded py-2">
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
                                    $bt = "Donwline Fee";
                                    $opr = "+";
                                }
                            } elseif ($d['balance_type'] == 23) {
                                if ($d['flow'] == 1) {
                                    $bt = "Sub_Donwline Fee";
                                    $opr = "+";
                                }
                            }
                            ?>
                            <span class="text-<?= $d['flow'] == 1 ? "success" : "danger"  ?>"><?= $bt ?></span><br>
                            <small><?= substr($d['insertTime'], 0, 10) ?></small>
                        </div>
                        <div class="col text-end">
                            <span class="fw-bold text-<?= $d['flow'] == 1 ? "success" : "danger"  ?>"><?= $opr ?><?= number_format($d['amount']) ?></span>
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