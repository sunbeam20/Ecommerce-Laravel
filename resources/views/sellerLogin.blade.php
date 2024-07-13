@include('components.sellerHeader')
<div class="login-form">
    <h1>Seller Login</h1>
    <form action="/seller" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" />
            <button type="submit" class="LoginBtn">Login</button>
        </div>

        <p class="create-account">
            Don't have an account yet?
            <a href="/SellerSignup">Create Account</a>
        </p>
        <p class="create-account"><a href="/forgot-password">Forgot your password?</a></p>
    </form>
</div>


<style>
    body {
        margin: 0px;
    }

    .login-form {
        width: 20%;
        margin: 5em auto;
        padding: 2em;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    h1 {
        text-align: center;
        margin-bottom: 1em;
    }

    .form-group {
        width: 100%;
        text-align: center;
        margin-bottom: 1em;
    }

    label {
        display: block;
        text-align: left;
        margin-left: 0.5em;
        margin-bottom: 0.5em;
    }

    input[type="email"],
    input[type="password"] {
        width: 95%;
        padding: 0.2em;
        margin-bottom: 0.5em;
        font-size: 1.5em;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .LoginBtn {
        font-size: 1.5em;
        margin-top: 1em;
        padding: 0.4em;
        width: 98%;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #614700ef;
        color: white;
        cursor: pointer;
    }

    .create-account {
        text-align: center;
    }

    .create-account a {
        text-decoration: none;
    }

    .create-account a:hover {
        text-decoration: underline;
    }
</style>
