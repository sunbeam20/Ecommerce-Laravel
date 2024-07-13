@include('components.header')
<div class="results">
  <div class="filters">
    <h1>Filters</h1>
    <form id="filterForm" action="/search" method="GET">
      @if (isset($query))
        <input type="hidden" name="query" value="{{ $query }}" />
      @else<input type="hidden" name="query" value="" />
      @endif

      <div class="filter-option">
        <label>
          <h2>Category</h2>
        </label>
        <div>
          @foreach ($categories as $category)
          <label>
            <input type="radio" name="category" value="{{ $category->id }}" 
              {{ isset($_GET['category']) && $_GET['category'] == $category->id ? 'checked' : '' }}/>
            {{ $category['name'] }}
          </label>
          @endforeach
        </div>
      </div>
      <div class="filter-option">
        <label class="label">
          <h2>Price</h2>
        </label>
        <div>
          <label>
            <input type="radio" name="price" value="low_to_high" />Low to High
          </label>
          <label>
            <input type="radio" name="price" value="high_to_low" />High to Low
          </label>
        </div>
      </div>
      <div class="filter-option">
        <label class="label">
          <h2>Brand</h2>
        </label>
        <div>
          <label>
            <input type="radio" name="brand" value="brand" 
              {{ isset($_GET['brand']) && $_GET['brand'] == 'brand' ? 'checked' : '' }}/>Brand
          </label>
          <label>
            <input type="radio" name="brand" value="non_brand" 
              {{ isset($_GET['brand']) && $_GET['brand'] == 'non_brand' ? 'checked' : '' }}/>Non-Brand
          </label>
        </div>
      </div>
      <button type="submit" class="apply">Apply Filters</button>
    </form>
  </div>
  <div class="main-content">
    <h1>Products</h1>
    <div class="sortbar">
      <label for="">Sort By</label>
      <button id="latest" class="sortbtn">New Arrivals</button>
      <button id="top" class="sortbtn">Top Sales</button>
    </div>
    <div class="product-container" id="searchContainer">
      @if (isset($product))
        @foreach ($product as $item)
          <div class="product-card">
            {{-- <router-link :to="{ name: 'Product', params: { id: product.id } }"> --}}
            <a href={{ 'Product/' . $item->id }}>
              <div class="product-image">
                <img src="{{ asset($item->image) }}" title="View" class="hover-effect" />
              </div>
            </a>
            {{-- </router-link> --}}
            <div class="product-details">
              <div class="product-name">
                {{ $item->name }}
              </div>
              <div class="product-price">
                <p id="sold">1k Sold</p>
                <p>RM {{ $item->price }}</p>
                <form action="/cart" method="POST" class="add-to-cart">
                  @csrf
                  @auth
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                  @endauth
                  <input type="hidden" name="product" value="{{ json_encode($item) }}">
                  <button type="submit" {{-- @guest disabled @endguest --}}>
                    <img src="{{ asset('images/add-to-cart.png') }}" class="hover-effect" />
                  </button>
                </form>
                <!-- ^ -->
              </div>
            </div>
          </div>
        @endforeach
      @else
        @foreach ($products as $item)
          <div class="product-card">
            {{-- <router-link :to="{ name: 'Product', params: { id: product.id } }"> --}}
            <a href={{ 'Product/' . $item->id }}>
              <div class="product-image">
                <img src="{{ asset($item->image) }}" title="View" class="hover-effect" />
              </div>
            </a>
            {{-- </router-link> --}}
            <div class="product-details">
              <div class="product-name">
                {{ $item->name }}
              </div>
              <div class="product-price">
                <p id="sold">1k Sold</p>
                <p>RM {{ $item->price }}</p>
                <form action="/cart" method="POST" class="add-to-cart">
                  @csrf
                  @auth
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                  @endauth
                  <input type="hidden" name="product" value="{{ json_encode($item) }}">
                  <button type="submit" {{-- @guest disabled @endguest --}}>
                    <img src="{{ asset('images/add-to-cart.png') }}" class="hover-effect" />
                  </button>
                </form>
                <!-- ^ -->
              </div>
            </div>
          </div>
        @endforeach
      @endif

    </div>
    <div class="product-container" id="newContainer" style="display: none">
      @include('components.newProductCard')
    </div>
    <div class="product-container" id="topContainer" style="display: none">
      @include('components.topSoldProductCard')
    </div>
  </div>
