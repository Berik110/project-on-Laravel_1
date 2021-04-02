@extends('layout.app')
@section('content')

    <div class="row mt-4 justify-content-center" style="min-height: 400px">
        <div class="col-md-9 mx-auto">
            <h3 class="text-center">Личный кабинет {{$user->name}}</h3>
            <p class="font-weight-bold mt-3">ваши объявления:</p>
            @foreach($items as $item)
                @if($item->user_id==$user->id)
                    <a href="#">{{$item->category->name}}/{{$item->brand->name}} {{$item->name}}</a> <p>{{$item->description}}</p> <br/>
                @endif
            @endforeach
        </div>

    </div>

@endsection
