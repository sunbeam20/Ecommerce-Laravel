@include('components.sellerHeader')

<div class="container" id="overlay">
  <div class="sidebar">
    <ul>
      <li class="head-lists">
        <span onclick="toggleDisplay('shipment-list', 'shipment-arrow')">
          <img class="navImg" src="{{ asset('images/shipment.png') }}" />
          Shipment
          <img id="shipment-arrow" class="navImg sideimg" src="{{ asset('images/left.png') }}" />

        </span>
        <ul id="shipment-list" style="display: none;">
          <li class="lists shipment" data-status="to_recieve">My Shipment</li>
          <li class="lists shipment" data-status="to_ship">Mass Shipping</li>
        </ul>
      </li>
      <li class="head-lists">
        <span onclick="toggleDisplay('order-list', 'order-arrow')">
          <img class="navImg" src="{{ asset('images/order.png') }}" />
          Orders
          <img id="order-arrow" class="navImg sideimg" src="{{ asset('images/left.png') }}" />
        </span>
        <ul id="order-list" style="display: none;">
          <li class="lists orders" data-status="all">My Orders</li>
          <li class="lists orders" data-status="refund">Return/Refund</li>
          <li class="lists orders" data-status="cancel">Cancellation</li>
        </ul>
      </li>
      <li class="head-lists">
        <span onclick="toggleDisplay('product-list', 'product-arrow')">
          <img class="navImg" src="{{ asset('images/product.png') }}" />
          Product
          <img id="product-arrow" class="navImg sideimg" src="{{ asset('images/left.png') }}" />
        </span>
        <ul id="product-list" style="display: none;">
          <li class="lists products">My Products</li>
          <li class="lists newproducts">Add New Products</li>
        </ul>
      </li>
      <li class="lists settingsli head-lists ">
        <span><img class="navImg" src="{{ asset('images/settings.png') }}" /> Settings</span>
      </li>
    </ul>
  </div>
  {{-- Dashboard --}}
  <div class="dashBoard rSide">
    <div class="toDo">
      <h2>To Do lists</h2>
      <p>Things you need to deal with</p>
      <table class="dTable" style="width: 100%">
        <tbody class="dtBody">
          <tr class="dTr">
            <td class="border-right dTd">
              <p class="p" id="to-ship" data-status="to_ship">0</p>
              <p>To-Ship</p>
            </td>
            <td class="border-right dTd">
              <p class="p" id="to-recieve">0</p>
              <p>Shipped</p>
            </td>
            <td class="border-right dTd">
              <p class="p" id="cancel">0</p>
              <p>Cancelled</p>
            </td>
            <td class=" dTd">
              <p class="p" id="refund">0</p>
              <p>Return/Refund</p>
            </td>
          </tr>
          <tr class="dTr">
            <td class="border-right dTd">
              <p class="p" id="cod">0</p>
              <p>Unpaid</p>
            </td>
            <td class="border-right dTd">
              <p class="p" id="completed">0</p>
              <p>Completed Orders</p>
            </td>
            <td class="border-right dTd">
              <p class="p" id="sold-out-products-count">0</p>
              <p>Sold Out Products</p>
            </td>
            <td class="dTd">
              <p class="p" id="pending-cancellation-2-count">0</p>
              <p>Pending Cancellation</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  {{-- My Products --}}
  <div class="myproducts rSide">
    <div class="nav-btn">
    </div>
    <div class="storage">
      <div class="order-container">
        <span class="span">Product Name</span>
        <input class="search-input" type="text" placeholder="Enter Name" />
        <button class="search-button" type="submit">Search</button>
        <button class="reset-button" type="submit">Reset</button>
      </div>
      <div class="order-list">
        <table class="myproductsTable" style="width: 100%">
          <tr class="myproducttr myproductstrdatas" style="width: 100%">
            <td class="myproductTd " style="width: 20%">Item(s)</td>
            <td class="myproductTd " style="width: 16%">Stock</td>
            <td class="myproductTd " style="width: 16%">Total Sold</td>
            <td class="myproductTd" style="width: 16%">Total Price</td>
            <td class="myproductTd" style="width: 16%">Description</td>
            <td class="myproductTd" style="width: 16%">Category</td>
            <td class="myproductTd" style="width: 16%">Actions</td>
          </tr>

          @foreach ($topSold as $item)
            <tr class="myproductstrdatas" style="width: 100%">
              <td class="myproductTd name" style="width: 20%">
                <img src="{{ asset($item->image) }}" alt="{{ $item->name }}"
                  class="hover-effect img" />{{ $item->name }}
              </td>
              <td class="myproductTd td" style="width: 16%">{{ $item->stock }}</td>
              <td class="myproductTd td" style="width: 16%">{{ $item->total_quantity_sold }}</td>
              <td class="myproductTd td" style="width: 16%">{{ $item->price }}</td>
              <td class="myproductTd td" style="width: 16%">{{ Str::limit($item->description, 100) }}</td>
              @foreach ($categories as $category)
                @if ($category->id === $item->category_id)
                  <td class="myproductTd td" style="width: 16%">{{ $category->name }}</td>
                  <!-- Display other category details as needed -->
                @endif
              @endforeach
              <td class="myproductTd td" style="width: 16%">
                <button class="update" onclick="toggleForm({{ $item }})">Update</button>
                <form action="/deleteProduct/{{ $item->id }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="update"
                    onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>

              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

  {{-- AddProduct  --}}
  <form class="add-product rSide" action="/products" method="POST" enctype="multipart/form-data">
    @csrf
    <h2>Add New Products</h2>
    <div class="formdiv">
      <label for="images">Product images</label>
      <input type="file" name="images" id="images" />
    </div>
    <div class="formdiv">
      <label for="product-category">Product Category</label>
      <select name="mySelect">
        <option value="">Select a category</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="formdiv">
      <label for="product-name">Product name</label>
      <input type="text" name="name" />
    </div>
    <div class="details ">
      <label for="description">Product details</label>
      <textarea rows="5" name="description"></textarea>
    </div>
    <div class="formdiv">
      <label for="product-quantity">Product Quantity</label>
      <input type="number" name="quantity" min="1" max="100" step="1" />
    </div>
    <div class="formdiv">
      <label for="original-price">Price</label>
      <input type="number" step="0.01" min="0" name="price" />
    </div>
    <div class="formdiv">
      <label for="brand">Brand Name</label>
      <input type="text" name="brand" />
    </div>
    <button class="cancel" type="reset">Cancel</button>
    <button class="upload" type="submit">Upload</button>
  </form>

  {{-- My Shipment --}}
  <div class="myshipment rSide" id="to-ship-div">
    <div class="nav-btn">
      <button class="status-button" data-status="to_ship">To Ship</button>
      <button class="status-button" data-status="to_recieve">Shipped</button>
      <button class="status-button" data-status="completed">Completed</button>
    </div>
    <div class="storage">
      <div class="order-container">
        <span class="span">Order ID</span>
        <input class="search-input" type="text" placeholder="Enter Order ID" />
        <button class="search-button" type="submit">Search</button>
        <button class="reset-button" type="submit">Reset</button>
      </div>
      <div class="order-list">
        <table class="myshipTable" style="width: 100%">
          <tr class="myshiptr myshiptrdatas2" style="width: 100%">
            <td class="myshipTd" style="width: 20%">Item(s)</td>
            <td class="myshipTd" style="width: 16%">Quantity</td>
            <td class="myshipTd" style="width: 16%">User Name</td>
            <td class="myshipTd" style="width: 16%">Delivery Address</td>
            <td class="myshipTd" style="width: 16%">Total Price</td>
            <td class="myshipTd" style="width: 16%">Status</td>
            <td class="myshipTd" style="width: 16%">Payment Method</td>
            <td class="myshipTd" style="width: 16%">Actions</td>
          </tr>

          @foreach ($orders as $item)
            <tr class="myshiptrdatas myshiptrdatas2" data-status="{{ $item->status }}" style="width: 100%">
              <td class="myshipTd" style="width: 20%">
                <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_name }}"
                  class="hover-effect img" />{{ $item->product_name }}
              </td>
              <td class="myshipTd td" style="width: 16%">{{ $item->product_quantity }}</td>
              <td class="myshipTd td" style="width: 16%">{{ $item->user_name }}</td>
              <td class="myshipTd td" style="width: 16%">
                {{ $item->user_address }},{{ $item->user_city }},{{ $item->user_state }},{{ $item->user_zip }}</td>
              <td class="myshipTd td" style="width: 16%">{{ $item->product_price }}</td>
              <td class="myshipTd td" style="width: 16%">{{ $item->status }}</td>
              <td class="myshipTd td" style="width: 16%">{{ $item->payment_method }}</td>
              <td class="myshipTd td" style="width: 16%">
                @if ($item->status === 'to_ship')
                  <form class="putForm" method="POST" action="/productShipped/{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    <!-- Form fields -->
                    <select name="mySelect" onchange="toggleButton(this)">
                      <option value="to_ship" selected>Actions..</option>
                      <option value="shipped">Shipped</option>
                    </select>
                    <!-- Confirm button -->
                    <button type="submit" class="putConfirm" style="display: none;">Confirm</button>
                  </form>
                @else
                  <select name="mySelect" disabled>
                    <option value="to_ship">Actions..</option>
                  </select>
                @endif
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

  {{-- My Orders --}}
  <div class="myorders rSide">
    <div class="nav-btn">
      <button class="status-button active" data-status="all">All</button>
      <button class="status-button" data-status="to_ship">To Ship</button>
      <button class="status-button" data-status="to_recieve">Shipped</button>
      <button class="status-button" data-status="completed">Completed</button>
      <button class="status-button" data-status="cancel">Cancellation</button>
      <button class="status-button" data-status="refund">Return/Refund</button>
    </div>
    <div class="storage">
      <div class="order-container">
        <span class="span">Order ID</span>
        <input class="search-input" type="text" placeholder="Enter Order ID" />
        <button class="search-button" type="submit">Search</button>
        <button class="reset-button" type="submit">Reset</button>
      </div>
      <div class="order-list">
        <table class="myorderTable" style="width: 100%">
          <tr class="myordertr myordertrdatas2">
            <td class="myorderTd" style="width: 20%">Item(s)</td>
            <td class="myorderTd" style="width: 16%">Quantity</td>
            <td class="myshipTd" style="width: 16%">User Name</td>
            <td class="myshipTd" style="width: 16%">Delivery Address</td>
            <td class="myorderTd" style="width: 16%">Total Price</td>
            <td class="myorderTd" style="width: 16%">Status</td>
            <td class="myorderTd" style="width: 16%">Payment Method</td>
            <td class="myorderTd" style="width: 16%">Actions</td>
          </tr>
          @foreach ($orders as $item)
            <tr class="myordertrdatas myordertrdatas2" data-status="{{ $item->status }}"
              data-payment="{{ $item->payment_method }}" style="width: 100%">
              <td class="myorderTd" style="width: 20%">
                <img src="{{ asset($item->product_image) }}" alt="{{ asset($item->product_name) }}"
                  class="hover-effect img" />{{ $item->product_name }}
              </td>
              <td class="myorderTd td" style="width: 16%">{{ $item->product_quantity }}</td>
              <td class="myshipTd td" style="width: 16%">{{ $item->user_name }}</td>
              <td class="myshipTd td" style="width: 16%">
                {{ $item->user_address }},{{ $item->user_city }},{{ $item->user_state }},{{ $item->user_zip }}</td>
              <td class="myorderTd td" style="width: 16%">{{ $item->product_price }}</td>
              <td class="myorderTd td" style="width: 16%">{{ $item->status }}</td>
              <td class="myorderTd td" style="width: 16%">{{ $item->payment_method }}</td>
              <td class="myorderTd td" style="width: 16%">
                @if ($item->status === 'to_ship')
                  <form class="putForm" method="POST" action="/productShipped/{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    <!-- Form fields -->
                    <select name="mySelect" onchange="toggleButton(this)">
                      <option value="to_ship" selected>Actions..</option>
                      <option value="shipped">Shipped</option>
                    </select>
                    <!-- Confirm button -->
                    <button type="submit" class="putConfirm" style="display: none;">Confirm</button>
                  </form>
                @elseif ($item->status === 'pending_refund')
                  <form class="putForm" method="POST" action="/productRefund/{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    <!-- Form fields -->
                    <select name="mySelect" onchange="toggleButton(this)">
                      <option value="pending_refund" selected>Actions..</option>
                      <option value="refund">Approve</option>
                      <option value="completed">Cancel</option>
                    </select>
                    <!-- Confirm button -->
                    <button type="submit" class="putConfirm" style="display: none;">Confirm</button>
                  </form>
                @else
                  <select name="mySelect" disabled>
                    <option value="to_ship">Actions..</option>
                  </select>
                @endif
              </td>
            </tr>
          @endforeach

        </table>
      </div>
    </div>
  </div>

  {{-- Settings --}}
  <div class="settings rSide">
    <div class="head">
      <h1>Account</h1>
      <p>Manage your account</p>
    </div>
    <div class="body">
      <div class="div">
        <img class="simg" src="{{ asset('images/seller.png') }}" />
        <label class="slabel items">My Profile</label>
        <p class="items">{{ Auth::guard('seller')->user()->name }}</p>
      </div>
      <form action="/seller-update-profile" method="POST" class="nestedForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="nestedDiv">
          <div class="nestedHead">
            <label class="slabel">Username</label>
            <input type="text" name="name" value="{{ Auth::guard('seller')->user()->name }}" />
          </div>
          <button class="nestedButtons">Save</button>
        </div>
      </form>
      <div class="div btop">
        <img class="simg" src="{{ asset('images/email.png') }}" />
        <label class="slabel items">Email</label>
        <p class="items">{{ Auth::guard('seller')->user()->email }}</p>
      </div>
      <form action="/seller-update-email" method="POST" class="nestedForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="nestedDiv">
          <div class="nestedHead">
            <label class="slabel">Email</label>
            <input type="text" name="email" value="{{ Auth::guard('seller')->user()->email }}" />
          </div>

          <button class="nestedButtons">Save</button>

        </div>
      </form>
    </div>
  </div>

