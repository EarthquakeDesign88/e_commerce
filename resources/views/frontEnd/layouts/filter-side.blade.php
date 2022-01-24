
<div class="box filter-toggle-box">
    <button class="btn-flat btn-hover" id="filter-close">close</button>
</div>


<form action="{{ route('productsFilter') }}" method="post">
    @csrf
    {{-- Categories --}}
    <div class="box">
        <span class="filter-header">
            Categories
        </span>
        
        <ul class="filter-list">
            @if (count($categories) > 0)
                @if (!empty($_GET['category']))
                    @php
                        $filter_cats = explode(',', $_GET['category']);  
                    @endphp
                @endif

                @foreach ($categories as $category_product)
                    <li>
                        <div class="group-checkbox mb-2">
                            <input type="checkbox" @if (!empty($filter_cats && in_array($category_product->slug, $filter_cats)))checked @endif
                            id="cat{{ $category_product->slug }}" name="category[]" onchange="this.form.submit()" value="{{ $category_product->slug }}">
                            <label for="cat{{ $category_product->slug }}">
                                <a href="{{ route('showProductCategory', $category_product->slug) }}">
                                    {{ $category_product->title }}
                                </a>
                                <small class="text-muted">({{ count($category_product->products) }})</small>
                                <i class='bx bx-check'></i>
                            </label>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</form>

    {{-- Price range --}}
    <div class="box">
        <span class="filter-header">
            Filter by Price
        </span>

        <input type="range" class="custom-range" min="0" max="5" step="0.5" id="customRange3">

    </div>


    {{-- Brands --}}
    <div class="box">
        <span class="filter-header">
            Brands
        </span>
        <ul class="filter-list">
            @if(count($brands) > 0)
                @foreach ($brands as $brand)
                    <li>
                        <div class="group-checkbox">
                            <input type="checkbox" id="brand{{ $brand->id }}">
                            <label for="brand{{ $brand->id }}">
                                <a href="">
                                    {{ $brand->title }}
                                </a>
                                <small class="text-muted">({{ count($brand->products) }})</small>
                                <i class='bx bx-check'></i>
                            </label>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>

    {{-- Size --}}
    <div class="box">
        <span class="filter-header">
            Size
        </span>
        <ul class="filter-list">
            <li>
                <div class="group-checkbox">
                    <input type="checkbox" id="sm-size">
                    <label for="sm-size">
                        Small
                        <i class='bx bx-check'></i>
                    </label>
                </div>
            </li>
            <li>
                <div class="group-checkbox">
                    <input type="checkbox" id="md-size">
                    <label for="md-size">
                        Medium
                        <i class='bx bx-check'></i>
                    </label>
                </div>
            </li>
            <li>
                <div class="group-checkbox">
                    <input type="checkbox" id="l-size">
                    <label for="l-size">
                        Large
                        <i class='bx bx-check'></i>
                    </label>
                </div>
            </li>
            <li>
                <div class="group-checkbox">
                    <input type="checkbox" id="xl-size">
                    <label for="xl-size">
                        Extra large
                        <i class='bx bx-check'></i>
                    </label>
                </div>
            </li>
            
        </ul>
    </div>

    {{-- Size --}}
    <div class="box">
        <span class="filter-header">
            Conditions
        </span>
        <ul class="filter-list">
            <li>
                <div class="group-checkbox">
                    <input type="checkbox" id="new-pd">
                    <label for="new-pd">
                        New
                        <i class='bx bx-check'></i>
                    </label>
                </div>
            </li>
            <li>
                <div class="group-checkbox">
                    <input type="checkbox" id="popular-pd">
                    <label for="popular-pd">
                        Popular
                        <i class='bx bx-check'></i>
                    </label>
                </div>
            </li>
            <li>
                <div class="group-checkbox">
                    <input type="checkbox" id="special-pd">
                    <label for="special-pd">
                        Special
                        <i class='bx bx-check'></i>
                    </label>
                </div>
            </li>                            
        </ul>
    </div>



