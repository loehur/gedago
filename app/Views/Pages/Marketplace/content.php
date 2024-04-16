<div class="container-fluid border-0">
    <div class="container">
        <section>
            <div class="row">
                <?php foreach ($data as $d) { ?>
                    <div class="col p-0" style="min-width:300px">
                        <div class="border border-warning rounded bg-white m-2">
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
                                        <?php foreach ($d['benefit'] as $b) { ?>
                                            <li><?= $b ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button class="btn rounded-0 w-100 shadow-sm btn-warning">Invest <b><?= $d['name'] ?></b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("span.balance_amount").load("<?= PC::BASE_URL ?>Load/balance");
        spinner(0);
    });
</script>