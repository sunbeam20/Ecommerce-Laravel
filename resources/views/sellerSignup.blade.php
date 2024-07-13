@include('components.sellerHeader')
<form class="signup" action="/seller-register" method="POST">
    @csrf
    <h1 class="h1">Seller Sign Up</h1>
    <input type="text" placeholder="Full Name" id="fullname" name="user_name"/>
    <input type="email" placeholder="Email Address" id="email" name="email"/>
    <input type="password" placeholder="Password" id="password" name="password"/>
    <input type="text" placeholder="Shop Name" id="SopName" name="name"/>
    <input type="text" placeholder="Shop Address" id="address" name="address"/>

    <div class="side-side">
        <div class="input-group">
            <input type="text" placeholder="City" id="city" name="city"/>
            <input type="text" placeholder="State" id="state" name="state"/>
        </div>
        <div class="input-group">
            <input type="text" placeholder="ZIP-code" id="zip" name="zip"/>
            <input class="input" type="tel" placeholder="Contact Number" id="contact" name="contact" />
        </div>
    </div>

    <!-- <SignupBtn /> -->
    <div><button class="signupBtn">Signup</button></div>
    <p class="Log-in">
        Already have an account?<a href="/SellerLogin">Log in</a>
    </p>
</form>

<style>
        body {
        margin: 0px;
    }
    .signup {
        text-align: center;
        max-width: 25%;
        margin: 4em auto;
        padding: 1em 2em 2em 2em;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .h1 {
        text-align: center;
        margin-bottom: 1.5em;
    }

    label {
        display: block;
        margin-bottom: 0.5em;
        font-weight: bold;
    }

    input {
        border: 1px solid #ccc;
        margin: 1em 1em 0em 1em;
    }

    input,
    .input-group {
        display: block;
        margin: 1em 1em 0em 1em auto;
        width: 90%;
        padding: 5px;
        border-radius: 5px;
    }

    input:focus {
        outline: none;
        border-color: dodgerblue;
    }

    .side-side {
        display: flex;
        justify-content: center;
    }

    .input-group {
        text-align: center;
        width: 45%;
    }

    .input-group input {
        width: 90%;
        box-sizing: border-box;
    }

    .fg {
        text-align: center;
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

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="tel"] {
        width: 90%;
        padding: 0.4em;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .signupBtn {
        margin-top: 1em;
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
        width: 90%;
    }

    div {
        text-align: center;
    }

    button:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(0, 0, 255, 0.5);
    }
</style>
