<div class="container">
    <div style="max-width: 500px;" class="m-auto px-3">
        <?php if ($data['msg'] == 1) { ?>
            <div class="alert alert-danger" role="alert">
                Masih ada deposit yang sedang berlangsung
            </div>
        <?php } ?>
        <form action="<?= PC::BASE_URL . $con ?>/req_dep" method="POST">
            <h5 class="fw-bold mb-2">Deposit</h5>
            <div class="row mb-0">
                <div class="col px-1 mb-0" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" style="font-size:17px;" class="form-control shadow-none fw-bold text-success fr_number" name="jumlah" required id="floatingInput1654a">
                        <label for="floatingInput1654a">Jumlah</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1 mt-0">
                <div class="col text-danger mb-1">
                    <small id="alert_min" class="d-none">Minimal Deposit <?= number_format(PC::SETTING['min_deposit']) ?></small>
                </div>
            </div>
            <div class="row mt-3 border-top pt-2 mb-3">
                <div class="col px-1 mb-1 text-end">
                    <button type="submit" class="w-100 border-0 py-2 shadow-sm btn-success rounded">Deposit</button>
                </div>
            </div>
        </form>
    </div>
    <div style="max-width: 500px;" class="m-auto px-1">
        <div class="row">
            <div class="col">
                <table class="table table-sm">
                    <?php
                    foreach ($data['dep'] as $d) { ?>
                        <tr class="<?= $d['tr_status'] == 2 ? 'table-light' : '' ?>">
                            <td><?= substr($d['insertTime'], 0, 10) ?></td>
                            <td class="text-end mt-auto text-success"><?= number_format($d['amount']) ?></td>
                            <td class="text-end">
                                <?php
                                if ($d['dep_mode'] == 1) {
                                    switch ($d['tr_status']) {
                                        case 0: ?>
                                            <a href="<?= $d['redirect_url'] ?>"><span class='btn btn-sm py-0 text-primary'><u>Bayar</u></span></a>
                                            <a href="<?= PC::BASE_URL ?>Deposit/batal/<?= $d['balance_id'] ?>"><span class='btn py-0 pe-0 btn-sm'><u>Batal</u></span></a>
                                            <?php break;
                                        case 1:
                                            echo 'Success <i class="bi bi-check-circle-fill text-success"></i>';
                                            break;
                                        default:
                                            echo 'Failed <i class="bi bi-x-circle-fill text-danger"></i>';
                                            break;
                                    }
                                } else {
                                    switch ($d['tr_status']) {
                                        case 0:
                                            if ($d['user_confirm'] == 0) { ?>
                                                <a href="<?= PC::BASE_URL ?>Deposit_Confirm"><span class='btn btn-sm py-0 text-primary'><u>Konfirmasi</u></span></a>
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

<script>
    $(document).ready(function() {
        spinner(0);
    });

    $(".fr_number").keyup(function() {
        var valu = $(this).val();
        var inte = parseInt(valu.replace(/[^,\d]/g, ''));
        if (inte < <?= PC::SETTING['min_deposit'] ?>) {
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