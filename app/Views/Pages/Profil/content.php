<?php $log = $_SESSION['log']; ?>

<div class="container">
    <div style="max-width: 500px;" class="m-auto px-3">
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
        <div class="row mb-1 px-1">
            <div class="col text-center bg-white rounded border p-2" style="min-width: 200px;">
                Referral Link: <button class="btn p-0 shadow-none float-end" data-clipboard-text="<?= PC::HOST . "/Register?rc=" . $log['user_id'] ?>"><i class="bi bi-clipboard"></i></button>
                <br>
                <small><?= PC::HOST . "/Register?rc=" . $log['user_id'] ?></small>
            </div>
        </div>
        <div class="row px-1">
            <div class="col text-center bg-white rounded border p-2 mb-1" style="min-width: 200px;">
                <small><span>Setiap nasabah yang terdaftar melalui Referral Link anda, akan mendapatkan <?= $_SESSION['config']['setting']['up1_fee'] ?>% setiap kali nasabah melakukan investasi, dan <?= $_SESSION['config']['setting']['up2_fee'] ?>% dari downline nasabah Anda.</span></small>
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