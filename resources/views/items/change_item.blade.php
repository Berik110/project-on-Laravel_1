@extends('layout.app')

@section('content')
    @if($item!=null)
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" >
                    <ol class="breadcrumb" style="background-color: white">
                        <li class="breadcrumb-item"><a href="{{'/'}}">Главная страница</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('categories', ['category_id'=>$item->category_id])}}">{{$item->category->name}}</a></li>
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
        <div class="row justify-content-center">
            <div class="col-md-6 mx-auto">

                @if(\Illuminate\Support\Facades\Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ \Illuminate\Support\Facades\Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card form-group">
                {{--<img src="{{$item->images->first()['url']}}" class="card-img-top" alt="...">--}}
                    @if($item->images->first()['url']!=null)
                        <img src="{{asset('storage/'.$item->images->first()['url'])}}" class="card-img-top">
                    @else
                        <img src="{{asset('/images/noImg.png')}}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <form action="{{url('/details/change/img')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{method_field('put')}}
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <div class="custom-file">
                                <input name="url" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Выбрать файл</label>

                            </div>
                            <button class="btn btn-primary mt-3">Загрузить</button>
                            @error('url')
                                <span class="text-danger">Файл должен быть изображением</span>
                            @enderror
                        </form>
                    </div>
                </div>

                <form action="{{route('updateItem')}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <input type="hidden" name="id" value="{{$item->id}}">
{{--                    <input type="hidden" name="user_id" value="{{$user->id}}">--}}

                    <div class="form-group">
                        <label class="font-weight-bold">Выбрать Область</label>
                        <select class="form-control" name="region_id" id="region" required>
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
                        <label class="font-weight-bold">Выбрать город</label>
                        <select class="form-control" name="city_id" id="city" required>
                            <option value="{{$item->city->id}}">{{$item->city->name}}</option>
{{--                            <option value="{{($item)?$item->city->id:"0"}}" {{($item)?"selected='selected'":""}}>--}}
{{--                                {{$item->city->name}}--}}
{{--                            </option>--}}
                        </select>
                        @error('city_id')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Выбрать опцию</label>
                        <select class="form-control" name="option_id" id="option" required>
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
                        <label class="font-weight-bold"><span class="text-danger font-weight-bold">*</span>Арендная ставка (указываете в случае аренды)</label>
{{--                        <select class="form-control" name="rental_option" value="{{$item->rental_option}}">--}}
{{--                            @for($i=0; $i<=3; $i++)--}}
{{--                                --}}{{--<option {{($item->option==$i) ? "selected='selected'":""}} value="{{$i}}">--}}
{{--                                <option {{($item->rental_option==$i) ? "selected='selected'":""}} >--}}
{{--                                    @if($i=='0')--}}
{{--                                        {{$i.'. ----------'}}--}}
{{--                                    @elseif($i=='1')--}}
{{--                                        {{$i.'. за 1 час'}}--}}
{{--                                    @elseif($i=='2')--}}
{{--                                        {{$i.'. за 1 день'}}--}}
{{--                                    @elseif($i=='3')--}}
{{--                                        {{$i.'. за 1 месяц'}}--}}
{{--                                        --}}{{--                                @else($i==4)--}}
{{--                                        --}}{{--                                   {{$i.'-запасные части'}}--}}
{{--                                    @endif--}}
{{--                                </option>--}}
{{--                            @endfor--}}
{{--                        </select>--}}
                        <select class="form-control" name="rent_id" id="rent" required>
                            <option value="{{$item->rental->id}}">{{$item->rental->name}}</option>
                        </select>
                        @error('rent_id')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Стоимость Аренды/Продажи/Услуги в тенге</label>
                        <input type="number" class="form-control" name="price" value="{{$item->price}}" required>
                        @error('price')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Выбрать категорию</label>
                        <select class="form-control" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{($category->id==$item->category_id)?"selected='selected'":""}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Выбрать марку</label>
                        <select class="form-control" name="brand_id" required>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" {{($brand->id==$item->brand_id)?"selected='selected'":""}}>
                                    {{$brand->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Наименование оборудования/техники или модель</label>
                        <input type="text" class="form-control" name="name" value="{{$item->name}}" required>
                        @error('name')
                        {{-- <span class="text-danger">{{$message}}</span>--}}
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Год выпуска</label>
                        <input type="number" class="form-control" name="year" value="{{$item->year}}" required>
                        @error('year')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Описание оборудования/техники</label>
                        <textarea class="form-control" rows="3" placeholder="Описание оборудования/техники" name="description" required>{{$item->description}}</textarea>
                        @error('description')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
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

@section('custom.js')
{{--    <script src="{{asset('jquery-3.5.1.min.js')}}"></script>--}}
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

        // $(document).ready(function () {
        //     $('#region').change(function () {
        //         var id = $(this).val();
        //
        //         $('#city').find('option').not(':first').remove();
        //
        //         $.ajax({
        //             url:'reg/'+id,
        //             type:'get',
        //             dataType:'json',
        //             success:function (response) {
        //                 var len = 0;
        //                 if (response.data != null) {
        //                     len = response.data.length;
        //                     console.log(response);
        //                 }
        //
        //                 if (len>0) {
        //                     for (var i = 0; i<len; i++) {
        //                         var id = response.data[i].id;
        //                         var name = response.data[i].name;
        //
        //                         var option = "<option value='"+id+"'>"+name+"</option>";
        //                         console.log(option);
        //                         // $("#city").append(option);
        //                     }
        //                 }
        //             }
        //         })
        //     });
        // });
    </script>
@endsection
