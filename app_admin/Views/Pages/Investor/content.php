<link rel="stylesheet" href="<?= PC::ASSETS_URL ?>plugins/datatable_bs5/dataTables.bootstrap5.css" />

<div class="container">
    <div style="max-width: 500px;" class="m-auto px-1">
        <h6><strong class="">Investor Data</strong></h6>
        <div class="row">
            <div class="col border rounded bg-white p-2" style="min-width: 300px;">
                <table class="table m-0" id="dt_table">
                    <thead class="d-none">
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $d) { ?>
                            <tr>
                                <td><small><?= strtoupper($d['nama']) ?><br><?= $d['hp'] ?> <button class="btn p-0 shadow-none" data-clipboard-text="<?= $d['hp'] ?>"><i class="bi bi-clipboard"></i></button></small></td>
                                <td class="text-end"><small><?= substr($d['registered'], 0, 10)  ?></small><br><small><?= $d['tgl_lahir'] ?></small></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?= PC::ASSETS_URL ?>plugins/datatable_bs5/dataTables.js"></script>
<script src="<?= PC::ASSETS_URL ?>plugins/datatable_bs5/dataTables.bootstrap5.js"></script>

<script src="<?= PC::ASSETS_URL ?>plugins/clipboard/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.btn');
    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });
    $(document).ready(function() {
        new DataTable('#dt_table', {
            lengthChange: false,
            ordering: false,
            pagingType: "simple",
            pageLength: 5
        });
        $("input").addClass("shadow-none");
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