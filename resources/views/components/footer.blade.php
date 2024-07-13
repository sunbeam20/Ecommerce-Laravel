<footer class="footer">
    <div class="footer-section">
      <h3>Company Info</h3>
      <ul>
        <li>About Sun</li>
        <li>Fashion</li>
        <li>Blogger</li>
        <li>Social Responsibility</li>
        <li>Careers</li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Help Support</h3>
      <ul>
        <li>Shipping Info</li>
        <li>How To Order</li>
        <li>How To Track</li>
        <li>Size Guide</li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Customer Care</h3>
      <ul>
        <li>Contact Us</li>
        <li>Payment Method</li>
        <li>Returns</li>
        <li>Refund</li>
      </ul>
    </div>

    <div class="find-payment">
      <h3>Find Us On</h3>
      <ul class="find-us">
        <li><img src="{{asset('images/facebook2.png')}}" class="hover-effect" /></li>
        <li><img src="{{asset('images/instagram.png')}}" class="hover-effect" /></li>
        <li><img src="{{asset('images/twitter.png')}}" class="hover-effect" /></li>
        <li><img src="{{asset('images/youtube.png')}}" class="hover-effect" /></li>
        <li><img src="{{asset('images/pinterest.png')}}" class="hover-effect" /></li>
      </ul>
    </div>

    <div class="find-payment">
      <h3>We Accept</h3>
      <ul class="payment">
        <li><img src="{{asset('images/cash-on-delivery.png')}}" class="hover-effect" /></li>
        <li><img src="{{asset('images/visa.png')}}" class="hover-effect" /></li>
        <li><img src="{{asset('images/paypal.png')}}" class="hover-effect" /></li>
        <li><img src="{{asset('images/google-pay.png')}}" class="hover-effect" /></li>
        <li><img src="{{asset('images/apple-pay.png')}}" class="hover-effect" /></li>
      </ul>
    </div>

    <div class="footer-section bottom">
      <p>&copy; 2022-2023 SUN All Rights Reserved</p>
      <ul class="ul">
        <li><a href="#">Privacy Center</a></li>
        <li><a href="#">Privacy &amp; Cookie Policy</a></li>
        <li><a href="#">Terms &amp; Conditions</a></li>
      </ul>
    </div>
  </footer>

  <style>
    .footer {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      background-color: #f7f7f7;
      padding: 3em 3em 0em 3em;
      margin-top: 7em;
      position:static;
    }
    .footer-section,
    .find-payment {
      margin: 0em 1em;
    }
    .payment li,
    .find-us li,
    .ul li {
      display: inline-block;
      margin-right: 1em;
    }
    .ul li {
      padding-right: 1em;
      border-right: 1px solid rgb(127, 127, 127);
    }
    .find-payment {
      display: flex;
      flex-direction: column;
    }
    .bottom {
      width: 100%;
      padding-bottom: 1em;
      text-align: right;
    }
    h3,
    .bottom p {
      font-size: 1.2em;
      margin-bottom: 1em;
    }
    li {
      font-size: smaller;
    }
    ul {
      list-style: none;
      padding-left: 0;
    }
    ul li {
      margin-bottom: 1em;
    }
    p {
      margin-bottom: 1em;
    }
    
    li a {
      color: #666;
      text-decoration: none;
    }
    li a:hover,
    li:hover {
      color: #000000;
      text-decoration: underline;
      cursor: pointer;
    }
    img {
      width: 3em;
      height: auto;
    }
    .payment img {
      width: 4em;
      height: auto;
    }
    </style>