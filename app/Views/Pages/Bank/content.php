<?php $log = $_SESSION['log']; ?>

<form action="<?= PC::BASE_URL . $con ?>/update" class="upload" method="POST">
    <div class="container">
        <div style="max-width: 500px;" class="m-auto px-x">
            <h5 class="fw-bold">Bank Account</h5>
            <div class="row">
                <div class="col px-1" style="min-width: 200px;">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Bank</label>
                        <select class="form-select" name="bank" id="inputGroupSelect01">
                            <option selected>...</option>
                            <?php foreach (PC::BANK as $b) { ?>
                                <option value="<?= $b ?>" <?= $log['bank'] == $b ? 'selected' : '' ?>><?= $b ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" value="<?= $log['no_rek'] ?>" name="no_rek" required id="floatingInput1654">
                        <label for="floatingInput1654">No Rekening</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    Pastikan nama pemilik Rekening adalah <span class="text-danger"><?= $log['nama'] ?></span><br>
                </div>
            </div>
            <div class="row mt-1 border-top pt-2 mb-2">
                <div class="col px-1 mb-1 text-end">
                    <button type="submit" class="w-100 border-0 py-2 btn-success rounded shadow-sm">Simpan</button>
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