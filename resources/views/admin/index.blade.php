@extends('layout.app')
@section('content')
    <div class="row mt-4 p-2" style="min-height: 400px; background-color: #2d995b">
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
        <div class="col-md-9 mt-3">
            <h2 class="text-center mb-3 text-light">Личный кабинет админа</h2>
            <p class="font-weight-bold text-light">Количество категории - {{count($categories)}}</p>
            <p class="font-weight-bold text-light">Количество брэндов - {{count($brands)}}</p>
            <p class="font-weight-bold text-light">Всего опубликованных объявлении - {{count($items)}}</p>
            <p class="font-weight-bold text-light">Всего зарегестрированных пользователей - {{count($users)}}</p>
        </div>
    </div>
@endsection


