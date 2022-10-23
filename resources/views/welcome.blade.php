<!DOCTYPE html>
<html>
    <style>
        .center{
            text-align: center;
        }

.background{
    background: linear-gradient(to bottom, #ffff00 50%, #ff9933 100%);
    width: 100%;
    height: 100%;
}
                .row{
        background-color:  #ffffff;
        border: 5px solid black;
        border-width: 10%;
        width: min(100% - 2rem, 600px);
        margin-inline: center;
    }

    .rows{
  content: "";
  display: table;
  clear: both;
    }
.column {
  float: left;
  width: 50%;
  padding: 15px;
}

@media screen and (max-width:600px) {
  .column {
    width: 100%;
  }  
}

.background{
  /* background-image: linear-gradient(180deg, #2980b9, #8e44ad); */
background: rgb(221,95,45);
background: linear-gradient(90deg, rgba(221,95,45,1) 0%, rgba(228,196,6,1) 60%, rgba(255,244,0,1) 100%);
}
    </style>

    <header>
        <title>Electronics Store Website</title>
        <h5><strong>Welcome to Silicon Valley Online Store</strong></h5>
    </header>
    @include('layouts.master')
    <body class="background">
        <div class="row">
        <h3 class="center">
            <p>
            <img src="/images/logo.jpg" alt="logo.jpeg" height="60%" width="60%">
            </p>
        </h3>
        </div>
        <div class="rows">
  <div class="column">
    <h2><i class="fa fa-home" aria-hidden="true"></i>Home Page </h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
  </div>
  
  <div class="column">
    <h2><i class="fa fa-globe" aria-hidden="true"></i>Best Electronics Store</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
  </div>
  
  <div class="column">
    <h2><i class="fa fa-map-marker" aria-hidden="true"></i>Location</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
  </div>

  <div class="column">
    <h2><i class="fa fa-mobile" aria-hidden="true"></i>Best Gadgets</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
  </div>

  <div class="column">
    <h2><i class="fa fa-desktop" aria-hidden="true"></i>Contact Us</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
  </div>

  <div class="column">
    <h2><i class="fa fa-shopping-cart" aria-hidden="true"></i>Online Shopping</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
  </div>
</div>

    </body>
    @include('footer.footer_layout')
</html>