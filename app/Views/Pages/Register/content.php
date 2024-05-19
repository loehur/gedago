<form action="<?= PC::BASE_URL ?>Register/daftar" class="ajax" method="POST">
    <div class="container mt-4 pb-5">
        <div style="max-width: 500px;" class="m-auto px-3">
            <a href="<?= PC::BASE_URL ?>">
                <h5 class="text-white mb-0 opacity-75 text-end"><?= PC::APP_NAME ?></h5>
            </a>

            <h2 class="fw-bold text-end mb-3">Register New Account</h2>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none rounded-3 bg-opacity-75" name="nama" required id="floatingInput456dasf">
                        <label for="floatingInput456dasf">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="email" class="form-control shadow-none rounded-3 bg-opacity-75" name="mail" required id="floatingInput456">
                        <label for="floatingInput456">Email</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none rounded-3 bg-opacity-75" name="hp" required id="floatingInput1654a">
                        <label for="floatingInput1654a">Nomor HP (08..)</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="date" value="1990-12-30" class="form-control shadow-none rounded-3 bg-opacity-75" name="tgl_lahir" required id="floatingInput1222">
                        <label for="floatingInput1222">Tanggal Lahir</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="password" class="form-control shadow-none rounded-3 bg-opacity-75" name="pw" required id="floatingInput456as">
                        <label for="floatingInput456as">Password</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="password" class="form-control shadow-none rounded-3 bg-opacity-75" name="repw" required id="floatingInputasdf575">
                        <label for="floatingInputasdf575">Ulangi Password</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control shadow-none rounded-first-3 bg-opacity-75" required name="otp" placeholder="Kode OTP">
                        <button class="btn btn-secondary shadow-none border-light" type="button" id="otp">Minta OTP</button>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none bg-opacity-75" <?= $data['rc'] <> '' ? 'readonly' : '' ?> value="<?= $data['rc'] ?>" name="rc" id="floatingInput456dasfere">
                        <label for="floatingInput456dasfere">Referral Code</label>
                    </div>
                </div>
            </div>
            <div class="row mt-2 mb-4">
                <div class="col px-1 mb-1 text-end">
                    <button type="submit" class="float-end px-5 border-0 btn-primary rounded-pill bg-gradient py-2 shadow-sm">Register</button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col text-white">
                    Sudah punya Akun? <a class="btn btn-warning px-3 mx-2 rounded-pill bg-gradient" href="<?= PC::BASE_URL ?>Login">Login</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        spinner(0);
    });

    $("form.ajax").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr('method'),
            dataType: "html",
            success: function(res) {
                if (res == 0) {
                    alert("Register Sukses!");
                    window.location.href = "<?= PC::BASE_URL ?>Login";
                } else {
                    alert(res);
                }
            },
        });
    });

    $("#otp").click(function() {
        $(this).attr('disabled', 'disabled');
        $(this).prop("disabled", true);

        no = $("input[name=hp]").val();
        if (no == "") {
            alert("Nomor HP kosong");
            return;
        }
        $.post("<?= PC::BASE_URL . $con ?>/req_otp", {
            number: no
        }, ).done(function(res) {
            alert(res);
            $("#otp").removeAttr('disabled');
        })
    })
</script>