@extends('layout.app')
@section('content')
    @if($item!=null)
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" style="background-color: white">
                    <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('categories', ['category_id'=>$item->category_id])}}">{{$item->category->name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                            Детали - {{$item->brand->name}} {{$item->name}}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div style="min-height: 350px">
    <div class="row mt-1 justify-content-center">

{{--            <div class="card bg-light mr-3 mb-3" style="width: 16rem;">--}}
{{--                    <img src="https://acropolis-wp-content-uploads.s3.us-west-1.amazonaws.com/2018/06/carry-deck-crane-IC_100.jpg" class="card-img-top" alt="...">--}}
{{--                    <div class="card-body">--}}
{{--                        <p class="card-text text-center font-weight-bold">{{$item->brand->name}} - {{$item->name}}</p>--}}
{{--                        <p class="card-text text-center">{{(($item->option==1)?"Аренда":"Продажа")}}, цена {{$item->price}}</p>--}}
{{--                    </div>--}}
{{--            </div>--}}

        <div class="card mb-3 shadow" style="width: 80%;">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="card-body" >
                        <p style="font-size: 1.4rem" class="card-title">{{$item->brand->name}} - {{$item->name}}, {{$item->year}} года</p>
                        <p style="color: darkorange" class="card-text font-weight-bold">{{number_format($item->price,0,'.','.')}} тг.
                            @if($item->option_id==3)
                                Сервис/Услуга
                            @elseif($item->option_id==1)/ Аренда,
                                @switch($item->rental->id)
                                    @case(1)
                                    часовая ставка
                                    @break

                                    @case(2)
                                    дневная ставка
                                    @break

                                    @case(3)
                                    месячная ставка
                                    @break

                                    @default
                                    --------
                                @endswitch
                            @endif
                        </p>
                        <p style="font-size: 0.9rem" class="card-text"><span class="text-muted">Описание..............</span> {{$item->description}}</p>
                        <p style="font-size: 0.87rem" class="card-text"><span class="text-muted">Регион.....................</span> {{$item->city->region->name}}, {{$item->city->name}}</p>
                        <p style="font-size: 0.87rem" class="card-text"><span class="text-muted">Телефон.................</span> {{$item->itemByUser->phone_number}}</p>
                        <p style="font-size: 0.87rem" class="card-text"><span class="text-muted">Эл.почта.................</span> {{$item->itemByUser->email}}</p>
                        <p class="card-text"><small class="text-muted">Дата публикации: {{$item->created_at}}</small></p>
                        <hr/>
                        <p class="card-text"><small>Объявление посмотрели <b>7799</b> раз с 12 октября</small></p>
                    @auth
                            @if(\Illuminate\Support\Facades\Auth::user()->id==$item->user_id)
                                <a href="{{route('change', ['id'=>$item->id, 'city_id'=>$item->city->id])}}" class="btn btn-primary">Редактировать</a>
                            @endif
                        @endauth
                    </div>
                </div>

                <div class="col-md-5 my-auto">
                    {{-- <img src="{{$item->images->first()['url']}}" width="100%" style="margin-left: 10px">--}}

                    @if($item->images->first()['url']!=null)
                        <img src="{{asset('storage/'.$item->images->first()['url'])}}" width="100%" style="margin-left: 10px">
                    @else
                        <img src="{{asset('/images/noImg.png')}}" width="100%" style="margin-left: 10px">
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    @else
        <h3 class="display-4 text-center" style="margin-top: 100px">404 page not found</h3>
    @endif
@endsection

