@extends('layout.app')
@section('content')
    @if($item!=null)
        <div class="row">
            <div class="col-md-12 mt-3">
                <nav aria-label="breadcrumb" >
                    <ol class="breadcrumb" style="background-color: white">
                        <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                        <li class="breadcrumb-item"><a href="{{route('categories', ['category_id'=>$item->category_id])}}">Техника-оборудования</a></li>
                        <li class="breadcrumb-item"><a href="{{route('details', ['item_id'=>$item->id])}}">
                                Детали - {{$item->brand->name}} {{$item->name}}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Редактирование данных
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-md-6 mx-auto">

                <div class="card form-group">
                    <img src="{{$item->images->first()['url']}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <form action="{{url('/details/change/img')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('put')}}
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Выбрать файл</label>
                            </div>
                            <button class="btn btn-primary mt-3">Загрузить</button>
                        </form>
                    </div>
                </div>

                <form action="{{route('updateItem')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="id" value="{{$item->id}}">
{{--                    <input type="hidden" name="user_id" value="{{$user->id}}">--}}
                    <div class="form-group">
                        <select class="form-control" name="category_id">
                            <option value="0">Выбрать категорию</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($category->id==$item->category_id)?"selected='selected'":""}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
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
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Наименование оборудования/техники" name="name"
                        value="{{$item->name}}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Описание оборудования/техники" name="description">{{$item->description}}
                        </textarea>
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
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="количество" name="quantity" value="{{$item->quantity}}">
                    </div>
                    <div class="form-group text-right mt-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            Удалить
                        </button>
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{route('todeleteItem')}}" method="post">
                    @csrf
                    {{method_field('delete')}}
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Удаление объявления</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Вы хотите удалить?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                            <button class="btn btn-primary">Удалить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <h3 class="display-4 text-center" style="margin-top: 100px">404 page not found</h3>
    @endif
@endsection


