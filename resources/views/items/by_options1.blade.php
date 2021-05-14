@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" style="background-color: white">
                    <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Аренда</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mt-1 justify-content-center" style="min-height: 600px">
        <div class="col-md-3 pt-3" style="background-color: #ededed; border-radius: 5px; max-height: 450px"> <!-- Было до этого max-height: 500px -->
            <form method="get" action="{{route('search')}}">
                @csrf
                <div class="form-group">
                    <select class="form-control" name="region_id" id="region">
                        <option value="0">Выбрать Область</option>
                        @foreach($regions as $region)
                            <option value="{{$region->id}}">
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
{{--                    <label>Выбрать категорию:</label>--}}
                    <select class="form-control" name="category_id">
{{--                        <option value="0">----------------------------</option>--}}
                        <option value="0">Выбрать категорию</option>--}}
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
{{--                    <label>Выбрать брэнд:</label>--}}
                    <select class="form-control" name="brand_id">
{{--                        <option value="0">----------------------------</option>--}}
                        <option value="0">Выбрать брэнд</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{(old('brand_id')==$brand->id)?'selected':''}}>{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
{{--                    <label>Выбрать опцию:</label>--}}
                    <select class="form-control" name="option">
{{--                        <option value="0">----------------------------</option>--}}
                        <option value="0">Выбрать опцию</option>
                        <option value="1">Аренда</option>
                        <option value="2">Продажа</option>
                    </select>
                </div>
                <div class="form-group">
{{--                    <label>Цена от:</label>--}}
                    <input type="number" placeholder="Цена от" class="form-control" name="priceFrom"
                           value="<?php if (isset($_GET['priceFrom'])) { echo $_GET['priceFrom']; } ?>">
                </div>
                <div class="form-group">
{{--                    <label>Цена до:</label>--}}
                    <input type="number" placeholder="Цена до" class="form-control" name="priceTill"
                           value="<?php if (isset($_GET['priceTill'])) { echo $_GET['priceTill']; } ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block">Найти</button>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <div class="row justify-content-center">
                @foreach($items as $item)
                    <div class="card bg-light mr-3 mb-3" style="width: 16rem;">
                        <a href="{{route('details', ['item_id'=>$item->id])}}" style="text-decoration: none; color: black; font-size: 1rem;">
                            <img src="{{$item->images->first()['url']}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text text-center font-weight-bold">{{$item->brand->name}} - {{$item->name}}</p>
                                <p class="card-text text-center">{{(($item->option==1)?"Аренда":"Продажа")}}, цена {{number_format($item->price,0,'.','.')}} тг.</p>
                            </div>
                        </a>
                    </div>
                @endforeach
{{--                <div class="col-md-6">--}}
{{--                    {{$items->links()}}--}}
{{--                    {{$items->appends(['rental'=>request()->rental])->links()}}--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="mx-auto">
{{--                {{$items->links()}}--}}
            </div>
        </div>
    </div>
@endsection
@section('custom.js')
    {{--    <script src="{{asset('jquery-3.5.1.min.js')}}"></script>--}}
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
