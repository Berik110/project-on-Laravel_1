@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-md-12 mt-3">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" style="background-color: white">
                    <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Аренда</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row mt-2 justify-content-center" style="min-height: 600px">
        <div class="col-md-3 pt-3" style="background-color: #ededed; border-radius: 5px; max-height: 500px">
            <form method="get" action="{{route('search')}}">
                @csrf
                <div class="form-group">
                    <label>Выбрать категорию:</label>
                    <select class="form-control" name="category_id">
                        <option value="0">----------------------------</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Выбрать брэнд:</label>
                    <select class="form-control" name="brand_id">
                        <option value="0">----------------------------</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{(old('brand_id')==$brand->id)?'selected':''}}>{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                {{--                <div class="form-group">--}}
                {{--                    <label>Наименование:</label>--}}
                {{--                    <input type="text" class="form-control" name="name">--}}
                {{--                </div>--}}
                <div class="form-group">
                    <label>Выбрать опцию:</label>
                    <select class="form-control" name="option">
                        <option value="0">----------------------------</option>
                        <option value="1">Аренда</option>
                        <option value="2">Продажа</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Цена от:</label>
                    <input type="number" class="form-control" name="priceFrom"
                           value="<?php if (isset($_GET['priceFrom'])) { echo $_GET['priceFrom']; } ?>">
                </div>
                <div class="form-group">
                    <label>Цена до:</label>
                    <input type="number" class="form-control" name="priceTill"
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
                {{$items->links()}}
            </div>
        </div>
    </div>
@endsection
