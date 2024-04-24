<div class="container-fluid border-0">
    <div class="container">
        <section>
            <div class="row">
                <?php if (isset($_SESSION['portfolio']['user_id'])) { ?>
                    <div class="col p-0" style="min-width:300px">
                        <div class="border rounded bg-white m-2">
                            <div class="row bg-light mx-1">
                                <div class="col text-center pt-3 pb-1">
                                    <h6 class="fw-bold text-dark">
                                        <span class="w-100 fw-bold">Active Investment</span><br>
                                        <span class="text-success"><?= isset($_SESSION['portfolio']['name']) ? $_SESSION['portfolio']['name'] : "" ?></span>
                                    </h6>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col text-center px-2">
                                    Total Investasi Anda<br>
                                    <span class="text-dark">Rp<?= number_format($_SESSION['portfolio']['saldo'])  ?></span>
                                    <br>
                                    <small>Untuk melakukan Upgrade, cukup tambahkan nominal investasi sesuai batas minimal Investasi yang dipilih.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php foreach ($data as $d) {

                    if (isset($_SESSION['portfolio']['user_id'])) {
                        if ($_SESSION['portfolio']['level'] > $d['level']) {
                            continue;
                        }
                    } ?>

                    <div class="col p-0" style="min-width:300px">
                        <div class="border <?= (isset($_SESSION['portfolio']['user_id']) && $_SESSION['portfolio']['level'] == $d['level']) ? "border-success" : "border-warning" ?> rounded bg-white m-2">
                            <div class="row bg-light mx-1">
                                <div class="col text-center pt-3 pb-1">
                                    <h5 class="fw-bold text-dark">
                                        <span class="w-100 fw-bold"><?= $d["name"] ?></span>
                                    </h5>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col text-dark text-center">
                                    <b>Min. Topup Rp<?= number_format($d['topup']) ?></b>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col px-4">
                                    <span class="">Benefit:</span>
                                    <ul class="text-dark">
                                        <li><?= $d['days'] ?> Days Investment</li>
                                        <?php foreach ($d['benefit'] as $b) { ?>
                                            <li><?= $b['qty'] ?>x <?= $b['name'] ?> Fee <?= $b['fee'] ?>%</li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="btn rounded-0 w-100 shadow-sm <?= (isset($_SESSION['portfolio']['user_id']) && $_SESSION['portfolio']['level'] == $d['level']) ? "btn-success" : "btn-warning" ?> topup" data-topup="<?= $d['topup'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= (isset($_SESSION['portfolio'])) ? "Upgrade" : "Invest" ?> <b><?= $d['name'] ?></b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form action="<?= PC::BASE_URL ?>Marketplace/Invest" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nominal Invest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label>Min. Invest <span class="text-danger">Rp</span><span class="text-danger" id="topup"></span></label>
                    <input type="text" style="font-size:17px;" class="form-control shadow-none fw-bold text-success fr_number" name="topup" required>
                    <?php if (isset($_SESSION['portfolio']['user_id'])) { ?>
                        <br>Investasi Anda: Rp<span class="text-success"><?= number_format($_SESSION['portfolio']['saldo']) ?></span><br>
                        <small>Cukup tambahkan sesuai batas minimal topup, untuk upgrade Investasi Anda.</small>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Invest</button>
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