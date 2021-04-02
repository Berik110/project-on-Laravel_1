@extends('layout.app')
@section('content')

    <div class="row mt-4 justify-content-center">
        @foreach($categories as $category)
        <div class="card bg-light mr-3 mb-3" style="width: 16rem;">
            <a href="{{route('categories', ['category_id'=>$category->id])}}" style="text-decoration: none; color: black; font-size: 1rem">
                <img src="{{$category->cat_url}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text text-center">{{$category->name}}</p>
                </div>
            </a>
        </div>
        @endforeach

{{--        @foreach($items as $item)--}}
{{--            <div class="card bg-light mr-3 mb-3" style="width: 16rem;">--}}
{{--                <a href="#" style="text-decoration: none; color: black; font-size: 1rem">--}}
{{--                    <img src="https://acropolis-wp-content-uploads.s3.us-west-1.amazonaws.com/2018/06/carry-deck-crane-IC_100.jpg" class="card-img-top" alt="...">--}}
{{--                    <div class="card-body">--}}
{{--                        <p class="card-text text-center">{{$item->brand->name}}</p>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--        <div class="card bg-light mr-3" style="width: 16rem;">--}}
{{--            <a href="#" style="text-decoration: none; color: black; font-size: 1rem">--}}
{{--                <img src="https://acropolis-wp-content-uploads.s3.us-west-1.amazonaws.com/2018/06/carry-deck-crane-IC_100.jpg" class="card-img-top" alt="...">--}}
{{--                <div class="card-body">--}}
{{--                    <p class="card-text text-center">Cranes</p>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="card bg-light mr-3" style="width: 16rem;">--}}
{{--            <img src="https://acropolis-wp-content-uploads.s3.us-west-1.amazonaws.com/2017/04/product_image_11-120-320x259.jpg" class="card-img-top" alt="...">--}}
{{--            <div class="card-body">--}}
{{--                <p class="card-text text-center"><a href="#" style="text-decoration: none; color: black; font-size: 1rem">Cranes</a></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card bg-light mr-3" style="width: 16rem;">--}}
{{--            <img src="https://acropolis-wp-content-uploads.s3.us-west-1.amazonaws.com/2017/04/product_image_20-230-320x259.jpg" class="card-img-top" alt="...">--}}
{{--            <div class="card-body">--}}
{{--                <p class="card-text text-center"><a href="#" style="text-decoration: none; color: black; font-size: 1rem">Cranes</a></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card bg-light mr-3" style="width: 16rem;">--}}
{{--            <img src="https://acropolis-wp-content-uploads.s3.us-west-1.amazonaws.com/2017/04/product_image_55-750-320x259.jpg" class="card-img-top" alt="...">--}}
{{--            <div class="card-body">--}}
{{--                <p class="card-text text-center"><a href="#" style="text-decoration: none; color: black; font-size: 1rem">Cranes</a></p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

@endsection
