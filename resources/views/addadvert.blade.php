@extends('layout.app')
@section('content')

    <div class="row mt-4 justify-content-center">
        <div class="col-md-6 mx-auto">

            <?php
            if(isset($_GET['succes']) && $_GET['succes']=='1'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Ваше объявление добавлено!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            }
            ?>

            <form action="{{route('toAddAdv')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="form-group">
                    <select class="form-control" name="category_id">
                        <option value="0">Выбрать категорию</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-control" name="brand_id">
                        <option value="0">Выбрать брэнд</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Наименование оборудования/техники" name="name" required>
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="3" placeholder="Описание оборудования/техники" name="description"></textarea>
                    @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-control" name="option">
                        <option value="0">Выбрать опцию</option>
                        <option value="1">Аренда</option>
                        <option value="2">Продажа</option>
                    </select>
                    @error('option')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="Цена аренды за 1 час/продажи" name="price">
                    @error('price')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="количество" name="quantity">
                    @error('quantity')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="custom-file">
                    <input name="advImage" type="file" class="custom-file-input" id="customFile">
{{--                    <input name="advImage[]" multiple="multiple" type="file" class="custom-file-input" id="customFile">--}}
                    <label class="custom-file-label" for="customFile">Выбрать файл</label>
                </div>
                <div class="form-group text-right mt-3">
                    <button class="btn btn-success">Добавить объявление</button>
                </div>
            </form>
        </div>

    </div>
@endsection

