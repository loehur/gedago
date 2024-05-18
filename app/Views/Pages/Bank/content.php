<?php $log = $_SESSION['log']; ?>
<div class="px-5 p-3 text-white">
    <div class="row">
        <div class="col mb-2" style="min-width: 200px;">
            <h3 class="p-0 m-0"><?= PC::APP_NAME ?></h3>
        </div>
        <div class="col-auto">
            <h2 class="fw-bold text-dark">Bank Account <i class="bi bi-stars"></i></h2>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div style="max-width: 500px;" class="m-auto">
        <div class="p-4 bg-white bg-opacity-25 rounded-3">
            <form action="<?= PC::BASE_URL . $con ?>/update" class="upload" method="POST">
                <div class="row mb-2">
                    <div class="col px-1" style="min-width: 200px;">
                        <label class="mb-1 fw-bold">Nama Rekening</label>
                        <input type="text" class="form-control rounded-3 py-2 shadow-none" value="<?= $log['nama'] ?>" name="nama_rek">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col px-1" style="min-width: 200px;">
                        <label class="mb-1 fw-bold">Bank</label>
                        <select class="form-select rounded-3 py-2" name="bank" required>
                            <option value="" selected>...</option>
                            <?php foreach (PC::BANK as $b) { ?>
                                <option value="<?= $b ?>" <?= $log['bank'] == $b ? 'selected' : '' ?>><?= $b ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col px-1 mb-1" style="min-width: 200px;">
                        <label class="mb-1 fw-bold">Nomor Rekening</label>
                        <input type="text" class="form-control rounded-3 py-2 shadow-none" value="<?= $log['no_rek'] ?>" name="no_rek" required>
                    </div>
                </div>
                <div class="row mt-1 border-top pt-2 mb-2">
                    <div class="col px-1 mb-1 text-end">
                        <button type="submit" class="border-0 py-2 btn-primary bg-gradient px-5 rounded-pill shadow-sm">Simpan</button>
                    </div>
                </div>
            </form>
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