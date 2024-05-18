<div class="px-5 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold text-dark">Deposit <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<?php $log = $_SESSION['log'] ?>

<div class="container text-white mt-3">
    <div style="max-width: 500px;" class="m-auto">
        <?php if ($data['msg'] == 1) { ?>
            <div class="alert alert-danger" role="alert">
                Masih ada deposit yang sedang berlangsung
            </div>
        <?php } ?>

        <div class="p-4 bg-warning bg-opacity-50 rounded-3">
            <form action="<?= PC::BASE_URL . $con ?>/req_dep" method="POST">
                <div class="row">
                    <div class="col mb-0" style="min-width: 200px;">
                        <label class="text-dark mb-1">Jumlah Deposit <?= PC::DEP_MODE ?></label>
                        <input type="text" style="font-size:17px;" class="form-control text-center rounded-3 shadow-none fw-bold text-success fr_number" name="jumlah" required id="floatingInput1654a">
                    </div>
                </div>
                <div class="row mt-0">
                    <div class="col mb-1 text-center text-danger">
                        <small id="alert_min" class="d-none">Minimal Deposit <?= number_format($_SESSION['config']['setting']['min_deposit']['value']) ?></small>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col mb-1 text-end">
                        <button type="submit" class="px-5 border-0 py-2 shadow-sm btn-primary bg-gradient rounded-pill">Deposit</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="py-2 px-3 text-dark bg-warning bg-opacity-75 rounded-3 mt-3">
            <div class="row">
                <span class="fw-bold">Last Deposit</span>
                <?php
                foreach ($data['dep'] as $d) { ?>
                    <div class="col-auto">
                        <?= substr($d['insertTime'], 0, 10) ?>
                    </div>
                    <div class="col text-end mb-2">
                        <?= number_format($d['amount']) ?>
                    </div>
                    <div class="col-auto text-end">
                        <?php
                        if ($d['dep_mode'] <> 0) {
                            switch ($d['tr_status']) {
                                case 0:
                                    if (strlen($d['transaction_status']) > 0) {
                                        echo $d['transaction_status'] . ' <i class="bi bi-circle-fill text-warning"></i>';
                                    } else { ?>
                                        <a class="btn btn-sm btn-warning py-0 border rounded-pill" href="<?= $d['redirect_url'] ?>">Bayar</a>
                                        <a class="btn btn-sm btn-danger py-0 border rounded-pill" href="<?= PC::BASE_URL ?>Deposit/batal/<?= $d['balance_id'] ?>">Batal</a>
                                    <?php
                                    }
                                    break;
                                case 1:
                                    echo $d['transaction_status'] . ' <i class="bi bi-check-circle-fill text-success"></i>';
                                    break;
                                default:
                                    echo $d['transaction_status'] . ' <i class="bi bi-x-circle-fill text-danger"></i>';
                                    break;
                            }
                        } else {
                            switch ($d['tr_status']) {
                                case 0:
                                    if ($d['user_confirm'] == 0) { ?>
                                        <a class="btn btn-sm btn-warning py-0 border rounded-pill" href="<?= PC::BASE_URL ?>Deposit_Confirm"><span class=''>Konfirmasi</span></a>
                                    <?php } else {
                                        echo 'Checking <i class="bi bi-circle-fill text-warning"></i>';
                                    } ?>
                        <?php break;
                                case 1:
                                    echo 'Success <i class="bi bi-check-circle-fill text-success"></i>';
                                    break;
                                default:
                                    echo 'Failed <i class="bi bi-x-circle-fill text-danger"></i>';
                                    break;
                            }
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        spinner(0);
    });

    $(".fr_number").keyup(function() {
        var valu = $(this).val();
        var inte = parseInt(valu.replace(/[^,\d]/g, ''));
        if (inte < <?= $_SESSION['config']['setting']['min_deposit']['value'] ?>) {
            $("#alert_min").removeClass("d-none");
        } else {
            $("#alert_min").addClass("d-none");
        }
        $(this).val(formatRupiah(valu));
    })

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>