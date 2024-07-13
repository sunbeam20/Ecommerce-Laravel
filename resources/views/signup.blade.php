@include('components.header')
<form class="login-form" action="/register" method="POST">
  @csrf
  <h1>Sign Up</h1>
  <div class="details">
    <input class="input" type="text" placeholder="Full Name" id="fullname" name="name" />
    <input class="input" type="email" placeholder="Email Address" id="email" name="email" />
    <input class="input" type="password" placeholder="Password" id="password" name="password" />
    <input class="input" type="text" placeholder="Address" id="address" name="address" />
  </div>

  <div class="side-side">
    <div class="input-group">
      <select class="input" id="state" name="state">
        <option value="" selected disabled>State</option>
        <option value="state1">State 1</option>
        <option value="state2">State 2</option>
        <option value="state3">State 3</option>
        <!-- Add more state options as needed -->
      </select>

      <select class="input" id="city" name="city">
        <option value="" selected disabled>City</option>
        <option value="city1">City 1</option>
        <option value="city2">City 2</option>
        <option value="city3">City 3</option>
        <!-- Add more city options as needed -->
      </select>

    </div>
    <div class="input-group">
      <input class="input" type="text" placeholder="ZIP-code" id="zip" name="zip" />
      <input class="input" type="tel" placeholder="Contact Number" id="contact" name="contact" />
    </div>
  </div>

  <div class="radio-buttons">
    <label class="label">Gender:</label>
    <label class="label">
      <input class="input" type="radio" name="gender" value="male" name="male" />
      Male
    </label>
    <label class="label">
      <input class="input" type="radio" name="gender" value="female" name="female" />
      Female
    </label>
  </div>
  <!-- <SignupBtn /> -->
  <div><button type="submit" class="signupBtn">Signup</button></div>
  <p class="Log-in">
    Already have an account?<a href="/Login">Log in</a>
  </p>
</form>
@include('components.footer')

<style>
  body {
    margin: 0px;
  }

  .login-form {
    text-align: center;
    max-width: 20%;
    margin: 4em auto;
    padding: 1em 2em 2em 2em;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }

  .details {
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: space-evenly;
    align-items: center;
    width: 100%;
  }

  .details .input {
    width: 95%;
    margin: 0.5em;
    padding: 0.5em;
    border-radius: 5px;
    border: 1px solid gray;
  }

  .side-side {
    width: 100%;
  }

  .side-side .input-group {
    width: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
  }
  .input-group .input{
    width: 40%;
    margin: 0.5em;
    padding: 0.5em;
    border-radius: 5px;
    border: 1px solid gray;
  }

  .radio-buttons {
    display: flex;
    flex-direction: row;
    padding: 1em;
    justify-content: center;
    color: gray;
  }

  .radio-buttons label {
    display: flex;
    align-items: center;
  }

  .radio-buttons input[type="radio"] {
    margin: 0em 1em;
  }

  .Log-in {
    text-align: center;
  }

  .Log-in a {
    text-decoration: none;
  }

  .Log-in a:hover {
    text-decoration: underline;
  }

  .signupBtn {
    background-color: #614700ef;
    border: none;
    color: white;
    padding: 1em 0em;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 1em;
    cursor: pointer;
    border-radius: 5px;
    width: 95%;
  }
</style>
