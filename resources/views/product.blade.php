@include('components.header')
<div class="product-page">

  <div class="grid-container">
    <div class="item1"><img src="{{ asset($product['image']) }}" /></div>
    <div class="item2"><img src="{{ asset($product['image']) }}" /></div>
    <div class="item3"><img src="{{ asset($product['image']) }}" /></div>
    <div class="item4"><img src="{{ asset($product['image']) }}" /></div>
    <div class="item5"><img src="{{ asset($product['image']) }}" /></div>
  </div>
  <div class="side-grid">
    <div class="sgspace">
      <h2 class="sgsTitle">Product Name</h2>
      <h1 class="sgsTxt">{{ $product['name'] }}</h1>
    </div>
    <div class="sgspace">
      <h2 class="sgsTitle">Shop Name</h2>
      <h1 class="sgsTxt">{{ $product['shop_name'] }}</h1>
    </div>
    <div class="sgspace">
      <h2 class="sgsTitle">Category</h2>
      <h1 class="sgsTxt">{{ $product['category_name'] }}</h1>
    </div>
    <div class="sgspace">
      <h2 class="sgsTitle">Price</h2>
      <h2 class="sgsTxt">Rm {{ $product['price'] }}</h2>
    </div>
    <div class="sgspace">
      <h2 class="sgsTitle">Sold</h2>
      <h2 class="sgsTxt">{{$product['total_quantity_sold']}}</h2>
    </div>
    <div class="sgspace">
      <h2 class="sgsTitle">Available</h2>
      <h2 class="sgsTxt">{{ $product['stock'] }} pieces</h2>
    </div>
    <div class="sgspace">
      <h2 class="sgsTitle">Quantity</h2>
      <div class="counter-container sgsTxt">
        <button class="counter-button">-</button>
        <span class="counter-quantity">1</span>
        <button class="counter-button">+</button>
      </div>
    </div>
    <div class="actionbtn">
      <form class="product-form" action="/cart" method="POST">
        @csrf
        @auth
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        @endauth
        <input type="hidden" name="product" value="{{ json_encode($product) }}">
        <button class="add-to-cart" type="submit">Add to Cart</button>
      </form>
      <a href={{ 'Checkout/' . $product['id'] }} class="buy-now">Buy Now</a>
    </div>

  </div>
  <div class="product-description">
    <h2>Product Description</h2>
    <pre>
      {{ $product['description'] }}
    </pre>
  </div>
  {{-- Rlated Products --}}
  <div class="related-contents">
    <h2>Related Products</h2>
    @foreach ($relatedProducts as $related)
      <div class="related">
        <div class="product-card">
          {{-- <router-link :to="{ name: 'Product', params: { id: product.id } }"> --}}
          <a href={{ '/Product' .'/'. $related['id'] }}>
            <div class="product-image">
              <img src="{{ asset($related['image']) }}" title="View" class="hover-effect" />
            </div>
          </a>
          <div class="product-details">
            <div class="product-name">
              {{ $related['name'] }}
            </div>
            <div class="product-price">
              <p id="sold">{{$related['total_quantity_sold']}} Sold</p>
              <p>RM {{ $related['price'] }}</p>
              <form action="/cart" method="POST" class="radd-to-cart">
                @csrf
                @auth
                  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                @endauth
                <input type="hidden" name="product" value="{{ json_encode($related) }}">
                <button type="submit" {{-- @guest disabled @endguest --}}>
                  <img src="{{ asset('images/add-to-cart.png') }}" class="hover-effect" />
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{--  --}}

</div>
@include('components.footer')

<style>
  body {
    margin: 0px;
  }

  .product-form {
    display: block;
    margin-top: 0em;
    margin-block-end: 1em;
    margin-right: 1em;
  }

  .hover-effect:hover {
    background-color: #000000;
    color: #ffffff;
  }

  .product-page {
    display: flex;
    flex-wrap: wrap;
    justify-content: left;
    /* start product from left*/
    gap: 1em;
    margin: 2em 5em;
    padding: 2em 0em 2em 2em;
    border-radius: 5px;
    flex-direction: row;
    background-color: rgb(235, 235, 235);
  }

  .grid-container {
    margin: 1em 4em;
    display: grid;
    grid-template-columns: auto auto auto auto;
    gap: 1em;
    background-color: #ffffff00;
    width: 25%;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    border-radius: 5px;
  }

  .side-grid {
    height: 100%;
    width: 50%;
    margin: 2em 5em;
  }

  .sgspace {
    display: flex;
    align-items: center;
    width: 80%;
    flex-wrap: wrap;
  }

  .sgsTitle {
    width: 40%;
    text-align: right;
    margin-right: 5em;
    color: gray;
  }

  .sgsTxt {
    text-align: left;
  }

  .grid-container>div {
    background-color: rgba(255, 255, 255, 0);
    text-align: center;
    padding: 0em;
    font-size: 1em;
  }

  .item1 {
    grid-column: 1 / span 4;
  }

  .item1 img {
    width: 100%;
    height: 100%;
    border-radius: 5px;
  }

  .item2 img,
  .item3 img,
  .item4 img,
  .item5 img {
    width: 100%;
    height: auto;
    border-radius: 5px;
  }

  .counter-container {
    border: 1px solid rgb(146, 146, 146);
    display: inline-flex;
    /* Use inline-flex to adjust vertical alignment */
    align-items: center;
    /* Center the content vertically */
    text-align: center;
    background-color: #ffffff;
    color: #000000;
    height: 100%;
    border-radius: 5px;
  }

  .counter-button,
  .counter-quantity {
    background-color: #ffffff;
    color: black;
    font-weight: bolder;
    font-size: 1.1rem;
    padding: 0.25rem 0.1rem;
    width: 2rem;
    height: 100%;
    border: none;
    border-radius: 5px;
  }

  .counter-button {
    cursor: pointer;
  }

  .counter-button:hover {
    background-color: #000000;
    color: #ffffff;
  }

  .add-to-cart,
  .buy-now {
    background-color: #ffffff;
    color: #000000;
    border: 0.05em solid black;
    border-radius: 5px;
    padding: 0.75em 1em;
    cursor: pointer;
    font-size: 1em;
    font-weight: bold;
    text-decoration: none;
    font-family: Arial, Helvetica, sans-serif;
    height: 100%;
  }

  .add-to-cart:hover,
  .buy-now:hover {
    background-color: #000000;
    color: #ffffff;
  }

  .actionbtn {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: flex-start;
    margin: 2em;
  }

  .product-description {
    display: flex;
    flex-direction: column;
    justify-content: left;
    width: 100%;
    gap: 1em;
    border-radius: 5px;
    margin: 2em 4em 2em 4em;
    padding: 2em 0em 2em 2em;
    background-color: #f7f7f7;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }

  pre {
    font: inherit;
    text-wrap: wrap;
  }

  /* related products */
  .related-contents {
    margin: 2em 4em 2em 4em;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-content: flex-start;
    justify-content: flex-start;
    align-items: center;
  }

  .related-contents h2 {
    display: block;
    width: 100%;
  }

  .related {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    margin: 0.5em;
  }

  .product-card {
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
    height: 70%;
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

  .radd-to-cart img {
    width: 2em;
    height: auto;
  }

  .radd-to-cart:hover {
    transform: scale(1.05);
    transition: transform 0.5s ease;
  }

  .radd-to-cart {
    background-color: #ffffff;
    color: #000000;
    cursor: pointer;
    font-size: 0.75em;
    font-weight: bold;
  }
</style>
