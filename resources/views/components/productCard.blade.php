@foreach ($recommend as $product)
  <div class="product-card">
    {{-- <router-link :to="{ name: 'Product', params: { id: product.id } }"> --}}
    <a href={{ 'Product/' . $product->product->id }}>
      <div class="product-image">
        <img src="{{ asset($product->product->image) }}" title="View" class="hover-effect" />
      </div>
    </a>

    {{-- </router-link> --}}
    <div class="product-details">
      <div class="product-name">
        {{ $product->product->name }}
      </div>
      <div class="product-price">
        <p id="sold">{{$product['total_quantity_sold']}} Sold</p>
        <p>RM {{ $product->product->price }}</p>
        <form action="/cart" method="POST" class="add-to-cart">
          @csrf
          @auth
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
          @endauth
          <input type="hidden" name="product" value="{{ json_encode($product) }}">
          <button type="submit" {{-- @guest disabled @endguest--}}> 
            <img src="{{ asset('images/add-to-cart.png') }}" class="hover-effect" />
          </button>
        </form>
        <!-- ^ -->
      </div>
    </div>
  </div>
@endforeach

<style>
  .product-card {
    flex-direction: column;
    align-items: center;
    width: 12em;
    height: 20em;
    border-radius: 5px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    overflow: hidden;
  }

  .product-image:hover {
    cursor: pointer;
    transform: scale(1.05);
    transition: transform 0.5s ease;
  }

  .product-image {
    width: 100%;
    height: 60%;
    object-fit: contain;
  }

  .product-image img {
    width: 100%;
    height: 100%;
    border-radius: 5px;
  }

  .product-details {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    padding: 1em;
    height: 40%;
    background-color: white;
  }

  .product-name {
    font-size: 1em;
    margin-bottom: 0.7em;
  }

  .product-price {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 1.2em;
    font-weight: normal;
    color: #000000;
  }

  .product-price p {
    margin: 0px;
    margin-right: 0.3em;
    text-align: center;
    font-weight: bold;
  }

  #sold {
    font-size: small;
    color: #585858;
  }

  .add-to-cart img {
    width: 2em;
    height: auto;
  }
  .add-to-cart:hover{
    transform: scale(1.05);
    transition: transform 0.5s ease;
  }

  .add-to-cart {
    background-color: #ffffff;
    color: #000000;
    cursor: pointer;
    font-size: 0.75em;
    font-weight: bold;
  }
</style>
