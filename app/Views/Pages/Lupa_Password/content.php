<div class="container" style="min-height: 500px;">
    <div class="row">
        <div class="col m-auto" style="max-width: 500px;">
            <label class="mb-2"><small>Setup Password Baru</small></label>
            <form action="<?= PC::BASE_URL . $con ?>/update_pass" method="POST">
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control shadow-none" name="number" value="<?= isset($_SESSION['log']) ? $_SESSION['log']['hp'] : "" ?>" required id="floatingInputsa3r4">
                            <label for="floatingInputsa3r4">Nomor Handphone yang terdaftar</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control shadow-none" required name="otp" placeholder="Kode OTP" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary shadow-none" type="button" id="otp">Minta OTP</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-1 px-2">
                    <div class="col px-1">
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control shadow-none" name="pass1" required id="floatingInput2342">
                            <label for="floatingInput2342">Password Baru</label>
                        </div>
                    </div>
                    <div class="col px-1">
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control shadow-none" name="pass2" required id="floatingInput">
                            <label for="floatingInput">Ulangi Password</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="w-100 bg-success text-white rounded border-0 py-2">Update</button>
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

    $("#otp").click(function() {
        no = $("input[name=number]").val();
        if (no == "") {
            alert("Isi nomor HP terlebih dahulu");
            return;
        }
        $.post("<?= PC::BASE_URL . $con ?>/req_otp", {
            number: no
        }, ).done(function(res) {
            alert(res);
        })
    })

    $("form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: $(this).attr("method"),
            success: function(res) {
                if (res == 0) {
                    alert("Sukses. Password di perbaharui");
                    window.location.href = "<?= PC::BASE_URL ?>Login";
                } else {
                    alert(res);
                }
            },
        });
    });
</script>