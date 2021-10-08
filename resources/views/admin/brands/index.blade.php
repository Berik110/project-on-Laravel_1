@extends('layout.app')
@section('content')
    @include('admin.brands.insert')
    @include('admin.brands.update')

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
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#addBrand">
                    Добавить Брэнд
                </button>
            </div>

            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>name</th>
                        <th>created at</th>
                        <th style="width: 10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->created_at}}</td>
                            <td>
                                <a href="{{route('admin.brandShow', ['id'=>$brand->id])}}" class="btn btn-success mb-1">Обновить</a>
                                <form action="{{url('/admin/brand/'.$brand->id)}}" method="post">
                                    {{method_field('delete')}}
                                    @csrf
{{--                                    <input type="hidden" name="brand_id" value="{{$brand->id}}">--}}
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
