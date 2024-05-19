<div class="px-4 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold text-dark">Withdraw <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<?php $log = $_SESSION['log'] ?>

<form action="<?= PC::BASE_URL . $con ?>/req_dep" method="POST">
    <div class="container pb-5 mb-5">
        <div style="max-width: 500px;" class="m-auto">
            <div class="alert d-none res_info"></div>
            <div class="col rounded-3 bg-warning bg-opacity-50 p-4" style="min-width: 300px;">
                <div class="row mb-2">
                    <div class="col text-end">
                        <span class="">Saldo tersedia: <span class="fw-bold">Rp<?= number_format($data['saldo']) ?></span></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col px-1 mb-0" style="min-width: 200px;">
                        <label class="mb-1 text-dark">Jumlah Penarikan</label>
                        <input type="text" style="font-size:17px;" class="form-control text-center rounded-3 shadow-none fw-bold text-success fr_number" name="jumlah" required id="floatingInput1654a">
                    </div>
                </div>
                <div class="row mb-1 mt-0">
                    <div class="col text-dark mb-1">
                        <small id="alert_min" class="d-none">Minimal Penarikan <?= number_format($_SESSION['config']['setting']['min_wd']['value']) ?></small>
                    </div>
                </div>
                <div class="row mt-2 pt-2">
                    <div class="col px-1 mb-1 text-end">
                        <button type="submit" class="px-5 py-2 shadow-sm btn-primary border-0 rounded-pill bg-gradient rounded">Withdraw</button>
                    </div>
                </div>

                <div class="px-2">
                    <label class="w-100 fw-bold">Bank Penerima</label><br>
                    <div class="row">
                        <div class="col">Bank</div>
                        <div class="col text-end fw-bold"><?= $log['bank'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col">Nomor Rekening</div>
                        <div class="col text-end fw-bold"><?= $log['no_rek'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col">Nama Pemlik</div>
                        <div class="col text-end fw-bold"><?= $log['nama'] ?></div>
                    </div>
                </div>
            </div>

            <div class="col py-2 px-3 text-dark bg-warning bg-opacity-75 rounded-3 mt-3">
                <div class="row">
                    <span class="fw-bold">Last Withdraw</span>
                    <?php
                    foreach ($data['wd'] as $d) { ?>
                        <div class="col-auto">
                            <?= substr($d['insertTime'], 0, 16) ?>
                        </div>
                        <div class="col text-end">
                            <?= number_format($d['amount']) ?>
                        </div>
                        <div class="col-auto text-end">
                            <?php
                            switch ($d['tr_status']) {
                                case 0:
                                    echo 'Checking <i class="bi bi-circle-fill text-warning"></i>';
                                    break;
                                case 1:
                                    echo 'Success <i class="bi bi-check-circle-fill text-success"></i>';
                                    break;
                                default:
                                    echo 'Failed <i class="bi bi-x-circle-fill text-danger"></i>';
                                    break;
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col p-2 text-dark bg-warning bg-opacity-75 rounded-3 mt-3">
                <div class="row">
                    <div class="col pb-0">
                        <ul class="mb-0">
                            <li>Jumlah minimal penarikan = Rp. <?= number_format($_SESSION['config']['setting']['min_deposit']['value']) ?></li>
                            <li>Penarikan dana akan hanya dilakukan ke rekening yang di daftarkan</li>
                            <li>Penarikan akan diproses langsung setelah pengisian form withdraw</li>
                            <li>Hubungi customer service atau live admin untuk konfirmasi penarikan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        spinner(0);
    });

    $(".fr_number").keyup(function() {
        var valu = $(this).val();
        var inte = parseInt(valu.replace(/[^,\d]/g, ''));
        if (inte < <?= $_SESSION['config']['setting']['min_wd']['value'] ?>) {
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

    $("form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                resInfo(res);
            },
        });
    });
</script>