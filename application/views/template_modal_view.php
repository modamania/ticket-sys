<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                <h4 class="modal-title" id="modalLabel"><?=$data['title']?></h4>
            </div>
            <div class="modal-body">
                <?php include 'application/views/'.$content_view; ?>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-modal-confirm" class="btn btn-primary">Продать</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>