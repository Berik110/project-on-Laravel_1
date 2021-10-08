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
{{--            <h4 class="text-center">Личный кабинет {{$user->name}}</h4>--}}
            @if(count($items)>0)
            <p class="font-weight-bold mt-3">ваши объявления:</p>
            @foreach($items as $item)
                @if($item->user_id==$user->id)
                    <a href="{{route('details', ['item_id'=>$item->id])}}">{{$item->category->name}}/{{$item->brand->name}} {{$item->name}}, Цена: {{number_format($item->price,0,'.','.')}} тг.</a>
                    <p>{{$item->description}}</p>
                @endif
            @endforeach
            @else
                <h4 class="mt-5">У вас пока нет объявлений на сайте</h4>
                <p>Это легко исправить, <a href="{{route('adv')}}" style="font-weight: bold">подав их.</a></p>
            @endif
        </div>

    </div>

@endsection
