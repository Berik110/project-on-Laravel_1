@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-6 mx-auto">
            <?php
            if(isset($_GET['success'])){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Продление прошла успешно!
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

            @if(count($items)>0)
                <p class="font-weight-bold mt-3">Ваши объявления:</p>
                @foreach($items as $item)
                    @if($item->user_id==$user->id)
                        <p class="text-muted" style="font-size: 0.85rem">Объявление действует до {{$item->srok}}</p>
                        <div class="card bg-light" style="width: 10rem;">
                            <div class="img-container">
                                @if($item->images->first()['url']!=null)
                                    <img src="{{asset('storage/'.$item->images->first()['url'])}}" style="height: 6rem; background-size: cover" class="card-img-top" alt="...">
                                @else
                                    <img src="{{asset('/images/noImg.png')}}" style="height: 6rem; background-size: cover" class="card-img-top" alt="...">
                                @endif
                            </div>
                            <style>
                                .img-container{
                                    width: auto;
                                    height: 90px;
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
                        <a href="{{route('details', ['item_id'=>$item->id])}}">{{$item->category->name}}/{{$item->brand->name}} {{$item->name}}, Цена: {{number_format($item->price,0,'.','.')}} тг.</a>
                        <br/>
                        {{$item->description}}
                        <br/>
                        <hr/>
                    @endif
                @endforeach

{{--                <p class="font-weight-bold mt-3">Ваши объявления:</p>--}}
{{--                @foreach($items as $item)--}}
{{--                    @if($item->user_id==$user->id)--}}
{{--                        <a href="{{route('details', ['item_id'=>$item->id])}}">{{$item->category->name}}/{{$item->brand->name}} {{$item->name}}, Цена: {{number_format($item->price,0,'.','.')}} тг.</a>--}}
{{--                        <p>{{$item->description}}</p>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
            @else
                <h4 class="mt-5">У вас пока нет объявлений на сайте</h4>
                <p>Это легко исправить, <a href="{{route('adv')}}" style="font-weight: bold">подав их.</a></p>
            @endif
        </div>

    </div>

@endsection
