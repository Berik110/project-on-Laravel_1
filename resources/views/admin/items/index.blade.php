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
                    <th style="width:20%">description</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>option</th>
                    <th>brand</th>
                    <th>category</th>
                    <th>orders</th>
                    <th>created at</th>
                    <th style="width: 10%">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{($item->option == 1) ? 'Аренда' : 'Продажа' }}</td>
                        <td>{{$item->brand->name}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{count($item->orders)}}</td>
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

        $(document).ready(function () {
            $('#region').change(function () {
                var id = $(this).val();

                $('#city').find('option').not(':first').remove();

                $.ajax({
                    url:'regions/'+id,
                    type:'get',
                    dataType:'json',
                    success:function (response) {
                        var len = 0;
                        if (response.data != null) {
                            len = response.data.length;
                        }

                        if (len>0) {
                            for (var i = 0; i<len; i++) {
                                var id = response.data[i].id;
                                var name = response.data[i].name;

                                var option = "<option value='"+id+"'>"+name+"</option>";

                                $("#city").append(option);
                            }
                        }
                    }
                })
            });
        });
    </script>
@endsection

