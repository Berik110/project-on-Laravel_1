@extends('layout.app')
@section('content')

    <div class="row mt-4 justify-content-center">
        <div class="col-md-6 mx-auto">

            <?php
            if(isset($_GET['succes']) && $_GET['succes']=='1'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Ваше объявление добавлено!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            }
            ?>

            <form action="{{route('toAddAdv')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">

                <div class="form-group">
                    <label>Выбрать Область</label>
                    <select class="form-control" name="region_id" id="region" required>
                        <option value="0"></option>
                        @foreach($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                    </select>
                    @error('region_id')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Выбрать город</label>
                    <select class="form-control" name="city_id" id="city" required>
{{--                        <option value="0">город</option>--}}
                    </select>
                    @error('city_id')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Выбрать опцию</label>
                    <select class="form-control" name="option_id" id="option" value="{{ old('option_id') }}" required>
                        <option value="0"></option>
                        @foreach($options as $option)
                            <option value="{{$option->id}}">{{$option->name}}</option>
                        @endforeach
                    </select>
                    @error('option_id')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label><span class="text-danger font-weight-bold">*</span>Арендная ставка (указываете в случае аренды)</label>
                    <select class="form-control" name="rent_id" id="rent" required>
                    </select>
                    @error('rent_id')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Стоимость Аренды/Продажи/Услуги в тенге</label>
                    <input type="number" class="form-control" name="price" value="{{ old('price') }}" required>
                    @error('price')
                        <span class="text-danger">Обязательное поле для заполнения. Максиамальная длина 10 цифр.</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Выбрать категорию</label>
                    <select class="form-control" name="category_id" required>
                        <option class="disabled"></option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Выбрать марку</label>
                    <select class="form-control" name="brand_id" required>
                        <option class="disabled"></option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Наименование оборудования/техники или модель</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Год выпуска</label>
                    <input type="number" class="form-control" name="year" value="{{ old('year') }}" required>
                    @error('year')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Описание оборудования/техники</label>
                    <textarea class="form-control" rows="3" name="description" required>{{old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                    @enderror
                </div>

                <div class="custom-file">
                    <input name="url" type="file" class="custom-file-input" id="customFile">
{{--                    <input name="advImage[]" multiple="multiple" type="file" class="custom-file-input" id="customFile">--}}
                    <label class="custom-file-label" for="customFile">Выбрать файл</label>
                    @error('url')
                    {{--<span class="text-danger">{{$message}}</span>--}}
                        <span class="text-danger">Файл должен быть изображением</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="srok" value="{{date('Y-m-d H:i:s', time()+(60*2))}}" required>
                </div>

                <div class="form-group text-right mt-3">
                    <button class="btn btn-success">Добавить объявление</button>
                </div>
            </form>
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

        // $(document).ready(function () {
        //     $('#region').change(function () {
        //         var id = $(this).val();
        //
        //         $('#city').find('option').not(':first').remove();
        //
        //         $.ajax({
        //             url:'regions/'+id,
        //             type:'get',
        //             dataType:'json',
        //             success:function (response) {
        //                 var len = 0;
        //                 if (response.data != null) {
        //                     len = response.data.length;
        //                 }
        //
        //                 if (len>0) {
        //                     for (var i = 0; i<len; i++) {
        //                         var id = response.data[i].id;
        //                         var name = response.data[i].name;
        //
        //                         var option = "<option value='"+id+"'>"+name+"</option>";
        //
        //                         $("#city").append(option);
        //                     }
        //                 }
        //             }
        //         })
        //     });
        // });
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

