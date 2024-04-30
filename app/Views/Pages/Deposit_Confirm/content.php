<?php $d = $data['dep'] ?>

<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <div class="row">
            <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                <div class="row mb-3">
                    <div class="col text-center">
                        <div class="pe-2">Deposit</div>
                        <h4 class="text-success fw-bold"><?= number_format($d['amount']) ?> <button class="btn p-0 shadow-none" data-clipboard-text="<?= $d['amount'] ?>"><i class="bi bi-clipboard"></i></button></h4>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col text-center">
                        Lakukan Transfer ke Rekening berikut:<br>
                        <strong><?= PC::DEP_REK['bank'] ?></strong><br>
                        <strong><?= PC::DEP_REK['name'] ?></strong><br>
                        <div id="val_rek" class="fw-bold text-success">
                            <?= PC::DEP_REK['no'] ?>
                            <button class="btn p-0 shadow-none" data-clipboard-action="copy" data-clipboard-target="#val_rek"><i class="bi bi-clipboard"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col px-2">
                        <ul>
                            <li>
                                <small><span>Jika pengirim bukan atas nama Anda, cantumkan nama Anda pada catatan transfer. [<?= $_SESSION['log']['nama'] ?>]</span></small>
                            </li>
                            <li>
                                Tekan tombol [Sudah sudah Transfer], untuk mempercepat proses pengecekan.
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row mb-5">
                    <div class="col pb-3">
                        <a href="<?= PC::BASE_URL . $con ?>/confirm/<?= $d['balance_id'] ?>"><button class="btn btn-success">Saya sudah Transfer</button></a>
                    </div>
                    <div class="col-auto text-center pb-3">
                        <a href="<?= PC::BASE_URL ?>Deposit/batal/<?= $d['balance_id'] ?>"><button class="btn btn-outline-secondary">Batalkan</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= PC::ASSETS_URL ?>plugins/clipboard.js-master/dist/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.btn');
    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });
</script>