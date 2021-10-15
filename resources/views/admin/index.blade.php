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
        <div class="col-md-9 mt-3">
            <h2 class="text-center mb-3 text-light">Личный кабинет админа</h2>
            <p class="font-weight-bold text-light">Количество категории - <span class="text-warning">{{count($categories)}}</span></p>
            <p class="font-weight-bold text-light">Количество брэндов - <span class="text-warning">{{count($brands)}}</span></p>
            <p class="font-weight-bold text-light">Всего опубликованных объявлении - <span class="text-warning">{{count($items)}}</span>.
                Из них активных - <span class="text-warning">{{count($itemsActive)}}</span>,
                в архиве - <span class="text-warning">{{count($itemsArchives)}}</span>
            </p>
            <p class="font-weight-bold text-light">Всего зарегестрированных пользователей - <span class="text-warning">
                    {{count($users)}}
                </span>
            </p>
        </div>
    </div>
@endsection


