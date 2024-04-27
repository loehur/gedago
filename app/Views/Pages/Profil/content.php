<?php $log = $_SESSION['log']; ?>

<form action="<?= PC::BASE_URL . $con ?>/update" class="upload" method="POST">
    <div class="container">
        <div style="max-width: 500px;" class="m-auto px-2">
            <h5 class="fw-bold">Profil</h5>
            <div class="row">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" readonly value="<?= $log['nama'] ?>" required id="floatingInpwrer">
                        <label for="floatingInpwrer">Nama</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" readonly value="<?= $log['nik'] ?>" required id="floatingInpwr434d">
                        <label for="floatingInpwr434d">NIK</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" readonly value="<?= $log['hp'] ?>" required id="floatingInpwrersdf">
                        <label for="floatingInpwrersdf">No. Handphone</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" readonly value="<?= $log['registered'] ?>" required id="floatingInpwr3434">
                        <label for="floatingInpwr3434">Registered</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" readonly value="<?= $log['tgl_lahir'] ?>" required id="floatingInpwr343434">
                        <label for="floatingInpwr343434">Tanggal Lahir</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" readonly value="<?= $log['user_id'] ?>" required id="floatingInpwr3dgfas9">
                        <label for="floatingInpwr3dgfas9">Referral Code Anda</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" readonly value="<?= PC::HOST . "/Register?rc=" . $log['user_id'] ?>" required id="floatingInpwr343493">
                        <label for="floatingInpwr343493">Referral Link</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <small><span>Setiap nasabah yang terdaftar melalui Referral Link anda, akan mendapatkan <?= PC::SETTING['up1_fee'] ?>% setiap kali nasabah melakukan investasi, dan <?= PC::SETTING['up2_fee'] ?>% dari downline nasabah Anda.</span></small>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        spinner(0);
    });

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