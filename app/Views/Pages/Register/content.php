<form action="<?= PC::BASE_URL ?>Register/daftar" class="upload" method="POST">
    <div class="container">
        <div style="max-width: 500px;" class="m-auto px-3">
            <h5 class="fw-bold mb-2">Register New Account</h5>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" name="nama" required id="floatingInput456dasf">
                        <label for="floatingInput456dasf">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="email" class="form-control shadow-none" name="mail" required id="floatingInput456">
                        <label for="floatingInput456">Email</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" name="nik" required id="floatingInput1654">
                        <label for="floatingInput1654">NIK</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" name="hp" required id="floatingInput1654a">
                        <label for="floatingInput1654a">Nomor HP (08..)</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="date" value="1990-12-30" class="form-control shadow-none" name="tgl_lahir" required id="floatingInput1222">
                        <label for="floatingInput1222">Tanggal Lahir</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="password" class="form-control shadow-none" name="pw" required id="floatingInput456as">
                        <label for="floatingInput456as">Password</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="password" class="form-control shadow-none" name="repw" required id="floatingInputasdf575">
                        <label for="floatingInputasdf575">Ulangi Password</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control shadow-none" required name="otp" placeholder="Kode OTP">
                        <button class="btn btn-outline-secondary shadow-none" type="button" id="otp">Minta OTP</button>
                    </div>
                </div>
                <div class="col px-1 mb-1">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control shadow-none" <?= $data['rc'] <> '' ? 'readonly' : '' ?> value="<?= $data['rc'] ?>" name="rc" placeholder="Referral Code">
                    </div>
                </div>
            </div>
            <div class="row mt-1 border-top pt-2 mb-2">
                <div class="col px-1 mb-1 text-end">
                    <button type="submit" class="w-100 border-0 py-2 shadow-sm">Register</button>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    Sudah punya Akun? <a href="<?= PC::BASE_URL ?>Login">Login</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        spinner(0);
    });

    $("form.upload").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr('method'),
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
        no = $("input[name=hp]").val();
        if (no == "") {
            alert("Nomor HP kosong");
            return;
        }
        $.post("<?= PC::BASE_URL . $con ?>/req_otp", {
            number: no
        }, ).done(function(res) {
            alert(res);
        })
    })
</script>