<?php $log = $_SESSION['log']; ?>
<div class="px-4 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold text-dark">Bank Account <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<div class="container mt-2 mb-5 pb-5">
    <div style="max-width: 500px;" class="m-auto">
        <div class="px-4 py-3 bg-warning bg-opacity-75 rounded-3">
            <form action="<?= PC::BASE_URL . $con ?>/update" class="upload" method="POST">
                <div class="row mb-2">
                    <div class="col px-1" style="min-width: 200px;">
                        <label class="mb-1 fw-bold">Nama Rekening</label>
                        <input type="text" class="form-control rounded-3 py-2 shadow-none" readonly value="<?= $log['nama'] ?>" name="nama_rek">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col px-1 mb-1" style="min-width: 200px;">
                        <label class="mb-1 fw-bold">Bank</label>
                        <select class="form-select shadow-none rounded-3 py-2" name="bank" required>
                            <option value="" selected>...</option>
                            <?php foreach ($_SESSION['config']['bank'] as $b) { ?>
                                <option value="<?= $b['bankCode'] ?>" <?= $log['bank_code'] == $b['bankCode'] ? 'selected' : '' ?>><?= $b['bankName'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col px-1 mb-1" style="min-width: 200px;">
                        <label class="mb-1 fw-bold">Nomor Rekening</label>
                        <input type="text" class="form-control rounded-3 py-2 shadow-none" value="<?= $log['no_rek'] ?>" name="no_rek" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col text-end">
                        <button type="submit" class="border-0 py-2 btn-primary bg-gradient px-5 rounded-pill shadow-sm">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="py-2 px-3 mt-3 bg-warning bg-opacity-75 rounded-3">
            <label class="w-100 fw-bold mb-2 text-center">Registered Bank</label><br>
            <div class="row">
                <div class="col-auto">Bank</div>
                <div class="col text-end fw-bold"><?= $log['bank'] ?></div>
            </div>
            <div class="row">
                <div class="col-auto">Nomor</div>
                <div class="col text-end fw-bold"><?= $log['no_rek'] ?></div>
            </div>
            <div class="row">
                <div class="col-auto">Nama</div>
                <div class="col text-end fw-bold"><?= $log['nama'] ?></div>
            </div>
        </div>
    </div>
</div>

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