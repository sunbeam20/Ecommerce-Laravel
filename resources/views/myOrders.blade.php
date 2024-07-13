@include('components.header')
<div class="myorders">
  <div class="nav-btn">
    <button class="status-button active" data-status="all">All</button>
    <button class="status-button" data-status="to_ship">To Ship</button>
    <button class="status-button" data-status="to_recieve">To Recieve</button>
    <button class="status-button" data-status="completed">Completed</button>
    <button class="status-button" data-status="cancel">Cancellation</button>
    <button class="status-button" data-status="refund">Return/Refund</button>
  </div>
  <div class="storage">
    <div class="order-list">
      <table class="myorderTable" style="width: 100%">
        <tr class="myordertr myordertrdatas2">
          <td class="myorderTd" style="width: 20%">Item(s)</td>
          <td class="myorderTd" style="width: 16%">Quantity</td>
          <td class="myorderTd" style="width: 16%">Total Price</td>
          <td class="myorderTd" style="width: 16%">Status</td>
          <td class="myorderTd" style="width: 16%">Payment Method</td>
          <td class="myorderTd" style="width: 16%">Actions</td>
        </tr>
        @foreach ($orders as $item)
          <tr class="myordertrdatas myordertrdatas2" data-status="{{ $item->status }}" style="width: 100%">
            <td class="myorderTd items" style="width: 20%">
              <img src="{{ asset($item['image']) }}" alt="{{ $item->name }}" class="hover-effect img" />{{ $item->name }}
            </td>
            <td class="myorderTd td" style="width: 16%">{{ $item->product_quantity }}</td>
            <td class="myorderTd td" style="width: 16%">{{ $item->product_price }}</td>
            <td class="myorderTd td" style="width: 16%">{{ $item->status }}</td>
            <td class="myorderTd td" style="width: 16%">{{ $item->payment_method }}</td>
            <td class="myorderTd td" style="width: 16%">
              @if ($item->status === 'to_ship')
                <form class="putForm" method="POST" action="/cancelOrder/{{ $item->id }}">
                  @csrf
                  @method('PUT')
                  <!-- Form fields -->
                  <select name="mySelect" onchange="toggleButton(this)">
                    <option value="to_ship" selected>Actions..</option>
                    <option value="cancel">Cancel Order</option>
                  </select>
                  <!-- Confirm button -->
                  <button type="submit" class="putConfirm" style="display: none;">Confirm</button>
                </form>
              @elseif ($item->status === 'to_recieve')
                <form class="putForm" method="POST"  action="/recieved/{{ $item->id }}">
                  @csrf
                  @method('PUT')
                  <!-- Form fields -->
                  <select name="mySelect" onchange="toggleButton(this)">
                    <option value="to_recieve" selected>Actions..</option>
                    <option value="completed">Recieved Order</option>
                  </select>
                  <!-- Confirm button -->
                  <button type="submit" class="putConfirm" style="display: none;">Confirm</button>
                </form>
              @elseif ($item->status === 'completed')
                <form class="putForm" method="POST" action="/return/{{ $item->id }}">
                  @csrf
                  @method('PUT')
                  <!-- Form fields -->
                  <select name="mySelect" onchange="toggleButton(this)">
                    <option value="completed" selected>Actions..</option>
                    <option value="pending_refund">Return/Refund</option>
                  </select>
                  <!-- Confirm button -->
                  <button type="submit" class="putConfirm" style="display: none;">Confirm</button>
                </form>
              @elseif ($item->status === 'refund' || $item->status === 'pending_refund')
                <form class="putForm" method="POST" action="/return/{{ $item->id }}">
                  @csrf
                  @method('PUT')
                  <!-- Form fields -->
                  <select name="mySelect" disabled>
                    <option value="to_ship">Actions..</option>
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
@include('components.footer')

<style>
  body {
    margin: 0px;
  }

  .myorders {
    margin: 0em 3em;
    height: auto;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    background-color: #f5f5f5;
    border-radius: 5px;
  }

  .storage {
    padding: 2em;
  }

  .nav-btn {
    display: block;
    margin-top: 1.5em;
    background-color: #f5f5f5;
    text-align: center;
  }

  .nav-btn button {
    padding: 0.5em;
    margin-right: 0.5em;
    font-size: 1.5em;
    background-color: #f5f5f5;
    border: none;
    outline: none;
    cursor: pointer;
    color: #000;
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
    background-color: #f5f5f5;
    font-size: 1.5em;
    padding: 0.5em;
    flex-direction: row;
    justify-content: space-evenly;
    align-items: center;
  }

  .order-container img {
    width: 2%;
    height: auto;
  }

  .search-input1 {
    border: none;
    margin-left: 2em;
    font-size: 0.8em;
    background-color: #f5f5f5;
    width: 50%;
  }

  .search-input1:focus {
    outline: none;
    border-color: transparent;
  }

  .search-button1 {
    background-color: rgb(222, 179, 51);
    border: none;
    cursor: pointer;
    margin-left: 1em;
    font-size: 1em;
    color: white;
    width: 5em;
    height: auto;
  }

  .search-button1:hover {
    transform: scale(1.1);
  }

  .reset-button {
    background-color: rgb(209, 118, 20);
    border: none;
    cursor: pointer;
    margin-left: 1em;
    font-size: 1em;
    color: white;
    width: 5em;
    height: auto;
  }

  .order-list {
    display: block;
    background-color: #f5f5f5;
    font-size: 1.5em;
  }

  .myorderTable tbody {
    display: flex;
    flex-wrap: nowrap;
    flex-direction: column;
  }

  .myordertr {
    background-color: rgb(201, 201, 201);
    border-radius: 5px;
    padding: 1em;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
  }

  .myordertrdatas2 {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    text-align: center;
    padding: 0.5em;
    border-bottom: 1px solid rgba(100, 100, 100, 0.103);
  }
  .items{
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .myoderTd {
    padding: 0.025em;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: space-around;
    justify-content: center;
  }

  .myorderTd img {
    width: 40%;
    height: auto;
    border-radius: 5px;
  }

  .myordertrdatas2 .td {
    display: flex;
    width: 100%;
    flex-direction: column;
    font-size: large;
    color: rgba(0, 0, 0, 0.692);
    justify-content: space-evenly;
    align-items: center;
  }

  .putConfirm {
    color: #000;
    border: 1px solid gray;
    width: auto;
    height: auto;
    border-radius: 5px;
    padding: 2px;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.status-button').click(function() {
    var selectedStatus = $(this).data('status');

    // Reset the active class on all status buttons
    $('.status-button').removeClass('active');

    // Add the active class to the clicked button
    $(this).addClass('active');

    // Toggle the visibility of order rows based on the selected status
    if (selectedStatus === 'all') {
      $('.myordertrdatas').show();
    } else if (selectedStatus === 'refund' || selectedStatus === 'pending_refund') {
      $('.myordertrdatas').hide();
      $('.myordertrdatas[data-status="refund"], .myordertrdatas[data-status="pending_refund"]').show();
    } else {
      $('.myordertrdatas').hide();
      $('.myordertrdatas[data-status="' + selectedStatus + '"]').show();
    }
  });
});

function toggleButton(selectElement) {
  var putConfirm = selectElement.parentNode.querySelector('.putConfirm');
  if (selectElement.value !== 'to_ship') {
    putConfirm.style.display = 'block';
  } else {
    putConfirm.style.display = 'none';
  }
}

</script>