</div>
@include('components.footer')

<style>
  .apply {
    color: #000;
    border: 1px solid gray;
    border-radius: 5px;
  }

  body {
    margin: 0px;
  }

  .results {
    display: flex;
    padding-right: 1em;
    margin: 1.25em 0.25em 1.25em 0.25em;
    background-color: rgb(235, 235, 235);
  }

  .filters {
    flex: 0 0 12.5em;
    padding-left: 1%;
    border-radius: 5px;
    border-right: 1px solid rgba(122, 122, 122, 0.685);
  }

  .filter-option {
    margin-bottom: 0.625em;
    width: 15vw;
  }

  .filter-option div {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
  }

  .filter-option label {
    display: flex;
    margin: 0.5em;
    padding: 0.1em;
    align-items: center;
    width: 35%;
  }

  .filter-option .label {
    width: 50%;
  }

  .filter-option input[type="checkbox"] {
    margin-right: 0.3125em;
    margin: 0.5em;
    display: flex;
  }

  .main-content {
    flex: 1;
    margin: 0em 0em 0em 1.25em;
  }

  .sortbar {
    display: flex;
    background-color: rgb(255, 255, 255);
    margin-bottom: 0.3125em;
    border: 1px solid rgb(212, 212, 212);
    padding: 1em;
    align-items: center;
    border-radius: 5px;
  }

  .sortbar label {
    color: #505050;
  }

  .sortbar button {
    border-radius: 0.5em;
    border: none;
    color: #000;
    font-weight: bold;
    margin-left: 1em;
  }

  .active {
    background-color: rgb(235, 235, 235);
    /* Change to the desired active button background color */
  }

  .sortbar button:hover {
    cursor: pointer;
  }

  .product-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    gap: 1em;
    margin-left: 1.5em;
    padding: 2em 0em 2em 0em;
    justify-content: flex-start;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var latestBtn = document.getElementById('latest');
    var topBtn = document.getElementById('top');
    var newContainer = document.getElementById('newContainer');
    var topContainer = document.getElementById('topContainer');

    function setActiveButton(button) {
      latestBtn.classList.remove('active');
      topBtn.classList.remove('active');

      button.classList.add('active');
    }

    latestBtn.addEventListener('click', function() {
      setActiveButton(this);
      topContainer.style.display = 'none';
      newContainer.style.display = 'flex';
    });

    topBtn.addEventListener('click', function() {
      setActiveButton(this);
      newContainer.style.display = 'none';
      topContainer.style.display = 'flex';
    });

  });

  //form filter
  var form = document.getElementById('filterForm');

// Add an event listener for form submission
form.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get the selected category value
  var selectedCategory = document.querySelector('input[name="category"]:checked');
  var categoryValue = selectedCategory ? selectedCategory.value : '';

  // Get the selected price value
  var selectedPrice = document.querySelector('input[name="price"]:checked');
  var priceValue = selectedPrice ? selectedPrice.value : '';

  // Get the selected payment types
  var selectedPaymentTypes = Array.from(document.querySelectorAll('input[name="payment_type[]"]:checked'))
    .map(function(checkbox) {
      return checkbox.value;
    });

  // Get the selected brand value
  var selectedBrand = document.querySelector('input[name="brand"]:checked');
  var brandValue = selectedBrand ? selectedBrand.value : '';

  // Construct the URL with the selected filters and search query
  var url = form.action + '?query=' + encodeURIComponent(form.query.value);

  if (categoryValue) {
    url += '&category=' + encodeURIComponent(categoryValue);
  }

  if (priceValue) {
    url += '&price=' + encodeURIComponent(priceValue);
  }

  if (selectedPaymentTypes.length > 0) {
    url += '&payment_type=' + encodeURIComponent(selectedPaymentTypes.join(','));
  }

  if (brandValue) {
    url += '&brand=' + encodeURIComponent(brandValue);
  }

  // Redirect to the final URL
  window.location.href = url;
});

</script>
