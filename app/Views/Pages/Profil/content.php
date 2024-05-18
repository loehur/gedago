<?php $log = $_SESSION['log']; ?>
<div class="px-5 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold text-dark">Wallet <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<div class="container mt-3 pb-5 mb-5 text-white">
    <div style="max-width: 500px;" class="m-auto">
        <div style="max-width: 500px;" class="m-auto">
            <h5 class="fw-bold text-dark">My Profil</h5>
            <div class="row">
                <div class="col px-1 mb-2" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control text-white border-0 gedago_card shadow-none" readonly value="<?= $log['nama'] ?>" required id="floatingInpwrer">
                        <label class="" for="floatingInpwrer">Nama</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col px-1 mb-2" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control text-white border-0 gedago_card shadow-none" readonly value="<?= $log['hp'] ?>" required id="floatingInpwrersdf">
                        <label class="" for="floatingInpwrersdf">No. Handphone</label>
                    </div>
                </div>
                <div class="col px-1 mb-2" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control text-white border-0 gedago_card shadow-none" readonly value="<?= $log['registered'] ?>" required id="floatingInpwr3434">
                        <label class="" for="floatingInpwr3434">Registered</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col px-1 mb-2" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control text-white border-0 gedago_card shadow-none" readonly value="<?= $log['tgl_lahir'] ?>" required id="floatingInpwr343434">
                        <label class="" for="floatingInpwr343434">Tanggal Lahir</label>
                    </div>
                </div>
                <div class="col px-1 mb-2" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control text-white border-0 gedago_card shadow-none" readonly value="<?= $log['user_id'] ?>" required id="floatingInpwr3dgfas9">
                        <label class="" for="floatingInpwr3dgfas9">Referral Code Anda</label>
                    </div>
                </div>
            </div>
            <div class="row mb-2 px-1">
                <div class="col text-center gedago_card rounded p-2" style="min-width: 200px;">
                    Referral Link: <button class="btn p-0 shadow-none float-end" data-clipboard-text="<?= PC::HOST . "/Register?rc=" . $log['user_id'] ?>"><i class="bi bi-clipboard"></i></button>
                    <br>
                    <small><?= PC::HOST . "/Register?rc=" . $log['user_id'] ?></small>
                </div>
            </div>
            <div class="row px-1">
                <div class="col text-center gedago_card rounded p-2 mb-2" style="min-width: 200px;">
                    <small><span>Setiap nasabah yang terdaftar melalui Referral Link anda, akan mendapatkan <?= $_SESSION['config']['setting']['up1_fee']['value'] ?>% setiap kali nasabah melakukan investasi, dan <?= $_SESSION['config']['setting']['up2_fee']['value'] ?>% dari downline nasabah Anda.</span></small>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= PC::ASSETS_URL ?>plugins/clipboard/clipboard.min.js"></script>
    <script>
        $(document).ready(function() {
            spinner(0);
        });

        var clipboard = new ClipboardJS('.btn');
        clipboard.on('success', function(e) {
            console.info('Action:', e.action);
            console.info('Text:', e.text);
            console.info('Trigger:', e.trigger);

            e.clearSelection();
        });
    </script>