<style>
    .icon_circle {
        height: 42px;
        width: 42px;
        background-color: white;
        border-radius: 50%;
        opacity: 0.7;
    }
</style>
<?php
$level = 0;
$ada_port = false;
if (count($data['port_balance']) > 0) {
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
<div class="px-4 p-3">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="text-dark fw-bold p-0 m-0"><?= PC::APP_NAME ?></h3>
            Welcome, <?= ucfirst(strtok($_SESSION['log']['nama'], " ")); ?>!
        </div>
        <div class="col-auto">
            <div class="bg-warning rounded-3 px-4 py-2">
                <i class="bi bi-wallet me-2"></i>
                <div class="fw-bold float-end">Rp<span class="balance_amount">0</span></div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-2 pb-5 mb-5">
    <div class="row">
        <?php foreach ($data['card'] as $dc) { ?>
            <div class="col my-3">
                <div class="text-white gedago_card rounded p-3" style="min-width: 300px;">
                    <div class="row">
                        <div class="w-100" style="height: 0;">
                            <div class="col p-0 text-center" style="position: relative; top:-35px">
                                <h1 class="text-dark"><?= $dc['icon'] ?></h1>
                            </div>
                        </div>
                        <div class="col m-0">
                            <h3 class="float-start"><?= $dc['title'] ?></h3>
                        </div>
                        <div class="col">
                            <div class="float-end icon_circle ps-2 pt-1">
                                <div class="text-dark">
                                    <h3><?= $dc['icon2'] ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <small><?= $dc['m1'] ?></small>
                            <h3><?= $dc['m1_v'] ?></h3>
                        </div>
                        <div class="col-auto text-end">
                            <div class="form-switch float-end">
                                <input class="form-check-input bg-success border-success shadow-none" type="checkbox" checked>
                            </div>
                            <br><?= $dc['m2'] ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("span.balance_amount").load("<?= PC::BASE_URL ?>Load/balance");
        spinner(0);
    });
</script>