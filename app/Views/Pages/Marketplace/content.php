<div class="px-4 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold ">Store <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<div class="container mt-3 pb-5 mb-5">
    <section>
        <div class="row text-white">
            <?php if (isset($data['data']['user_id'])) { ?>
                <div class="col p-0" style="min-width:300px">
                    <div class="rounded-3 gedago_card m-2">
                        <div class="row py-4">
                            <div class="col text-center px-4">
                                <h3>My Portfolio</h3>
                                <h6>
                                    <span class="fw-bold">
                                        Rp<?= number_format($data['saldo'])  ?>
                                    </span>
                                </h6>
                                <hr>
                                <small>Just add according to the minimum top up limit, to upgrade your investment.</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php foreach ($_SESSION['config']['level'] as $d) {

                if (isset($data['data']['user_id'])) {
                    if ($data['data']['level'] > $d['level']) {
                        continue;
                    }
                } ?>

                <div class="col p-0" style="min-width:300px">
                    <div class="gedago_card border <?= (isset($data['data']['user_id']) && $data['data']['level'] == $d['level']) ? "border-warning" : "border-0" ?> rounded-3 m-2">
                        <div class="row">
                            <div class="col text-center pb-1">
                                <h4 class="fw-bold pt-3">
                                    <span class="w-100 fw-bold"><?= $d["name"] ?></span>
                                </h4>
                                <h6 class="fw-bold">Rp <?= number_format($d['topup']) ?></h6>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col px-4">
                                <span class="px-2">Benefit:</span>
                                <ul class="">
                                    <li><?= $d['days'] ?> Days Investment</li>
                                    <?php foreach ($d['benefit'] as $b) { ?>
                                        <li><?= $b['qty'] ?>x <?= $b['name'] ?> Fee <?= $b['fee'] ?>%</li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn py-3 rounded-3 w-100 shadow-sm <?= (isset($data['data']['user_id']) && $data['data']['level'] == $d['level']) ? "btn-dark" : "btn-warning" ?> topup" data-topup="<?= $d['topup'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= (isset($data['data']['user_id'])) ? "Upgrade" : "Invest" ?> <b><?= $d['name'] ?></b></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= PC::BASE_URL ?>Marketplace/Invest" method="POST">
            <div class="modal-content bg-warning bg-gradient">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0 text-center">
                    <div class="px-2">
                        <label class="mb-1 fw-bold float-start">Amount</label>
                        <label class="mb-1 fw-bold float-end">Minimum <span class="text-danger">Rp</span><span class="text-danger" id="topup"></span></label>
                    </div>
                    <input type="text" style="font-size:17px;" class="form-control rounded-3 text-center shadow-none fw-bold text-success fr_number" name="topup" required>
                    <?php if (isset($data['data']['user_id'])) { ?>
                        <br>My Portfolio Now <span class="text-success fw-bold">Rp<?= number_format($data['saldo']) ?></span><br>
                        <small>Just add according to the minimum top up limit, to upgrade your investment.</small>
                    <?php } ?>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary bg-gradient rounded-pill px-3">Invest</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $("form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                if (res == 0) {
                    alert("Penambahan investasi sukses!");
                    window.location.href = "<?= PC::BASE_URL ?>Home";
                } else {
                    alert(res);
                }
            },
        });
    });

    var topup = 0;
    $(document).ready(function() {
        $("span.balance_amount").load("<?= PC::BASE_URL ?>Load/balance");
        spinner(0);
    });

    $(".topup").click(function() {
        $("span#topup").html(formatRupiah($(this).attr("data-topup")));
        topup = $(this).attr("data-topup");
    })

    $(".fr_number").keyup(function() {
        var valu = $(this).val();
        var inte = parseInt(valu.replace(".", ""));
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