<link rel="stylesheet" href="<?= PC::ASSETS_URL ?>plugins/datatable_bs5/dataTables.dataTables.css" />
<div class="container-fluid border-0">
    <div class="container">
        <div style="max-width: 500px;" class="m-auto px-1">
            <div class="row">
                <div class="col m-1 border rounded bg-white p-3" style="min-width: 300px;">
                    <div class="row">
                        <div class="col">
                            <strong class="text-primary">Video List</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col"><small>Video ID terletak pada link youtube video, ambil hanya pada variable v.<br>Contoh: v=<b class="text-danger">vYknxhdjjfhk</b>&keoycadjf</small></div>
                    </div>
                    <form action="<?= PC::BASE_URL_ADMIN . $con ?>/add" method="POST">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td>
                                    <input type="text" name="video_id" required placeholder="video_id" class="form-control form-control-sm shadow-none border-0 border-bottom">
                                </td>
                                <td>
                                    <input type="text" name="comment" placeholder="comment (optional)" class="form-control form-control-sm shadow-none border-0 border-bottom">
                                </td>
                                <td style="width: 50px;">
                                    <button type="submit" name="submit" id="submit" class="btn btn-sm shadow-none btn-success">Add</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <table class="table table-sm" id="dt_table">
                        <thead class="d-none">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $d) { ?>
                                <tr>
                                    <td><small><?= $d['yt'] ?></small></td>
                                    <td><small><?= $d['comment'] ?></small></td>
                                    <td class="text-end">
                                        <button type="button" data-bs-toggle="modal" onclick="cekVid('<?= $d['yt'] ?>')" data-bs-target="#staticBackdrop" class="btn btnCek btn-sm shadow-none btn-outline-info border-0"><i class="bi bi-search"></i></button>
                                        <button type="button" data-id="<?= $d['video_id'] ?>" class="btn vid_del btn-sm shadow-none btn-outline-secondary border-0"><i class="bi bi-trash3"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" id="video_content"></div>
    </div>
</div>


<script src="<?= PC::ASSETS_URL ?>plugins/datatable_bs5/dataTables.js"></script>
<script>
    $(document).ready(function() {
        new DataTable('#dt_table', {
            lengthChange: false,
            searching: false,
            ordering: false
        });
        spinner(0);
    });

    function cekVid(id) {
        $("div#video_content").load("<?= PC::BASE_URL_ADMIN . $con ?>/load_video/" + id);
    }

    $("form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(res) {
                if (res == 0) {
                    content();
                } else {
                    alert(res)
                }
            }
        });
    });

    $(".vid_del").click(function() {
        $.post("<?= PC::BASE_URL_ADMIN . $con ?>/delete", {
            id: $(this).attr("data-id")
        }, function(res) {
            if (res == 0) {
                content();
            } else {
                alert(res)
            }
        });
    })
</script>