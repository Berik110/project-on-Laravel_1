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
                <li class="list-group-item list-group-item-info mt-1">
                    <a href="{{route('admin.regions')}}" style="text-decoration: none; color: black">
                        Регионы
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1">
                    <a href="{{route('admin.cities')}}" style="text-decoration: none; color: black">
                        Города
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1">
                    <a href="{{route('admin.options')}}" style="text-decoration: none; color: black">
                        Опции
                    </a>
                </li>
                <li class="list-group-item list-group-item-info mt-1">
                    <a href="{{route('admin.options_types')}}" style="text-decoration: none; color: black">
                        Подклассы Опции
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
                        <div class="form-group">
                            <select class="form-control" name="region_id" id="region" required>
                                <option value="0">Выбрать Область</option>
                                @foreach($regions as $region)
                                    <option value="{{$region->id}}" {{($region->id==$item->city->region->id)?"selected='selected'":""}}>
                                        {{$region->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('region_id')
                                <span class="text-danger">Обязательное поле для заполнения</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="city_id" id="city" required>
                                <option value="{{$item->city->id}}">{{$item->city->name}}</option>
                            </select>
                            @error('city_id')
                                <span class="text-danger">Обязательное поле для заполнения</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="option_id" id="option" required>
                                <option value="0">Выбрать опцию</option>
                                @foreach($options as $option)
                                    <option value="{{$option->id}}" {{($option->id==$item->option_id)?"selected='selected'":""}}>
                                        {{$option->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('option_id')
                                <span class="text-danger">Обязательное поле для заполнения</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="rent_id" id="rent" required>
                                <option value="{{$item->rental->id}}">{{$item->rental->name}}</option>
                            </select>
                            @error('rent_id')
                                <span class="text-danger">Обязательное поле для заполнения</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Цена аренды за 1 час/продажи" name="price"
                                   value="{{$item->price}}" required>
                            @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="category_id" required>
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
                            <select class="form-control" name="brand_id" required>
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
                            <input type="text" class="form-control" placeholder="Наименование оборудования/техники или модель" name="name"
                                   value="{{$item->name}}" required>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="год выпуска" name="year" value="{{$item->year}}" required>
                            @error('year')
                                <span class="text-danger">Обязательное поле для заполнения</span>
                            @enderror
                        </div>

                        <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Описание оборудования/техники" name="description">{{$item->description}}
                        </textarea>
                            @error('description')
                                <span class="text-danger">Обязательное поле для заполнения</span>
                            @enderror
                        </div>

                        {{--                        <div class="form-group">--}}
                        {{--                            <input type="number" class="form-control" placeholder="количество" name="quantity" value="{{$item->quantity}}">--}}
                        {{--                            @error('quantity')--}}
                        {{--                                <span class="text-danger">{{$message}}</span>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}

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
@section('custom.js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function (){
            $('select[name="region_id"]').on('change', function (){
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

            /* выбор опции Аренды/продажи/сервиса */
            $('select[id="option"]').on('change', function (){
                var option_id = $(this).val();
                // console.log(region_id);
                if (option_id){
                    $.ajax({
                        url: '/opt/'+option_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);

                            $('select[name="rent_id"]').empty();
                            $.each(data, function (key, value){
                                $('select[name="rent_id"]').append('<option value="'+key+'">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="rent_id"]').empty();
                }
            });
        });
    </script>
@endsection
