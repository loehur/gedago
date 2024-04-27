<form action="<?= PC::BASE_URL . $con ?>/req_dep" method="POST">
    <div class="container">
        <div style="max-width: 500px;" class="m-auto px-1">
            <div class="row">
                <div class="col">
                    <span>Withdraw</span>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <small><span>Biaya penarikan sebesar <?= PC::SETTING['wd_fee'] ?>% dipotong langsung dari Total Penarikan</span></small>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col text-center">
                    <span class="">Saldo tersedia <span class="text-success">Rp<?= number_format($data['saldo']) ?></span></span>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col px-2 mb-0" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" style="font-size:17px;" class="form-control shadow-none fw-bold text-success fr_number" name="jumlah" required id="floatingInput1654a">
                        <label for="floatingInput1654a">Jumlah Penarikan</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1 mt-0">
                <div class="col text-danger mb-1">
                    <small id="alert_min" class="d-none">Minimal Penarikan <?= number_format(PC::SETTING['min_wd']) ?></small>
                </div>
            </div>
            <div class="row mt-3 border-top pt-2 mb-3">
                <div class="col px-1 mb-1 text-end">
                    <button type="submit" class="w-100 border-0 py-2 shadow-sm">Withdraw</button>
                </div>
            </div>
        </div>
        <div style="max-width: 500px;" class="m-auto px-1">
            <div class="row">
                <div class="col">
                    <table class="table table-sm">
                        <?php
                        foreach ($data['wd'] as $d) { ?>
                            <tr class="<?= $d['tr_status'] == 2 ? 'table-light' : '' ?>">
                                <td><?= substr($d['insertTime'], 0, 10) ?></td>
                                <td class="text-end mt-auto text-success"><?= number_format($d['amount']) ?></td>
                                <td class="text-end">
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
                                </td>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="<?= PC::ASSETS_URL ?>js/fr_number.js"></script>
<script>
    $(document).ready(function() {
        spinner(0);
    });

    $(".fr_number").keyup(function() {
        var valu = $(this).val();
        var inte = parseInt(valu.replace(/[^,\d]/g, ''));
        if (inte < <?= PC::SETTING['min_wd'] ?>) {
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
                if (res == 0) {
                    location.reload(true);
                } else {
                    alert(res);
                }
            },
        });
    });
</script>