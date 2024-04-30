<?php if (!isset($_SESSION['log_admin'])) { ?>
    <div class="container">
        <section class="py-1">
            <div class="row">
                <div class="col" style="min-width: 200px;">
                    <h4 class="fw-bold">Admin Panel</h4>
                    <p align="justify">
                        All Admin Operation Here
                    </p>
                </div>
            </div>
        </section>
    </div>
<?php } else { ?>
    <div class="container-fluid border-0">
        <div class="container">
            <section>
                <div class="row">
                    <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                        <div class="row">
                            <div class="col">
                                <small>Admin Logged in</small><br>
                                <span class="text-primary"><?= $_SESSION['log_admin']['nama'] ?></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">

                                <small>Privileges</small><br>

                                <span class="text-danger">
                                    <?php foreach (PC::ACCESS as $key => $acc) {
                                        if (in_array($key, $_SESSION['log_admin']['access']) == true) {
                                            echo $acc . ", ";
                                        }
                                    } ?>
                                </span>
                            </div>
                        </div>
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