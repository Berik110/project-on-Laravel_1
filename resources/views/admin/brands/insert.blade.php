<!-- Modal -->
<div class="modal fade" id="addBrand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.brandInsert')}}" method="post">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создать Брэнд</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Наименование брэнда</label>
                        <input type="text" class="form-control" name="name">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button class="btn btn-primary">Добавить</button>
            </div>
            </form>
        </div>
    </div>
</div>
