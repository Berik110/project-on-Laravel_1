
<!-- Modal -->
<div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.itemInsert')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать Продукцию</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" name="region_id" id="region" required>
                            <option value="0">Выбрать Область</option>
                            @foreach($regions as $region)
                                <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="city_id" id="city" required>
                            <option value="0">Выбрать город</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category_id" required value="{{ old('category_id') }}">
                            <option value="0">Выбрать Категорию</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="brand_id" required>
                            <option value="0">Выбрать Марку</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Наименование / модель" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="year" placeholder="Год выпуска" value="{{ old('year') }}" required>
                        @error('year')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Описание" name="description"></textarea>
                        @error('description')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="option_id" id="option" required value="{{ old('option_id') }}">
                            <option value="0">Выбрать опцию</option>
                            @foreach($options as $option)
                                <option value="{{$option->id}}">{{$option->name}}</option>
                            @endforeach
                        </select>
                        @error('option')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="rent_id" id="rent" required>
                            <option value="0">Арендная ставка (указываете в случае аренды)</option>
                            @foreach($rents as $rent)
                                <option value="{{$rent->id}}">{{$rent->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Цена" name="price" value="{{ old('price') }}" min="0" required>
                        @error('price')
                            <span class="text-danger">Обязательное поле для заполнения</span>
                        @enderror
                    </div>

                    <div class="custom-file">
                        <input name="url" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Выбрать файл</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>


