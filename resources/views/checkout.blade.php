@include('components.header')
<h1>Checkout Your Items</h1>
<form class="form" action="/neworder" method="POST">
  @csrf
  <div class="checkout-page">
    <div style="width: 60%">
      <div class="shipping-address">
        <h2>Shipping Address</h2>
        <div class="address">
          <h3>{{ Auth::user()->name }}</h3>
          <p><img src="{{ asset('images/location.png') }}" alt="">{{ Auth::user()->address }},
            {{ Auth::user()->city }}, {{ Auth::user()->state }}, {{ Auth::user()->zip }}
          </p>
          <button id="change" type="button">Change</button>
        </div>
        @auth
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        @endauth
        <div class="edit-address">
          <div class="edit-contents">
            <label for="">Name</label>
            <input type="text" name="full_name" placeholder="Full Name" class="field"
              value="{{ Auth::user()->name }}" />
          </div>
          <div class="edit-contents">
            <label for="">Address</label>
            <input type="text" name="address" placeholder="Address" class="field"
              value="{{ Auth::user()->address }}" />
          </div>
          <div class="edit-contents">
            <label for="">City</label>
            <input type="text" name="city" placeholder="City" class="field" value="{{ Auth::user()->city }}" />
          </div>
          <div class="edit-contents">
            <label for="">State</label>
            <input type="text" name="state" placeholder="State" class="field"
              value="{{ Auth::user()->state }}" />
          </div>
          <div class="edit-contents"> <label for="">Zip-code</label>
            <input type="text" name="postal_code" placeholder="Postal/Zip-code" class="field"
              value="{{ Auth::user()->zip }}" />
          </div>
        </div>

      </div>
      <div class="product-list">
        <h2>Product List</h2>
        <!-- Display your product list here -->
        <!-- Example: -->
        <table>
          <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>
          @if(count($items)>1)
          @foreach ($items as $product)
            <tr>
              <td>{{ $product->name }}</td>
              <td><img src="{{ asset($product['image']) }}" alt=""></td>
              <td><label for="">1</label></td>
              <td><label for="">{{ $product->price }}</label></td>
            </tr>
          @endforeach
          @else
          @foreach ($items as $product)
          <tr>
            <td>{{ $product->name }}</td>
            <td><img src="{{ asset($product['image']) }}" alt=""></td>
            <td><label for="">1</label></td>
            <td><label for="">{{ $product->price }}</label></td>
          </tr>
          @endforeach
          @endif
        </table>
        <input type="hidden" name="products" value="{{$products}}">
      </div>
    </div>

    <div class="checkout-summary">

      <div class="payment-method">
        <h2>Payment Method</h2>
        <div class="flex">
          <div class="pm">
            <input type="radio" name="payment" id="" value="cod">
            <img class="img" src="{{ asset('images/cash-on-delivery.png') }}" />
          </div>
          <div class="pm">
            <input type="radio" name="payment" id="" value="bank">
            <img class="img" src="{{ asset('images/visa.png') }}" />
          </div>
          <div class="pm">
            <input type="radio" name="payment" id="" value="paypal">
            <img class="img" src="{{ asset('images/paypal.png') }}" />
          </div>
        </div>
      </div>

      <div class="collection-method">
        <h2>Order Collection Method</h2>
        <div class="flex">
          <div class="cm">
            <input type="radio" name="collection" id="" value="Deliver">
            <img class="img" src="{{ asset('images/delivery.png') }}" />
          </div>
          <div class="cm">
            <input type="radio" name="collection" id="" value="Self_Collect">
            <img class="img" src="{{ asset('images/pickup.png') }}" />
          </div>
        </div>

      </div>

      <div class="order-smmary">
        <h2>Order Summary</h2>
        @if(count($items)>1)
        @foreach ($items as $product)
          <div class="item-cost">
            <span>Item Cost: Rm</span>
            <span class="product-price">{{ $product->price }}</span>
          </div>
        @endforeach
        @else
        <div class="item-cost">
          <span>Item Cost: Rm</span>
          <span class="product-price">{{ $product->price }}</span>
        </div>
        @endif
        <div class="shipping-cost">
          <span>Shipping Cost: Rm</span>
          <span>4.99</span>
        </div>
        <hr />
        <div class="total-cost">
          <span>Total Cost: Rm</span>
          <span id="result"></span>
        </div>
      </div>
      <button class="place-order-button" type="submit">Place Order</button>
    </div>
  </div>
</form>
@include('components.footer')

<style>
  .flex {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
  }

  .pm,
  .cm {
    display: flex;
  }

  table,
  tbody {
    width: 100%;
  }

  th,
  td {
    width: 25%;
    text-align: left;
  }

  body {
    margin: 0px;
  }

  .img {
    width: 4em;
    height: auto;
    border-radius: 5px;
  }

  .payemt-btn {
    margin: 1em;
    cursor: pointer;
  }

  h1 {
    text-align: center;
    margin-top: 2em;
  }

  .form {
    padding: 2em 10em 0em 10em;
    background-color: #f5f5f5;
    border-radius: 2em;
  }

  .checkout-page {
    display: flex;
    justify-content: space-between;
    padding: 1em;
  }

  .address {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-evenly;
    align-items: center;
  }

  .address img {
    width: 1em;
    height: auto;
    margin-right: 5px;
  }

  #change {
    color: rgb(68, 52, 216);
    font-size: small;
  }

  .edit-address {
    display: none;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items: flex-end;
    align-content: flex-start;
    width: 100%;
  }

  .edit-address .edit-contents {
    display: flex;
    width: 100%;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
  }

  .edit-contents label {
    width: 15%;
    text-align: right;
    color: gray;
  }

  .edit-contents input {
    margin-left: 1em;
    display: inline-block;
    width: 65%;
    border: 1px solid gray;
    border-radius: 5px;
  }

  .product-list,
  .checkout-summary {
    flex-basis: 45%;
  }

  ul li {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-items: center;
  }

  .quantity-label {
    border: none;
    background-color: transparent;
    padding: 0;
    font-size: 1rem;
    font-weight: bold;
    color: #333;
  }

  .place-order-button {
    display: block;
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
  }

  .item-cost,
  .shipping-cost,
  .total-cost {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
  }

  .payment-method label {
    display: block;
    margin-bottom: 0.5rem;
  }

  .shipping-address {
    width: 30em;
    display: flex;
    flex-direction: column;
  }

  .field {
    margin: 0.5em;
    padding: 0.5em;
    border-radius: 0.5em;
    border-color: grey;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Calculate and update the total price
    function updateTotalPrice() {
      let totalPrice = 0;

      $('.product-price').each(function() {
        totalPrice += parseFloat($(this).text());
      });

      totalPrice += 4.99; // Add the shipping cost
      $('#result').text(totalPrice.toFixed(2));
    }

    updateTotalPrice(); // Calculate and display the total price on page load

    $('.payment-btn').click(function() {
      // Reset the selected state of all buttons
      $('.payment-btn').attr('data-selected', 'false');

      // Set the selected state of the clicked button
      $(this).attr('data-selected', 'true');

      // Get the value of the selected payment method
      var selectedPaymentMethod = $(this).val();

      // Set the value of the hidden input field
      $('#payment_method_input').val(selectedPaymentMethod);
    });

    // Address change
    const changeButton = document.getElementById('change');
    const editAddressDiv = document.querySelector('.edit-address');

    changeButton.addEventListener('click', () => {
      editAddressDiv.style.display = editAddressDiv.style.display === 'none' ? 'flex' : 'none';
    });
  });
</script>
