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
{{--            1 вариант через форму--}}
{{--            <div class="col-lg-3 mx-auto">--}}
{{--                <button class="btn btn-danger" style="padding: 80px 64px 80px 64px; margin-bottom: 10px" data-toggle="modal" data-target="#deleteModal2">--}}
{{--                    Удалить объявление--}}
{{--                </button>--}}
{{--            </div>--}}

{{--            <div class="col-lg-3 mx-auto">--}}
{{--                <form action="{{route('prolong_10days')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    {{method_field('put')}}--}}
{{--                    <input type="hidden" name="item_id" value="{{$item->id}}">--}}
{{--                    <input type="hidden" class="form-control" name="srok" value="10">--}}

{{--                    <button class="btn btn-outline-primary" style="padding: 80px 30px 80px 30px; margin-bottom: 10px">--}}
{{--                        Продлить на 10 дней - 150 ед.--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <div class="col-lg-3 mx-auto">--}}
{{--                <form action="{{route('prolong_20days')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    {{method_field('put')}}--}}
{{--                    <input type="hidden" name="item_id" value="{{$item->id}}">--}}
{{--                    <input type="hidden" class="form-control" name="srok" value="20">--}}

{{--                    <button class="btn btn-outline-primary" style="padding: 80px 30px 80px 30px; margin-bottom: 10px">--}}
{{--                        Продлить на 20 дней - 250 ед.--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <div class="col-lg-3 mx-auto">--}}
{{--                <form action="{{route('prolong_30days')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    {{method_field('put')}}--}}
{{--                    <input type="hidden" name="item_id" value="{{$item->id}}">--}}
{{--                    <input type="hidden" class="form-control" name="srok" value="30">--}}

{{--                    <button class="btn btn-outline-primary" style="padding: 80px 30px 80px 30px; margin-bottom: 10px">--}}
{{--                        Продлить на 30 дней - 400 ед.--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            2 вариант через тег <а></а>--}}
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <a href="#" data-toggle="modal" data-target="#deleteModal2" class="btn btn-danger btn-block" style="text-align: center; padding: 90px; margin-bottom: 10px;">
                    Удалить объявление
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <a href="{{ route('prolong_10days', ['item_id'=>$item->id, 'srok'=>10]) }}" class="btn btn-outline-primary btn-block" style="text-align: center; padding: 90px 60px 90px 60px; margin-bottom: 10px;">
                    Продлить на 10 дней
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <a href="{{ route('prolong_10days', ['item_id'=>$item->id, 'srok'=>20]) }}" class="btn btn-outline-primary btn-block" style="text-align: center; padding: 90px 60px 90px 60px; margin-bottom: 10px;">
                    Продлить на 20 дней
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <a href="{{ route('prolong_10days', ['item_id'=>$item->id, 'srok'=>30]) }}" class="btn btn-outline-primary btn-block" style="text-align: center; padding: 90px 60px 90px 60px; margin-bottom: 10px;">
                    Продлить на 30 дней
                </a>
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

