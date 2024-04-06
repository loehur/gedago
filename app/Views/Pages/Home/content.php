<?php if (!isset($_SESSION['log'])) { ?>
    <div class="container-fluid border-0">
        <div class="container">
            <section class="py-1">
                <div class="row">
                    <div class="col-md-4 pt-2">
                        <h4 class="fw-bold">Digital Intelligence Service Center</h4>
                        <p>
                            More than 3,000 Fortune 500 and emerging high-growth brands
                            Using ST to bring consumers the ultimate service experience
                        </p>
                    </div>
                    <div class="col">
                        <img src="<?= PC::ASSETS_URL ?>img/banner/banner_en.png" class="img-fluid" alt="">
                    </div>
                </div>
            </section>

            <section class="py-1">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/kBlcWM3SWjE?si=y0Qdj0mHS6hMHXOS&controls=0&start=1&autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </section>

            <section class="py-3">
                <div class="row px-2">
                    <div class="col rounded text-center shadow-sm px-1 mx-1 my-2" style="min-width: 200px;">
                        <h5 class="fw-bold">Level</h5>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia facilis, sapiente architecto quae tempora error est aut consectetur assumenda minima atque itaque neque ut ea perferendis fugit, temporibus illum optio?</p>
                    </div>
                    <div class="col rounded text-center shadow-sm px-1 mx-1 my-2" style="min-width: 200px;">
                        <h5 class="fw-bold">Level</h5>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia facilis, sapiente architecto quae tempora error est aut consectetur assumenda minima atque itaque neque ut ea perferendis fugit, temporibus illum optio?</p>
                    </div>
                    <div class="col rounded text-center shadow-sm px-1 mx-1 my-2" style="min-width: 200px;">
                        <h5 class="fw-bold">Level</h5>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia facilis, sapiente architecto quae tempora error est aut consectetur assumenda minima atque itaque neque ut ea perferendis fugit, temporibus illum optio?</p>
                    </div>

                </div>
            </section>
        </div>

    </div>
<?php } else { ?>
    <div class="container-fluid border-0">
        <div class="container">
            <section>
                <div class="row">
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <div class="row">
                            <div class="col">
                                <i class="bi bi-wallet"></i> Main Wallet <br>
                                <button class="btn shadow-none ps-0">
                                    <h5 class="fw-bold">Rp99.665</h5>
                                </button>
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="col-auto p-1">
                                <button class="btn btn-sm btn-success">Topup</button>
                            </div>
                            <div class="col-auto p-1">
                                <button class="btn btn-sm btn-warning">Withdraw</button>
                            </div>
                            <div class="col-auto p-1">
                                <button class="btn btn-sm btn-info">History</button>
                            </div>
                        </div>
                    </div>
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        Active Investment <br>
                        <h5>Level <i class="bi bi-3-circle-fill text-primary"></i></h5>
                    </div>
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <i class="bi bi-list-task text-warning"></i> Daily Task (7/10)<br>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <i class="bi bi-calendar-check text-info"></i></i> Daily Check-in <br>
                        <h6><i class="fa-regular fa-circle-check text-info"></i> <?= date("d-m-Y H:i:s") ?></h6>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {
        spinner(0);
    });
</script>