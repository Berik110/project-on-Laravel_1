@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white">
                    <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$category?$category->name:''}}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="row justify-content-center" style="min-height: 600px">
{{--        {{ $getParams['region_id']}}  {{$getParams['city_id']}}--}}

        <div class="col-md-3 pt-3" style="background-color: #ededed; border-radius: 5px; max-height: 450px"> <!-- Было до этого max-height: 500px -->
            <form method="get" action="{{route('search')}}">
                @csrf
                <div class="form-group">
                    <select class="form-control" name="region_id" id="region">
                        <option value="0">Выбрать Область</option>
                        @foreach($regions as $region)
                            <option value="{{$region->id}}" @if(isset($getParams['region_id']) && $getParams['region_id'] == $region->id) selected="selected" @endif>
                                {{$region->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="city_id" id="city">
                        <option value="0">Выбрать город</option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="category_id">
                        <option value="0">Выбрать категорию</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if(isset($getParams['category_id']) && $getParams['category_id'] == $category->id) selected="selected" @endif >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="brand_id">
                        <option value="0">Выбрать брэнд</option>
                        @foreach($brands as $brand)
{{--                            <option value="{{$brand->id}}" {{(old('brand_id')==$brand->id)?'selected':''}}>{{$brand->name}}</option>--}}
                            <option value="{{$brand->id}}" @if(isset($getParams['brand_id']) && $getParams['brand_id'] == $brand->id) selected="selected" @endif >{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="option_id">
                        <option value="0">Выбрать опцию</option>
{{--                            от Кемаля правильный тоже--}}
{{--                        <option value="1" @if(isset($getParams['option']) && $getParams['option'] == 1) selected="selected" @endif >Аренда</option>--}}
{{--                        <option value="2" @if(isset($getParams['option']) && $getParams['option'] == 2) selected="selected" @endif >Продажа</option>--}}
{{--                        <option value="3" @if(isset($getParams['option']) && $getParams['option'] == 3) selected="selected" @endif >Сервис / Услуги</option>--}}

                        @foreach($options as $option)
                            <option value="{{$option->id}}" @if(isset($getParams['option_id']) && $getParams['option_id'] == $option->id) selected="selected" @endif>
                                {{$option->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" placeholder="Цена от" class="form-control" name="priceFrom"
                           value="<?php if (isset($_GET['priceFrom'])) { echo $_GET['priceFrom']; } ?>">
                </div>
                <div class="form-group">
                    <input type="number" placeholder="Цена до" class="form-control" name="priceTill"
                           value="<?php if (isset($_GET['priceTill'])) { echo $_GET['priceTill']; } ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block">Найти</button>
                </div>
            </form>
        </div>

    {{--основной контент--}}
        <div class="col-md-9">
            <div class="row justify-content-center">

                @if(count($items)==0)
                    <h3 class="mt-5 text-center">Пока данных нет</h3>
                @else
                @foreach($items as $item)
                    <div class="card bg-light mr-3 mb-3" style="width: 16rem;">
                        <a href="{{route('details', ['item_id'=>$item->id])}}" style="text-decoration: none; color: black; font-size: 1rem;">
                        {{-- <img src="{{$item->images->first()['url']}}" class="card-img-top" alt="...">--}}
                            <div class="img-container">
                                @if($item->images->first()['url']!=null)
                                    <img src="{{asset('storage/'.$item->images->first()['url'])}}" class="card-img-top" alt="...">
                                @else
                                    <img src="{{asset('/images/noImg.png')}}" class="card-img-top" alt="...">
                                @endif
                            </div>
                            <style>
                                .img-container{
                                    width: auto;
                                    height: 170px;
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
                                {{-- @foreach($item->images as $img)--}}
                                {{--    <img src="{{asset('storage/'.$img)}}" class="card-img-top" alt="...">--}}
                                {{-- @endforeach--}}
                            <div class="card-body">
                                <p class="card-text text-center font-weight-bold" style="font-size: 0.85rem">{{$item->brand->name}} - {{$item->name}}
                                    @auth
                                        @if($item->user_id==$user->id)
                                            <span class="text-danger"><i class="fas fa-flag"></i></span>
                                        @endif
                                    @endauth
                                </p>
                                <p class="card-text text-center" style="font-size: 0.85rem">
{{--                                    1 вариант--}}
{{--                                    {{(($item->option==1)?"Аренда":"Продажа")}}, {{number_format($item->price,0,'.','.')}} тг.--}}
{{--                                    2 вариант--}}
                                    @switch($item->option_id)
                                        @case(1)
                                        Аренда, {{number_format($item->price,0,'.','.')}} тг. <span style="background-color: dodgerblue; color: white">{{ $item->city->name }}</span>
                                        @break

                                        @case(2)
                                        Продажа, {{number_format($item->price,0,'.','.')}} тг. <span style="background-color: dodgerblue; color: white">{{ $item->city->name }}</span>
                                        @break

                                        @case(3)
                                        Сервис/Услуги, {{number_format($item->price,0,'.','.')}}тг. <span style="background-color: dodgerblue; color: white">{{ $item->city->name }}</span>
                                        @break

                                        @default
                                        ----------------
{{--                                        Запасные части, {{number_format($item->price,0,'.','.')}} тг. <span style="background-color: darkseagreen">{{ $item->city->name }}</span>--}}
                                    @endswitch
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="mx-auto">
{{--                {{$items->appends(['category_id'=>request()->category_id])->links()}}--}}
{{--        используем этот вариант ->   {{$items->appends(['category_id'=>request()->category_id, 'brand_id'=>request()->brand_id, 'option'=>request()->option, 'priceFrom'=>request()->priceFrom, 'priceTill'=>request()->priceTill])->links()}}--}}
{{--                {{$items->links()}}--}}
            </div>
        </div>
    </div>
@endsection
{{--@section('custom.js')--}}
{{--    --}}{{--    <script src="{{asset('jquery-3.5.1.min.js')}}"></script>--}}
{{--    <script type="text/javascript">--}}
{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}
{{--        $(document).ready(function (){--}}
{{--            // $('select[id="region"]').on('change', getCitiesForRegion());--}}
{{--            document.querySelector('#region').addEventListener('change', {handleEvent(event){--}}
{{--                getCitiesForRegion(event.currentTarget.value);--}}
{{--            }});--}}
{{--            if ({{isset($getParams['city_id'])}}) {--}}
{{--                getCitiesForRegion({{isset($getParams['region_id'])}} ? {{$getParams['region_id']}} : 0);--}}
{{--                // getCitiesForRegion(typeof ($getParams['region_id']) && $getParams['region_id']!==null ? $getParams['region_id'] : 0);--}}
{{--            }--}}
{{--        });--}}

{{--        function getCitiesForRegion(region_id){--}}
{{--            // var city_id = (typeof ($getParams['city_id'])!="undefined" && $getParams['city_id']!==null) ? $getParams['city_id'] : 0;--}}
{{--            var city_id = {{isset($getParams['city_id'])}} ? {{$getParams['city_id']}} : 0;--}}
{{--            if (region_id >= 0){--}}
{{--                $.ajax({--}}
{{--                    url: '/reg/'+region_id,--}}
{{--                    type: 'GET',--}}
{{--                    dataType: 'json',--}}
{{--                    success: function (data) {--}}

{{--                        $('select[name="city_id"]').empty();--}}
{{--                        $.each(data, function (key, value){--}}
{{--                            var sel = '';--}}
{{--                            if (city_id == key){--}}
{{--                                sel = "selected='selected'"--}}
{{--                            };--}}

{{--                            $('select[name="city_id"]').append(`<option value="${key}" ${sel}>${value}</option>`);--}}
{{--                        })--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                $('select[name="city_id"]').empty();--}}
{{--            }--}}
{{--        };--}}
{{--    </script>--}}
{{--@endsection--}}

@section('custom.js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function (){
            $('select[id="region"]').on('change', function (){
                var region_id = $(this).val();

                if (region_id){
                    $.ajax({
                        url: '/reg/'+region_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);

                            $('select[name="city_id"]').empty();
                            $.each(data, function (key, value){
                                $('select[name="city_id"]').append('<option value="'+key+'">' + value + '</option>');
                            })
                        }
                    });
                } else {
                    $('select[name="city_id"]').empty();
                }
            });
        });
    </script>
@endsection

