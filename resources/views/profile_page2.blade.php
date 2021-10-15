@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-6 mx-auto">
            <?php
            if(isset($_GET['success'])){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Регистрация прошла успешно!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="row mt-4 justify-content-center" style="min-height: 400px">
        <div class="col-md-9 mx-auto">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a class="btn btn-light {{request()->route()->named('profile') ? 'active' : ''}}" href="{{route('profile')}}">На сайте {{count($items)}}</a>
                <a class="btn btn-light {{request()->route()->named('profile2') ? 'active' : ''}}" href="{{route('profile2')}}">В архиве {{count($itemsArchives)}}</a>
            </div>

            @if(count($itemsArchives)>0)
                <p class="font-weight-bold mt-3">В архиве:</p>
                    @foreach($itemsArchives as $ar)
                        @if($ar->user_id==$user->id)
                            <div class="card bg-light" style="width: 10rem;">
                                <div class="img-container">
                                    @if($ar->images->first()['url']!=null)
                                        <img src="{{asset('storage/'.$ar->images->first()['url'])}}" style="background-size: cover" class="card-img-top" alt="...">
                                    @else
                                        <img src="{{asset('/images/noImg.png')}}" style="background-size: cover" class="card-img-top" alt="...">
                                    @endif
                                </div>
                                <style>
                                    .img-container{
                                        width: auto;
                                        height: 100px;
                                        background-color: #58e8ff;
                                    }
                                    .img-container img {
                                        max-width: 100%;
                                        width: 100%;
                                        height: inherit;
                                        max-height: 100%;
                                        object-fit: cover;
                                        display: block;
                                    }
                                </style>
                            </div>
{{--                            <a href="{{route('details', ['item_id'=>$ar->id])}}" class="text-muted">{{$ar->category->name}}/{{$ar->brand->name}} {{$ar->name}}, Цена: {{number_format($ar->price,0,'.','.')}} тг.</a>--}}
                            <a href="#" class="text-muted">{{$ar->category->name}}/{{$ar->brand->name}} {{$ar->name}}, Цена: {{number_format($ar->price,0,'.','.')}} тг.</a>
                            <br/>
                                {{$ar->description}}
                        <br/><br/>
                        <a href="{{ route('delExt', ['item_id'=>$ar->id]) }}">Удаление или Продление объявления</a>
{{--                        <form action="{{route('todeleteItem2')}}" method="post">--}}
{{--                            @csrf--}}
{{--                            {{method_field('delete')}}--}}
{{--                            <input type="hidden" name="item_id" value="{{$ar->id}}">--}}
{{--                            <button class="btn btn-danger btn-sm mb-1">--}}
{{--                                Удалить объявление--}}
{{--                            </button>--}}
{{--                            <button type="button" class="btn btn-success btn-sm mb-1" data-toggle="modal" data-target="#deleteModal2">--}}
{{--                                Продлить объявление--}}
{{--                            </button>--}}
{{--                        </form>--}}
                        <hr/>
                    @endif
                @endforeach

            <!-- Modal -->
                <div class="modal fade" id="deleteModal2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{route('todeleteItem2')}}" method="post">
                            @csrf
                            {{method_field('delete')}}
                            <input type="hidden" name="item_id" value="{{$ar->id}}">
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
                <h4 class="mt-5">Нет объявления в архиве.</h4>
            @endif
        </div>
    </div>
@endsection

