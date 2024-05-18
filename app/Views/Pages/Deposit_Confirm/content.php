<?php $d = $data['dep'] ?>

<div class="container mt-5 mb-5 pb-5">
    <div style="max-width: 650px;" class="m-auto px-3">
        <div class="row">
            <div class="col rounded-3 bg-white bg-opacity-75 p-3" style="min-width: 300px;">
                <div class="row mb-3">
                    <div class="col text-center">
                        <div class="pe-2">Deposit</div>
                        <h4 class="text-success fw-bold"><?= number_format($d['amount']) ?> <button class="btn p-0 shadow-none" data-clipboard-text="<?= $d['amount'] ?>"><i class="bi bi-clipboard"></i></button></h4>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col text-center mb-3" style="min-width: 250px;">
                        <span class="text-warning fw-bold">Via QRIS:</span><br>
                        <img src="<?= PC::BASE_URL ?>files/qr_bank/<?= $_SESSION['config']['dep_rek']['qris'] ?>" class="img-fluid" alt="...">
                    </div>
                    <div class="col" style="min-width: 300px;">
                        <div class="text-center">
                            <span class="text-dark fw-bold">Via Bank Transfer:</span><br>
                            <strong><?= $_SESSION['config']['dep_rek']['bank'] ?></strong><br>
                            <strong><?= $_SESSION['config']['dep_rek']['name'] ?></strong><br>
                            <div id="val_rek" class="fw-bold text-success">
                                <?= $_SESSION['config']['dep_rek']['no'] ?>
                                <button class="btn p-0 shadow-none" data-clipboard-action="copy" data-clipboard-target="#val_rek"><i class="bi bi-clipboard"></i></button>
                            </div>
                        </div>
                        <div class="mt-3 mb-3 border-top pt-2">
                            <ul>
                                <li>
                                    <small><span>Via QRIS/Bank Transfer, pastikan nama pengirim atas nama Anda.<br><strong class="text-danger">[<?= $_SESSION['log']['nama'] ?>]</strong></span></small>
                                </li>
                                <li>
                                    <small>Tekan tombol [Saya sudah Transfer], untuk mempercepat proses pengecekan.</small>
                                </li>
                            </ul>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <a href="<?= PC::BASE_URL . $con ?>/confirm/<?= $d['balance_id'] ?>"><button class="btn btn-primary bg-gradient rounded-pill">Saya sudah Transfer</button></a>
                            </div>
                            <div class="col-auto text-end">
                                <a href="<?= PC::BASE_URL ?>Deposit/batal/<?= $d['balance_id'] ?>"><button class="btn btn-sm border-0 btn-secondary rounded-pill">Batalkan</button></a>
                            </div>
                        </div>
                    </div>
                </div>
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