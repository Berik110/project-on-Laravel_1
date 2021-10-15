@extends('layout.app')
@section('content')
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
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Button trigger modal -->
            <div class="text-right">
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#updateRegion">
                    Обновить категорию
                </button>
            </div>


            <div class="card mt-3">
                <div class="card-body">
                    {{$region->name}}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="updateRegion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.regionUpdate')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="id" value="{{$region->id}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактировать Регион</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Наименование</label>
                            <input type="text" class="form-control" name="name" value="{{$region->name}}">
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