</div>
{{-- Update Product --}}
<form class="update-product rSide" action="/products" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <h2>Update Products</h2>
  <input type="hidden" name="id" id="id" value="">
  <div class="formdiv">
    <label for="images">Product images</label>
    <input type="file" name="images" id="productImage" />
  </div>
  <div class="formdiv">
    <label for="product-category">Product Category</label>
    <select name="mySelect">
      <option value="">Select a category</option>
      @foreach ($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="formdiv">
    <label for="product-name">Product name</label>
    <input type="text" name="name" id="productName" value="" />
  </div>
  <div class="details ">
    <label for="description">Product details</label>
    <textarea rows="5" name="description" id="productDescription" value=""></textarea>
  </div>
  <div class="formdiv">
    <label for="product-quantity">Product Quantity</label>
    <input type="number" name="quantity" min="1" max="100" step="1" id="productQuantity"
      value="" />
  </div>
  <div class="formdiv">
    <label for="original-price">Price</label>
    <input type="number" step="0.01" min="0" name="price" id="productPrice" value="" />
  </div>
  <div class="formdiv">
    <label for="brand">Brand Name</label>
    <input type="text" name="brand" id="productBrand" value="" />
  </div>
  <button class="cancel" type="reset">Cancel</button>
  <button class="upload" type="submit">Upload</button>
</form>
<style scoped>
  .update {
    color: rgb(222, 179, 51);
    background-color: #463300e3;
    font-size: 1em;
    padding: 5px;
    border-radius: 5px;
  }

  body {
    margin: 0px;
    background-color: #f5f5f5;
  }

  .putForm {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    margin-block-end: 0em;
  }

  .container {
    display: flex;
  }

  .sidebar {
    background-color: rgba(70, 51, 0, 0.89);
    color: rgb(233, 211, 145);
    font-weight: bold;
    /* Set your desired background color */
    margin-right: 1.25em;
    margin-top: 3vh;
    padding-top: 1.5vh;
    padding-left: 1vh;
    /* Converted margin value */
    min-height: 92vh;
    max-height: 92vh;
    /* Set the maximum height for scrolling */
    overflow-y: auto;
    overflow-x: hidden;
    /* Enable vertical scrolling if content overflows */
    border-radius: 5px;
    /* Converted border-radius value */
    box-shadow: 0 0.125em 0.25em rgba(70, 51, 0, 0.5);
    /* Converted box-shadow value */
    /* Set the desired width in pixels or em units */
    position: fixed;
  }

  li .sideimg {
    width: 0.5em;
    height: auto;
    align-items: center;
    float: right;
    margin: 0.25em 3em 0em 1em;
  }

  .navImg {
    width: 1em;
    /* Converted width value */
    height: auto;
    margin-right: 0.1em;
    /* Converted margin-right value */
    vertical-align: middle;
  }

  span {
    font-size: 1.5em;
  }

  .span {
    font-size: 1em;
  }

  /* Style for the links and list items */
  .sidebar ul {
    list-style-type: none;
    padding: 0em;
    margin-top: 1em;
    margin-right: 1em;
  }

  li {
    margin: 1em 0em 0.5em 2em;
    /* Converted padding value */
    font-size: 1.1em;
  }

  .head-lists {
    margin-bottom: 2em;
  }

  .sidebar a {
    text-decoration: none;
    color: #333;
    /* Set the color for the links */
  }

  .sidebar .lists:hover {
    color: rgb(255, 241, 197));
    /* Set the color when links are hovered */
    cursor: pointer;
    transform: scale(1.05);
    transition: transform 0.1s ease;
    font-weight: bolder;
  }

  .head-lists:hover {
    cursor: pointer;
  }

  /* Dashboard Styles */
  .dashBoard {
    width: 45%;
    height: 80%;
    margin: 4vh 5em 5em 30vw;
    padding: 2em 3em 3em 0em;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    background-color: #ffffff;
    border-radius: 5px;
  }

  .toDo {
    display: block;
    margin-left: 2em;
  }

  .dTable {
    display: flex;
  }

  .dtBody {
    margin: 0em 1em;
  }

  .dTr {
    display: flex;
    justify-content: space-evenly;
    margin-top: 1em;
  }

  .dTable,
  .dtBody,
  .dTr {
    width: 100%;
  }

  .dTd {
    display: flex;
    /*background-color: aliceblue;*/
    flex-direction: column;
    align-items: center;
    width: 25%;
    border-radius: 5px;
  }

  .p {
    font-size: large;
    font-weight: bold;
  }

  .dTd:hover {
    background-color: #f0f0f0;
    cursor: pointer;
  }

  /* Border styles */
  .dTd.border-right {
    /*
  border-right: 1px solid rgba(160, 160, 160, 0.5);*/
    border-right-style: inset;
  }

  /* ***************************************************************************************************************** */
  /*********************************************** Add Product Styles ***********************************************/
  .add-product {
    width: 50vw;
    height: 80%;
    margin: 4vh 5em 5em 30vw;
    padding: 2em 3em 3em 0em;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    background-color: #ffffff;
    text-align: right;
    border-radius: 5px;
    display: none;
  }

  .update-product {
    width: 50vw;
    height: 80%;
    margin: 4vh 5em 5em 30vw;
    padding: 2em 3em 3em 0em;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    background-color: #ffffff;
    text-align: right;
    border-radius: 5px;
    position: fixed;
    top: 3em;
    display: none;
    z-index: 999;
    opacity: 1;
  }

  .overlay {
    /* Existing styles for the overlay */
    /* Add the following styles */
    opacity: 0.5;
    /* Initial opacity set to 0 */
    transition: opacity 0.3s ease-in-out;
    /* Add a transition effect for smooth opacity change */
  }

  .overlay-active {
    /* Remove the overlay styles */
    opacity: 0.5;
    transition: none;
  }

  h2 {
    text-align: left;
    margin-left: 3em;
  }

  .formdiv {
    margin: 5px;
    font-size: 1.5em;
    color: #686868;
  }

  .details {
    display: flex;
    align-items: center;
    flex-direction: row;
    justify-content: flex-end;
    font-size: 1.5em;
    color: #686868;
  }

  .details textarea {
    resize: vertical;
  }

  .add-product input,
  .update-product input,
  .add-product select,
  .update-product select,
  .add-product textarea,
  .update-product textarea {
    font-size: large;
    font-weight: bold;
    width: 60%;
    margin-left: 5em;
    margin-top: 1em;
    padding: 0.5em;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .add-product input:focus,
  .update-product input:focus,
  .add-product textarea:focus,
  .update-product textarea:focus {
    outline: none;
    border-color: #5b9dd9;
    box-shadow: 0 0 0 3px rgba(91, 157, 217, 0.2);
  }

  .upload,
  .cancel {
    padding: 0.5em;
    margin: 2em 0em 0em 0.5em;
    border-radius: 5px;
    border: 0.5px solid grey;
    font-weight: bold;
    font-size: large;
    color: white;
  }

  .upload {
    background-color: rgb(222, 179, 51);
  }

  .cancel {
    background-color: #483912e3;
  }

  button:hover {
    cursor: pointer;
  }

  .upload:hover {
    background-color: rgb(243, 196, 56);
    color: black;
  }

  .cancel:hover {
    background-color: #c49f4be3;
    color: black;
  }

  /* *************************************************************************************************************************** */
  /**************************************** My Shipment/My Orders/MyProducts Styles ********************************************/
  .myshipment,
  .myorders,
  .myproducts {
    display: none;
    width: 74vw;
    margin-left: 20vw;
    height: auto;
    flex-direction: column;
    align-items: stretch;
    justify-content: flex-start;
    margin-top: 3vh;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    background-color: #ffffff;
    border-radius: 5px;
  }

  .nav-btn {
    display: block;
    margin-top: 1.5em;
    background-color: #ffffff;
    text-align: center;
  }

  .nav-btn button {
    padding: 0.5em;
    margin-right: 0.5em;
    font-size: 1.5em;
    background-color: #ffffff;
    border: none;
    outline: none;
    cursor: pointer;
    border-radius: 5px;
  }

  .nav-btn button:hover {
    transform: scale(1.05);
    transition: transform 0.1s ease;
  }

  .status-button.active {
    background-color: rgba(70, 51, 0, 0.89);
    /* Replace with your desired background color */
    color: rgb(233, 211, 145);
    /* Replace with your desired text color */
  }

  .order-container {
    display: flex;
    background-color: #ffffff;
    font-size: 1.5em;
    padding: 0.5em;
    flex-direction: row;
    justify-content: space-evenly;
    align-items: center;
  }

  .order-container img {
    width: 2%;
  }

  .search-input {
    border: none;
    margin-left: 2em;
    font-size: 0.8em;
    background-color: #ffffff;
    width: 50%;
  }

  .search-input:focus {
    outline: none;
    border-color: transparent;
  }

  .search-button {
    background-color: rgb(222, 179, 51);
    border: none;
    cursor: pointer;
    margin-left: 1em;
    font-size: 1em;
    color: white;
  }

  .search-button:hover {
    transform: scale(1.1);
  }

  .reset-button {
    background-color: rgb(209, 118, 20);
    border: none;
    cursor: pointer;
    margin-left: 1em;
    font-size: 1em;
    color: white;
  }

  .order-list {
    display: block;
    background-color: #ffffff;
    font-size: 1.5em;
  }

  .myshipTable,
  .myorderTable,
  .myproductsTable {
    display: block;
    padding: 1em;
  }

  .myshipTable tbody,
  .myproductsTable tbody {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    align-items: center;
  }

  .myorderTable tbody {
    display: flex;
    flex-wrap: nowrap;
    flex-direction: column;
  }

  .myshiptr,
  .myordertr,
  .myproducttr {
    background-color: rgb(255, 255, 255);
    border-radius: 5px;
    padding: 1em;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    font-size: large;
    font-weight: bold;
  }

  .myshiptrdatas2,
  .myordertrdatas2,
  .myproductstrdatas {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    text-align: center;
    padding: 0.5em;
    border-bottom: 1px solid rgba(100, 100, 100, 0.103);
  }

  .myshipTd,
  .myorderTd,
  .myproductTd {
    padding: 0.025em;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: space-around;
    justify-content: center;
  }

  .myshipTd img,
  .myorderTd img,
  .myproductTd img {
    width: 60%;
  }

  .myshiptrdatas2 .td,
  .myordertrdatas2 .td,
  .myproductstrdatas .td {
    display: flex;
    width: 100%;
    flex-direction: column;
    font-size: large;
    color: rgba(0, 0, 0, 0.692);
    justify-content: space-evenly;
    align-items: center;
  }

  /* Settings Style */
  .settings {
    display: none;
    width: 60vw;
    margin-left: 25vw;
    height: auto;
    flex-direction: column;
    align-items: stretch;
    justify-content: flex-start;
    margin-top: 3vh;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    background-color: #ffffff;
    border-radius: 5px;
    padding: 2em;
  }

  .head {
    border-bottom: 0.025em solid rgba(0, 0, 0, 0.247);
    padding: 1em 1em 2em 1em;
  }

  .head h1 {
    margin-left: 1em;
  }

  .head p {
    margin-left: 2em;
  }

  .body {
    margin: 3em 0em 1em 4em;
  }

  .div {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: center;
    padding: 1em;
    margin: 1em;
  }

  .simg {
    width: 3%;
  }

  .slabel {
    font-size: larger;
    font-weight: bold;
  }

  .nestedHead .slabel {
    font-weight: normal;
  }

  .items {
    width: 25%;
  }

  .buttons {
    width: 7%;
    padding: 0.5em;
    border: 0.5px solid gray;
    border-radius: 5px;
    background-color: #463300e3;
    color: rgb(222, 179, 51);
    font-size: 1em;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
  }

  .buttons:hover,
  .nestedButtons:hover {
    transform: scale(1.05);
    transition: transform 0.1s ease;
  }

  .nestedDiv {
    background-color: #f3f3f3;
    border-radius: 5px;
    padding: 1em;
    margin: 1em 12em;
    align-items: center;
  }

  .show {
    display: flex;
  }

  .nestedHead {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin: 1em 3em;
  }

  .nestedHead label {
    padding: 1em;
  }

  .nestedHead input {
    padding: 0.5em;
  }

  .nestedButtons {
    display: block;
    margin-left: 2em;
    background-color: #463300e3;
    color: rgb(222, 179, 51);
    border-radius: 5px;
    font-size: 1em;
    font-weight: bold;
    border-radius: 5px;
  }

  .btop {
    border-top: 0.1px solid gray;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#to-ship").on("click", function() {
      // Get a reference to the div
      var toShipDiv = $("#to-ship-div");

      // Toggle the visibility of the div using jQuery's toggle() method
      toShipDiv.toggle();
    });
  });
  function toggleDisplay(elementId, arrowId) {
    var element = document.getElementById(elementId);
    var arrowImg = document.getElementById(arrowId);

    if (element.style.display === "none") {
      element.style.display = "block";
      arrowImg.src = "{{ asset('images/down.png') }}";
    } else {
      element.style.display = "none";
      arrowImg.src = "{{ asset('images/left.png') }}";
    }
  }

  // Get all the <li> elements with class "lists"
  var liElements = document.querySelectorAll('.lists');

  // Add event listeners to each <li> element
  liElements.forEach(function(li) {
    li.addEventListener('click', function() {
      // Get the class of the clicked <li> element
      var clickedClass = this.classList[1];
      console.log(clickedClass);
      // Get all the .rSide divs
      var rSideDivs = document.querySelectorAll('.rSide');
      // Hide all .rSide divs
      rSideDivs.forEach(function(div) {
        div.style.display = 'none';
        console.log(div);
      });

      if (clickedClass == 'newproducts') {
        var x = document.querySelector('.add-product');
        console.log(x);
        x.style.display = 'block';
      } else if (clickedClass == 'updateproducts') {
        var x = document.querySelector('.update-product');
        console.log(x);
        x.style.display = 'block';
      } else if (clickedClass == 'shipment') {
        var x = document.querySelector('.myshipment');
        console.log(x);
        x.style.display = 'flex';
      } else if (clickedClass == 'orders') {
        var x = document.querySelector('.myorders');
        console.log(x);
        x.style.display = 'flex';
      } else if (clickedClass == 'products') {
        var x = document.querySelector('.myproducts');
        console.log(x);
        x.style.display = 'flex';
      } else if (clickedClass == 'settingsli') {
        var x = document.querySelector('.settings');
        console.log(x);
        x.style.display = 'flex';
      } else {
        var x = document.querySelector('.dashBoard');
        console.log(x);
        x.style.display = 'block';
      }
    });
  });

  // my orders frontend
  $(document).ready(function() {
    $('.status-button, .lists.orders, .lists.shipment').click(function() {
      var selectedStatus = $(this).data('status');

      // Reset the active class on all status buttons
      $('.status-button').removeClass('active');

      // Add the active class to the clicked button
      $(this).addClass('active');

      // Toggle the visibility of order rows based on the selected status
      if (selectedStatus === 'all') {
        $('.myordertrdatas, .myshiptrdatas').show();
      } else if (selectedStatus === 'refund' || selectedStatus === 'pending_refund') {
        $('.myordertrdatas').hide();
        $('.myordertrdatas[data-status="refund"], .myordertrdatas[data-status="pending_refund"]').show();
      } else {
        $('.myordertrdatas').hide();
        $('.myshiptrdatas').hide();
        $('.myordertrdatas[data-status="' + selectedStatus + '"]').show();
        $('.myshiptrdatas[data-status="' + selectedStatus + '"]').show();
      }
    });
  });


  function toggleForm(item) {
    var form = document.querySelector('.update-product');
    var overlay = document.getElementById('overlay');
    var productID = document.getElementById('id');
    var productNameInput = document.getElementById('productName');
    var productPriceInput = document.getElementById('productPrice');
    var productDescriptionInput = document.getElementById('productDescription');
    var productQuantityInput = document.getElementById('productQuantity');
    var productBrandInput = document.getElementById('productBrand');
    console.log(item);
    if (form.style.display === 'none') {
      form.style.display = 'block';
      overlay.classList.add('overlay-active');
      productID.value = item.id;
      productNameInput.value = item.name; // Set the value of the productName input field
      productDescriptionInput.value = item.description;
      productQuantityInput.value = item.stock;
      productBrandInput.value = item.brand;
      productPriceInput.value = item.price; // Set the value of the productPrice input field
    } else {
      form.style.display = 'none';
      overlay.classList.remove('overlay-active');
      productID.value = ''; // Reset the value of the productName input field
      productNameInput.value = ''; // Reset the value of the productPrice input field
      productDescriptionInput.value = '';
      productQuantityInput.value = '';
      productPriceInput.value = '';
    }
  }
  //display confirm button for update ship status
  function toggleButton(selectElement) {
    var putConfirm = selectElement.parentNode.querySelector('.putConfirm');
    if (selectElement.value !== 'to_ship') {
      putConfirm.style.display = 'block';
    } else if (selectElement.value !== 'to_ship') {
      putConfirm.style.display = 'block';
    } else {
      putConfirm.style.display = 'none';
    }
  }

  // color
  $(document).ready(function() {
    $('.status-button').click(function() {
      // Remove active class from all status buttons
      $('.status-button').removeClass('active');

      // Add active class to the clicked button
      $(this).addClass('active');
    });
  });

  //settings
  $(document).ready(function() {
      // Handle click on "Edit" button using event delegation
      $(document).on("click", ".buttons", function() {
        var nestedDiv = $(this).siblings(".nestedForm");
        nestedDiv.toggle();
      });
    });

  //count products by status
  $(document).ready(function() {
    // Count the number of products based on data-status
    var toShipCount = 0;
    var toRecieveCount = 0;
    var completedCount = 0;
    var cancelledCount = 0;
    var refundCount = 0;

    // Count the number of products based on payment-method
    var codCount = 0;
    var bankCount = 0;

    $('.myordertrdatas').each(function() {
      var status = $(this).data('status');
      var payment = $(this).data('payment');
      //status count
      if (status === 'to_ship') {
        toShipCount++;
      }
      if (status === 'to_recieve') {
        toRecieveCount++;
      }
      if (status === 'completed') {
        completedCount++;
      }
      if (status === 'cancel') {
        cancelledCount++;
      }
      if (status === 'refund') {
        refundCount++;
      }
      //pyment count
      if (payment === 'cod') {
        codCount++;
      }
      if (payment === 'bank') {
        bankCount++;
      }
    });

    // Update the count in the to-ship <p> element
    $('#to-ship').text(toShipCount);
    $('#to-recieve').text(toRecieveCount);
    $('#completed').text(completedCount);
    $('#cancel').text(cancelledCount);
    $('#refund').text(refundCount);
    $('#cod').text(codCount);
  });
</script>
