@extends('layout.app')
@section('content')

    {{--    @include('admin.items.update')--}}

    <div class="row mt-4">
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item list-group-item-info" aria-disabled="true">
                    <a href="{{route('admin.index')}}" style="text-decoration: none; color: black">
                        Главная
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1" aria-disabled="true">
                    <a href="{{route('admin.categories')}}" style="text-decoration: none; color: black">
                        Категории
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1">
                    <a href="{{route('admin.brands')}}" style="text-decoration: none; color: black">
                        Брэнд
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1">
                    <a href="{{route('admin.items')}}" style="text-decoration: none; color: black">
                        Оборудования
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Button trigger modal -->
            <div class="text-right">
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#updateItem">
                    Редактировать
                </button>
            </div>


            <div class="card mt-3">
                <div class="card-body">
                    {{$item->name}}<br>
                    {{$item->description}}
                    {{$item->price}}
                    {{$item->quantity}}
                    {{$item->option}}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="updateItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.itemUpdate')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="id" value="{{$item->id}}">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактировать данные</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
{{--                        <div class="form-group">--}}
{{--                            <label>Выбрать категорию</label>--}}
{{--                            <select name="category_id" class="form-control">--}}
{{--                                @foreach($categories as $category)--}}
{{--                                    <option value="{{$category->id}}">{{$category->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('category_id')--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Выбрать брэнд</label>--}}
{{--                            <select name="brand_id" class="form-control">--}}
{{--                                @foreach($brands as $brand)--}}
{{--                                    <option value="{{$brand->id}}">{{$brand->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('brand_id')--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Наименование</label>--}}
{{--                            <input type="text" class="form-control" name="name" value="{{$item->name}}">--}}
{{--                            @error('name')--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Описание</label>--}}
{{--                            <textarea class="form-control" name="description" rows="3">{{$item->description}}</textarea>--}}
{{--                            @error('description')--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Цена</label>--}}
{{--                            <input type="text" class="form-control" name="price" value="{{$item->price}}">--}}
{{--                            @error('price')--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Количество</label>--}}
{{--                            <input type="text" class="form-control" name="quantity" value="{{$item->quantity}}">--}}
{{--                            @error('quantity')--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Опция</label>--}}
{{--                            <input type="text" class="form-control" name="option" value="{{$item->option}}">--}}
{{--                            @error('option')--}}
{{--                                <span class="text-danger">{{$message}}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <select class="form-control" name="category_id">
                                <option value="0">Выбрать категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{($category->id==$item->category_id)?"selected='selected'":""}}>
                                        {{$category->name}}
                                    </option>
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
                                    <option value="{{$brand->id}}" {{($brand->id==$item->brand_id)?"selected='selected'":""}}>
                                        {{$brand->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Наименование оборудования/техники" name="name"
                                   value="{{$item->name}}">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Описание оборудования/техники" name="description">{{$item->description}}
                        </textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="option" value="{{$item->option}}">
                                @for($i=1; $i<=2; $i++)
                                    <option  {{($item->option==$i) ? "selected='selected'":""}}?>
                                        @if($i==1)
                                            {{$i.'-аренда'}}
                                        @elseif($i==2)
                                            {{$i.'-продажа'}}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Цена аренды за 1 час/продажи" name="price"
                                   value="{{$item->price}}">
                            @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="количество" name="quantity" value="{{$item->quantity}}">
                            @error('quantity')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
