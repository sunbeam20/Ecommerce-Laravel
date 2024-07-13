<header class="sticky-header">
  <nav class="nav">
    <div class="navleft">
      <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
      </a>

      @if (Auth::guard('seller')->check())
        <a href="/SellerHome" class="submit">Seller Hub</a>
      @endif
      </form>
      {{-- @if (Auth::guard('seller')->check())
        <h1>Logged in as {{ Auth::guard('seller')->user()->name }}</h1>
      @else
        <h1>Guest</h1>
      @endif --}}
    </div>
    <div class="navright">
      <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="dropdown-item submit">Logout</button>
      </form>
    </div>
  </nav>
</header>
<style>
  .sticky-header {
    position: sticky;
    top: 0;
    height: 4vh;
  }

  .nav {
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

  .navleft img {
    border-radius: 2em;
    width: auto;
    height: 4em;
    cursor: pointer;
    padding: 0.2em;
  }

  form {
    margin-block-end: 0%;
  }

  .submit {
    margin-left: 1em;
    border: none;
    font-size: 1.5em;
    font-weight: bold;
    background-color: transparent;
    color: rgb(222, 179, 51);
    cursor: pointer;
  }
  a{
    text-decoration: none;
  }
</style>
