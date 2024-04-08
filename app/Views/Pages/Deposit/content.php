<form action="<?= PC::BASE_URL . $con ?>/req_dep" method="POST">
    <div class="container">
        <div style="max-width: 500px;" class="m-auto px-1">
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
                    <small id="alert_min" class="d-none">Minimal Deposit 10.000</small>
                </div>
            </div>
            <div class="row mt-3 border-top pt-2 mb-3">
                <div class="col px-1 mb-1 text-end">
                    <button type="submit" class="w-100 border-0 py-2 shadow-sm">Deposit</button>
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
        var inte = parseInt(valu.replace(".", ""));
        if (inte < 10000) {
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