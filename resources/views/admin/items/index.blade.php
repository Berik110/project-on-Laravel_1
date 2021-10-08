@extends('layout.app')
@section('content')
    @include('admin.items.insert')

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
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#addItem">
                    Добавить Продукцию
                </button>
            </div>

            <table class="table table-hover mt-3">
                <thead>
                <tr>
                    <th>#</th>
                    <th>name</th>
{{--                    <th style="width:20%">description</th>--}}
                    <th>price</th>
                    <th>option</th>
                    <th>rental option</th>
                    <th>brand</th>
                    <th>category</th>
{{--                    <th>orders</th>--}}
                    <th>created at</th>
                    <th style="width: 10%">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>
{{--                            {{($item->option == 1) ? 'Аренда' : 'Продажа' }}--}}
                            @switch($item->option_id)
                                @case(1)
                                    Аренда
                                @break

                                @case(2)
                                    Продажа
                                @break

                                @case(3)
                                    Сервис / Услуги
                                @break

                                @default
                                    -------
                            @endswitch
                        </td>
                        <td>
                            @switch($item->rent_id)
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
                        </td>
                        <td>{{$item->brand->name}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <a href="{{route('admin.itemShow', ['id'=>$item->id])}}" class="btn btn-success mb-1">Обновить</a>
                            <form action="{{url('/admin/item/'.$item->id)}}" method="post">
                                {{method_field('delete')}}
                                @csrf
                                {{--<input type="hidden" name="brand_id" value="{{$brand->id}}">--}}
                                <button class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
            $('select[id="region"]').on('change', function (){
                var region_id = $(this).val();
                // console.log(region_id);
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
                            });
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

