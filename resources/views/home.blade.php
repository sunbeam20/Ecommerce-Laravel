@include('components.header')
{{-- @if (Auth::guard('web')->check())
  <h1>Logged in as {{ Auth::guard('web')->user()->name }}</h1>
@else
  <h1>Guest</h1>
@endif --}}

@include('components.categoriesCard')

<div class="product-list">
  <h1 class="h1">Top Products</h1>
  @include('components.topSoldProductCard')
  <div class="view-more">
    <a href="/Results">
      <h2 class="h2">View More <img src="{{ asset('images/more.png') }}" /></h2>
    </a>
  </div>
</div>
<div class="product-list">
  <h1 class="h1">New Arrivals</h1>
  @include('components.newProductCard')
  <div class="view-more">
    <a href="/Results">
      <h2 class="h2">View More <img src="{{ asset('images/more.png') }}" /></h2>
    </a>
  </div>
</div>
{{-- @if (Auth::guard('web')->check())
<div class="product-list">
  <h1 class="h1">Recommended for You</h1>
  @include('components.productCard')
  <div class="view-more">
    <a href="/Results">
      <h2 class="h2">View More <img src="{{ asset('images/more.png') }}" /></h2>
    </a>
  </div>
</div>
@endif --}}


<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="ShopBot"
  agent-id="2bd1f06d-0bcd-47aa-b3f5-b97949110bdf"
  language-code="en"
></df-messenger>

<script>
  const dfMessenger = document.querySelector('df-messenger');
const payload = [
  {
    "type": "info",
    "title": "Info item title",
    "subtitle": "Info item subtitle",
    "image": {
      "src": {
        "rawUrl": "https://example.com/images/logo.png"
      }
    },
    "actionLink": "https://example.com"
  }
];
dfMessenger.renderCustomCard(payload);

</script>

@include('components.footer')

<style>

  a{
    text-decoration: none;
    color: black;
  }
  body {
    margin: 0px;
  }

  .h1,
  .h2 {
    width: 100%;
    cursor: pointer;
    text-decoration: none;
  }

  .h2 {
    text-align: right;
    cursor: pointer;
  }

  .h2 img {
    height: 10px;
    width: auto;
    cursor: pointer;
  }

  .h1:hover,
  .h2:hover,
  .h2 img:hover {
    text-decoration: underline;
  }

  .product-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: left;
    /* start product from left*/
    align-items: center;
    gap: 1em;
    margin: 2em 3em;
    padding: 2em 1em;
    flex-direction: row;
    border-radius: 5px;
    background-color: rgb(235, 235, 235);
  }

  .view-more {
    width: 100%;
    right: 1em;
    margin-right: 2em;
  }
</style>
