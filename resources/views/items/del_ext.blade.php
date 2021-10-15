@extends('layout.app')
@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-6 mx-auto">--}}
{{--            <?php--}}
{{--            if(isset($_GET['success'])){--}}
{{--            ?>--}}
{{--            <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                Регистрация прошла успешно!--}}
{{--                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <?php--}}
{{--            }--}}
{{--            ?>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row mt-4 justify-content-center" style="min-height: 400px">
        @if($item)
            <div class="col-lg-3 mx-auto">
                <button class="btn btn-danger" style="padding: 80px 55px 80px 55px; margin-bottom: 10px" data-toggle="modal" data-target="#deleteModal2">
                    Удалить объявление
                </button>
            </div>

            <div class="col-lg-3 mx-auto">
                <form action="{{route('prolong_10days')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                    <input type="hidden" class="form-control" name="srok" value="{{date('Y-m-d H:i:s', time()+(60*1))}}">

                    <button class="btn btn-outline-primary" style="padding: 80px 30px 80px 30px; margin-bottom: 10px">
                        Продлить на 10 дней - 100тг.
                    </button>
                </form>
            </div>

            <div class="col-lg-3 mx-auto">
                <form action="{{route('prolong_20days')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                    <input type="hidden" class="form-control" name="srok" value="{{date('Y-m-d H:i:s', time()+(60*2))}}">

                    <button class="btn btn-outline-primary" style="padding: 80px 30px 80px 30px; margin-bottom: 10px">
                        Продлить на 20 дней - 150тг.
                    </button>
                </form>
            </div>

            <div class="col-lg-3 mx-auto">
                <form action="{{route('prolong_30days')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                    <input type="hidden" class="form-control" name="srok" value="{{date('Y-m-d H:i:s', time()+(60*3))}}">

                    <button class="btn btn-outline-primary" style="padding: 80px 30px 80px 30px; margin-bottom: 10px">
                        Продлить на 30 дней - 250тг.
                    </button>
                </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="deleteModal2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{route('todeleteItem2')}}" method="post">
                        @csrf
                        {{method_field('delete')}}
                        <input type="hidden" name="item_id" value="{{$item->id}}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Удаление объявления</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Вы хотите удалить?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                                <button class="btn btn-primary">Удалить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <h4 class="mt-5">Нет объявлений</h4>
        @endif
    </div>
@endsection

