<form action="<?= PC::BASE_URL . $con ?>/login" method="POST">
    <div class="w-100" style="background-image: url('<?= PC::ASSETS_URL ?>img/bg/login.jpg'); background-size: auto 100%; height: 100vh; position:absolute"></div>

    <div style="position: sticky;top: 0;z-index: 3;height: 100vh; max-width:400px" class="col">
        <div class="bg-warning bg-gradient pt-5 px-5" style="height: 100%;">
            <div class="w-100 mb-5 text-center">
                <a href="<?= PC::BASE_URL ?>">
                    <h2 class="fw-bold text-white mb-0"><?= PC::APP_NAME ?></h2>
                </a>
                <span class="text-white">Welcome to our App</span>
            </div>
            <div class="row">
                <div class="col px-1 mb-3" style="min-width: 200px;">
                    <label class="text-white mb-1 ms-1"><small>Nomor HP (08..)</small></label>
                    <input type="text" class="form-control py-2 shadow-none rounded-3" name="hp" required>
                </div>
                <div class="col px-1 mb-1" style="min-width: 200px;">
                    <label class="text-white mb-1 ms-1"><small>Password</small></label>
                    <div class="input-group">
                        <input id="pwd" type="password" class="form-control py-2 shadow-none rounded-start-3" name="pw" required>
                        <span class="input-group-text bg-white" id="eye"><i class="bi bi-eye-slash float-end" id="togglePassword"></i></span>
                    </div>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col text-end">
                    <small><a class="fw-bold" href="<?= PC::BASE_URL ?>Lupa_Password">Lupa Password?</a></small>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-white">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Remember me
                        </label>
                    </div>
                </div>
            </div>
            <div class="row pt-2 mb-3">
                <div class="col px-1 mb-1 text-end">
                    <button type="submit" class="btn btn-sm w-100 py-2 shadow btn-primary px-5 bg-gradient rounded-3">Login</button>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                    Belum punya Akun? <a class="btn btn-sm ms-2 btn-danger bg-gradient rounded-pill" href="<?= PC::BASE_URL ?>Register">Register</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function show() {
        var p = document.getElementById('pwd');
        p.setAttribute('type', 'text');
    }

    function hide() {
        var p = document.getElementById('pwd');
        p.setAttribute('type', 'password');
    }

    var pwShown = 0;

    document.getElementById("eye").addEventListener("click", function() {
        if (pwShown == 0) {
            pwShown = 1;
            show();
        } else {
            pwShown = 0;
            hide();
        }
    }, false);

    $(document).ready(function() {
        $('#btn_menu').addClass('d-none');
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