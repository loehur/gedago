<style>
    .dropdown-menu {
        min-width: 100px !important;
    }

    .dropdown-item {
        padding: 0px 5px !important;
        font-size: 12px !important;
    }
</style>
<div class="container .bg-transparent pt-3">
    <div class="row">
        <div class="col ps-4">
            <a href="<?= PC::BASE_URL ?>Home">
                <h5 class="text-white pb-0 mb-0">Hi, <?= PC::APP_NAME ?></h5>
            </a>
        </div>
        <div class="col px-1 text-end">
            <a href="<?= PC::BASE_URL ?>Login" class="btn btn-sm rounded-pill px-3 bg-white shadow-sm border-bottom">
                <i class="bi bi-person"></i> Sign In
            </a>
        </div>
    </div>
</div>

<div class="container">
    <hr>
    <section class="w-100">
        <div class="row">
            <div class="col pt-5 bg-transparent rounded text-white" style="min-width:300px">
                <h5><?= PC::APP_NAME ?></h5>
                <h1>The potential to increase the value of your investment over time</h1>
                <a href="<?= PC::BASE_URL ?>Register">
                    <span class="btn py-2 px-3 text-white rounded-pill float-end bg-primary bg-gradient">
                        Register Now
                    </span>
                </a>
            </div>
            <div class="col p-0 bg-transparent text-white" style="min-width: 300px;">
                <img style="opacity: 0.8;" src="<?= PC::ASSETS_URL ?>img/banner/cart.png" alt="Trulli" class="img-fluid">
            </div>
        </div>
    </section>
</div>