<header class="sticky-header">
  <nav>
    <div class="navleft">
      <a href="/"><img src="{{ asset('images/logo.png') }}" alt=""></a>

    </div>
    <div class="navcenter">
      <div>
        <form class="search-form" action="/search" method="GET">
          <input class="search-input" type="text" placeholder="Search..." name="query" />
          <button class="search-button" type="submit">
            <img src="{{ asset('images/search.png') }}" />
          </button>
        </form>
      </div>
    </div>
    <div class="navright">
      <div>
        @if (Auth::check())
          <form action="/SellerLogin" method="post">
            @csrf
            <button type="submit">Seller Hub</button>
          </form>
        @else
          <a href="/SellerLogin"><button>Seller Hub</button></a>
        @endif
      </div>
      <form action="/CartPage" method="POST">
        @csrf
        @auth
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        @endauth
        <button type="submit">
          <img src="{{ asset('images/shopping-bag.png') }}" class="hover-effect" />
        </button>
      </form>
      @if (session('message'))
        <div class="notification-menu {{ session('message') ? 'show' : '' }}">
          <p>{{ session('message') }}</p>
        </div>
      @endif
      <div class="dropdown">
        @if (Auth::check())
        <button class="dropdown-toggle">
          <img src="{{ asset('images/man.png') }}" alt="image" class="hover-effect" />
        </button>
        @else
        <button class="dropdown-toggle">
          <img src="{{ asset('images/user.png') }}" alt="image" class="hover-effect" />
        </button>
        @endif
        <div class="dropdown-menu">
          @if (Auth::check())
            <a href="customerProfile">
              <p class="dropdown-item">My Profile</p>
            </a>
            <a href="{{ 'MyOrders/' . Auth::user()->id }}">
              <p class="dropdown-item">My Orders</p>
            </a>
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
          @else
            <a href="/Login">
              <p class="dropdown-item">Login</p>
            </a>
            <a href="/Signup">
              <p class="dropdown-item">SignUp</p>
            </a>
          @endif
        </div>
      </div>
    </div>
  </nav>
</header>

<style>
  .sticky-header {
    position: sticky;
    z-index: 9999;
    top: 0;
  }

  nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #463300e3;
    padding-right: 2em;
  }

  .navleft {
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }

  .navcenter {
    display: flex;
    justify-content: center;
    align-items: center;
    padding-left: 5em;
  }

  .navright {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
  }

  form {
    display: block;
    margin-top: 0em;
    margin-block-end: 0em;
  }

  div img {
    border-radius: 2em;
    width: auto;
    height: 4em;
    cursor: pointer;
  }

  button {
    width: auto;
    height: 3em;
    background-color: #46330000;
    font-size: 1.2em;
    color: white;
    border: none;
    cursor: pointer;
  }

  button {
    color: white;
    width: auto;
    height: 3em;
    background-color: #46330000;
    font-size: 1.5em;
    border: none;
  }

  img {
    border-radius: 1em;
    width: auto;
    height: 1.7em;
    cursor: pointer;
  }

  .dropdown-toggle {
    color: white;
    border: none;
    cursor: pointer;
    outline: none;
  }

  .dropdown-menu {
    width: 10em;
    right: 2%;
    margin-top: 0.05em;
    position: absolute;
    z-index: 1;
    border: 0.1em solid rgb(88, 88, 88);
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0em 0.5em 1em 0em rgba(0, 0, 0, 0.2);
  }

  .notification-menu {
    width: 10em;
    padding: 5px;
    right: 5%;
    margin-top: 8em;
    position: absolute;
    z-index: 1;
    border: 0.1em solid rgb(88, 88, 88);
    border-radius: 5px;
    background-color: #bb7409;
    color: white;
    box-shadow: 0em 0.5em 1em 0em rgba(0, 0, 0, 0.2);
  }

  .notification-menu {
    opacity: 0;
    transition: opacity 0.5s;
  }

  .notification-menu.show {
    opacity: 1;
  }

  .dropdown-menu.show {
    display: block;
  }

  .link {
    text-decoration: none;
    font-weight: bold;
  }

  .dropdown-item {
    display: block;
    padding: 1em 1em;
    margin: 0.5em 0.5em;
    color: #333;
    text-decoration: none;
  }

  .dropdown-item:hover,
  .dropdown-item:focus {
    background-color: #ebebeb;
    cursor: pointer;
    border-radius: 5px;
  }

  button {
    width: auto;
    height: 3em;
    background-color: #46330000;
    font-size: 1.5em;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-toggle {
    color: white;
    border: none;
    cursor: pointer;
    outline: none;
  }

  .dropdown-toggle.active {
    background-color: #eaac0050;
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    z-index: 1;
    border-top: 0.1em solid rgb(88, 88, 88);
    background-color: #fff;
    box-shadow: 0em 0.5em 1em 0em rgba(0, 0, 0, 0.2);
  }

  .dropdown:hover .dropdown-menu {
    display: block;
  }

  .dropdown-menu.show {
    display: block;
  }

  .dropdown-item {
    display: block;
    padding: 1em 2em;
    color: #333;
    text-decoration: none;
  }

  .dropdown-item:hover,
  .dropdown-item:focus {
    background-color: #f5f5f5;
  }

  button img {
    width: auto;
    height: 2em;
    cursor: pointer;
  }

  .search-form {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    background-color: #f2f2f2;
    border-radius: 10px;
    margin-block-end: 0em;
    padding: 0em 1em;
  }

  .search-input {
    border: none;
    background-color: transparent;
    font-size: 1em;
    flex: 1;

  }

  .search-input:focus {
    outline: none;
    border-color: transparent;
  }

  .search-button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    margin-left: 1em;
  }

  .search-button:hover {
    transform: scale(1.1);
  }

  button {
    color: white;
    width: auto;
    height: 3em;
    background-color: #46330000;
    font-size: 1em;
    border: none;
  }

  img {
    border-radius: 1em;
    width: auto;
    height: 2.5em;
    cursor: pointer;
  }
</style>

<script>
  window.addEventListener('DOMContentLoaded', (event) => {
    const notificationMenu = document.querySelector('.notification-menu');

    if (notificationMenu) {
      // Show the notification initially
      notificationMenu.classList.add('show');

      // Hide the notification after 3 seconds
      setTimeout(() => {
        notificationMenu.classList.remove('show');
      }, 3000);
    }
  });
</script>
