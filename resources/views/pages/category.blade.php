@extends('layouts.app')

@section('title','Store Categories')

@section('content')
<div class="page-content page-categories">
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Categories</h5>
                </div>
            </div>
            <div class="row">
                @php $iCategory = 0 @endphp
                @foreach ($categories as $cat)
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $iCategory += 100 }}">
                    <a @if(!empty($category)) {!! ($category->id == $cat->id) ? 'style="border: 2px solid #28a745;"' :
                        '' !!}
                        @endif
                        class="component-categories d-block" href="{{ route('categories-detail', $cat->slug) }}">
                        <div class="categories-image">
                            <img src="{{ Storage::url($cat->photo) }}" alt="{{ $cat->name }} Categories"
                                class="w-100" />
                        </div>
                        <p class="categories-text">
                            {{ $cat->name }}
                        </p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>All Products</h5>
                </div>
            </div>
            <div class="row">
                @php $iProduct = 0 @endphp
                @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $iProduct += 100 }}">
                    <a class="component-products d-block" href="{{ route('detail', $product->slug) }}">
                        <div class="products-thumbnail">
                            <div class="products-image" style="
                        @if($product->galleries)
                            background-image: url('{{ Storage::url($product->galleries->first()->photos) }}');
                        @else
                            background-color:#eee;
                        @endif
                    "></div>
                        </div>
                        <div class="products-text">
                            {{ $product->name }}
                        </div>
                        <div class="products-price">
                            @money($product->price)
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection