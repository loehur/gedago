<form action="<?= PC::BASE_URL . $con ?>/login" method="POST">
    <div class="container">
        <div style="max-width: 500px;" class="m-auto px-3">
            <h5 class="fw-bold mb-2">Login</h5>
            <div class="row mb-1">
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="text" class="form-control shadow-none" name="hp" required id="floatingInput1654a">
                        <label for="floatingInput1654a">Nomor HP (08..)</label>
                    </div>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <div class="form-floating">
                        <input type="password" class="form-control shadow-none" name="pw" required id="floatingInput456as">
                        <label for="floatingInput456as">Password</label>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col text-end">
                    <a href="<?= PC::BASE_URL ?>Lupa_Password">Lupa Password?</a>
                </div>
            </div>
            <div class="row mt-3 border-top pt-2 mb-3">
                <div class="col px-1 mb-1 text-end">
                    <button type="submit" class="w-100 border-0 py-2 shadow-sm">Login</button>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    Belum punya Akun? <a href="<?= PC::BASE_URL ?>Register">Register</a>
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
                if (res == 1) {
                    window.location.href = "<?= PC::BASE_URL ?>Home";
                } else {
                    alert(res);
                }
            },
        });
    });
</script>