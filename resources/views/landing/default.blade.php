<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:image" content="/img/brand/bluewhalecms.png" />
  <meta property="og:image:type" content="image/jpeg" /> 
  <meta property="og:image:width" content="400" /> 
  <meta property="og:image:height" content="300" />

  <meta property="og:description" content="Welcome to Bluewhale Clinic Management Software. 
            We are a start-up Software Development Company that primarily focus on building software solutions for doctor's that have their own clinic. We are doing our best that our software services can help you to easily manage your clinic operations." />

  <meta property="og:url"content="http://clinic-app.junrhy.com" />

  <meta property="og:title" content="Manage your clinic with Bluewhale CMS" />

  <title>Bluewhale - Manage your Clinic Online</title>
</head>

<!-- Styles -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<style type="text/css">
  .container-fluid {
      padding: 0px;
  }

  @media (max-width: 797px) {
      body { 
          padding-left: 0px;
          padding-right: 0px;
      }
  }

  .navbar .navbar-nav>.active> a, 
  .navbar .navbar-nav>.active> a:focus, 
  .navbar .navbar-nav>.active> a:hover,
  .navbar .navbar-nav>.active> a:visited {
  }

  .masthead {
    height: 100vh;
    min-height: 300px;
    /*background-image: url('https://source.unsplash.com/BtbjCFUvBXs/1920x1080');*/
    background-color: #01d8da;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

  .feature-details {
    text-align: center;
    padding-bottom: 25px;
  }

  .feature-details > i.fa {
    font-size: 28pt;
    color: #01d8da;
    margin-bottom: 10px;
  }

  .feature-details > .feature-title {
    font-size: 11pt;
  }

  .feature-details > .feature-body {
    margin-top: 10px;
    width: 250px;
    margin-left: auto;
    margin-right: auto;
    background-color: #e5e5e5;
    padding: 10px;
    border-radius: 5px;
    min-height: 180px;
  }

  .free-plan, .basic-plan, .enterprise-plan {
    border:1px solid #ccc;
    font-size:10pt;
  }

  .free-plan-head {
    background:#FF6065;
    color:#FFFFFF;
    border:1px solid #ccc;
  } 

  .basic-plan-head {
    background:#01d8da;
    color:#015a5b;
    border:1px solid #ccc;
  }

  .basic-enterprise-head {
    background:#636b6f;
    color:#FFFFFF;
    border-left:1px solid #ccc;
    border-right:1px solid #ccc;
  }

  .free {
    color: #FF6065;
    padding:3px;
    font-weight: bold;
    border:1px solid #ccc;
    font-size:13pt;
    font-family: 'arial';
  }

  .free-plan-foot {
    
  } 

  .basic-plan-foot {
    color:#015a5b;
    font-weight: bold;
    padding:3px;
    border:1px solid #ccc;
    font-size:13pt;
    font-family: 'arial';
  }

  .basic-enterprise-foot {
    color:#636b6f;
    font-weight: bold;
    padding:3px;
    border:1px solid #ccc;
    font-size:13pt;
    font-family: 'arial';
  }

  .btn-signup {
    background:#FF6065;
    color:#FFFFFF;
    font-size: 22pt;
    padding: 15px;
  }

  .btn-signup:hover {
    color:#FFFFFF;
  }

  .footer {
    background-color: #01a6a7;
    padding: 25px;
    color: #FFFFFF;
  }

  .socialmedia {
    color: #FFFFFF;
  }

  .socialmedia:hover {
    color: #FFFFFF;
  }

  .btn-submit-message {
    background-color: #FF6065;
    color: #FFFFFF;
  }

  .alert {
    border-radius: 0px;
  }

  .logo {
    height: 60px;
  }

  @media only screen and (max-width: 600px) {
      .logo {
          height: 30px;
      }
  }
</style>

<div class="container-fluid">
    @if(session()->has('success'))
    <div class="row">
        <div class="col-sm-12">
            <div align="center" class="alert  alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"><img src="/img/brand/bluewhalecms.png" class="logo"></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#features">Features</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#pricing">Pricing</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#testimonials">Our Clients</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#contact">Request a Demo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Clinic Portal
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Route::has('login'))
                          @auth
                              @if(auth()->user()->type == 'default')
                              <a href="{{ url('/home') }}" class="dropdown-item">{{ auth()->user()->client->name }} Dashboard</a>
                              @endif

                              @if(auth()->user()->type == 'patient')
                              <a href="{{ url('/patient_view') }}" class="dropdown-item"> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} Dashboard</a>
                              @endif

                              @if(auth()->user()->type == 'admin')
                              <a href="{{ url('/home') }}" class="dropdown-item">Admin Dashboard</a>
                              @endif

                              <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          @else
                              <a href="{{ route('login') }}" class="dropdown-item">Sign In</a>

                              @if (Route::has('register'))
                                  <a href="{{ route('register') }}" class="dropdown-item">Sign Up</a>
                              @endif
                          @endauth
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-12 text-center">
            <h1 class="font-weight-light">Welcome to <span style="font-weight: bold;color: #fff;">Bluewhale Clinic Management Software.</span></h1>
            <p class="lead">We are a start-up Software Development Company that primarily focus on building software solutions for doctor's that have their own clinic. We are doing our best that our software services can help you to easily manage your clinic operations.</p>

            <img src="/img/brand/banner.png" class="col-md-10 mx-auto">
          </div>
        </div>
      </div>
    </header>
    <br>
    <br>
    <h2 id="features" class="header" align="center">Features our customers love</h2>
    <br>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 feature-details">
              <i class="fa fa-calendar"></i><br>
              <span class="feature-title">Manage Appointments</span>
              <p class="feature-body">
                <br>
                Your will appreciate the convenience of booking appointments online.
              </p>
            </div>
            <div class="col-md-4 feature-details">
              <i class="fa fa-notes-medical"></i><br>
              <span class="feature-title">Manage Patient Records</span>
              <p class="feature-body">
                <br>
                Keeping your patient records in a safe and secure place that you can access anytime online.
              </p>
            </div>
            <div class="col-md-4 feature-details">
              <i class="fa fa-clinic-medical"></i><br>
              <span class="feature-title">Support Multiple Clinics</span>
              <p class="feature-body">
                <br>
                See the how your other clinic perform in one platform.
              </p>
            </div>
            <div class="col-md-4 feature-details">
              <i class="fa fa-file-alt"></i><br>
              <span class="feature-title">Manage Billing Invoice & Payments</span>
              <p class="feature-body">
                <br>
                You can record every charges and payments of patients.
              </p>
            </div>
            <div class="col-md-4 feature-details">
              <i class="fa fa-users"></i><br>
              <span class="feature-title">Manage Staff</span>
              <p class="feature-body">
                <br>
                Control which staff can access the system features.
              </p>
            </div>
            <div class="col-md-4 feature-details">
              <i class="fa fa-tooth"></i><br>
              <span class="feature-title">Dental Chart</span>
              <p class="feature-body">
                <br>
                Easily record your patient tooth diagnosis and treatment.
              </p>
            </div>
        </div>
    </div>
      
    <br>
    <br>
    <h2 id="pricing" class="header" align="center">Pricing</h2>
    <div align="center">Our popular plan is simplified by just paying small amount every month. You can use the system right away.</div>
    <br>
    <div class="col-md-7 mx-auto">
        <table class="table">
            <tr>
              <td style="border: 0;" width="25%"></td>
              <td style="border: 0;background: #FFA500;text-align: center;font-weight: bold;color: #FFFFFF;" width="25%">
                  <i class="fa fa-star"></i> Most Popular
              </td>
              <td style="border: 0;" width="25%"></td>
            </tr>
            <tr>
              <td class="free-plan-head text-center" width="25%">Free</td>
              <td class="basic-plan-head text-center" width="25%">Basic</td>
              <td class="basic-enterprise-head text-center" width="25%">Enterprise</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;font-weight: bold;text-align: center;">Best for starting clinic with few patients</td>
              <td class="basic-plan" style="padding-left: 4%;font-weight: bold;text-align: center;">Best for clinic with expanding services</td>
              <td class="enterprise-plan" style="padding-left: 4%;font-weight: bold;text-align: center;">Best for clinic with large operations</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Web / Mobile / Tablet</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Web / Mobile / Tablet</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Web / Mobile / Tablet</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Shared Server</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Shared Server</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Dedicated Server</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-times"></i> Cannot use your own domain</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-times"></i> Cannot use your own domain</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Use Your Own Domain</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Appointments</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Appointments</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Appointments</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage 100 Patients</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Unlimited Patients</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Unlimited Patients</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Clinics</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Clinics</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Clinics</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Staffs</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Staffs</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Staffs</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Services</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Services</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Services</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Doctors</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Doctors</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Doctors</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Dental Chart</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Dental Chart</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Dental Chart</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage 100 Inventory</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Inventory</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Manage Inventory</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> 24/7 Customer Service</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> 24/7 Customer Service</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> 24/7 Customer Service</td>
            </tr>
            <tr>
              <td class="free-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Automatic upgrade for new features</td>
              <td class="basic-plan" style="padding-left: 4%;"><i class="fa fa-check"></i> Automatic upgrade for new features</td>
              <td class="enterprise-plan" style="padding-left: 4%;"><i class="fa fa-times"></i> Scheduled upgrade for new features</td>
            </tr>
            <tr>
              <td class="free-plan text-center free" style="vertical-align: middle;">FREE</td>
              <td rowspan=2 class="basic-plan-foot text-center" style="vertical-align: middle;">&#8369;1,799 / Month</td>
              <td rowspan=2 class="basic-enterprise-foot text-center" style="vertical-align: middle;">
                  &#8369;3,000 / Month <br>
                  <span style="font-size: 8pt;font-weight: normal;"><i class="fa fa-star" style="color: #FFA500;"></i> VIP support included</span>
              </td>
            </tr>
        </table>
    </div>

    <br>
    <br>

    <div class="col-md-4 mx-auto text-center">
        <h2 class="">Want to try out?</h2>
        @if ($domain == null)
        <a href="/register" class="btn btn-lg btn-block btn-signup">
            Sign Up FREE!
        </a>
        @endif
    </div>

    <br>
    <br>
    <br>
    <h2 id="testimonials" class="header" align="center">Our Clients</h2>

    <div class="col-md-12">
      <div class="row">
        <img src="/img/clients-logo/armamentodentalstudio.png" class="col-md-2 mx-auto">
      </div>
    </div>
   
    <br>
    <div class="col-md-12 footer">
      <div class="row">
        <div class="col-md-3 mx-auto">
            <h2 id="aboutus" class="header" align="left">About Us</h2>
            <p align="justify">
              Bluewhale IT Software Services is a one year old company located in Cebu City, Philippines that was design by doctors for the doctor who is looking to simplify their clinic operations by using an online system.
            </p>
        </div>
        <div class="col-md-4 mx-auto">
            <h2 id="followus" class="header" align="left">Follow Us</h2>
            <br>
            <i class="fa fa-facebook-square" style="font-size: 25pt;"></i> <a href="https://www.facebook.com/bluewhaleCMS" target="_BLANK" class="socialmedia"> Facebook.com/BluewhaleCMS</a><br>
            <br>
            <i class="fab fa-youtube-square" style="font-size: 25pt;"></i> <a href="https://www.youtube.com/bluewhaleCMS" target="_BLANK" class="socialmedia"> Youtube.com/BluewhaleCMS</a><br>
            <br>
            <i class="fab fa-twitter-square" style="font-size: 25pt;"></i> <a href="https://www.twitter.com/bluewhaleCMS" target="_BLANK" class="socialmedia"> Twitter.com/BluewhaleCMS</a><br>
            <br>
            <br>
            <h2 id="customerservice" class="header" align="left">Offices</h2>
            <br>
            <span style="font-size: 14pt">Sales Office</span> <br>
            Address: Mivesa Salinas Drive Ext. Street Lahug Cebu City, Cebu Philippines <br>
            Landline: +63 (032) 342-8998 <br>
        </div>
        <div class="col-md-3 mx-auto">
            <h2 id="contact" class="header" align="left">How it works?</h2>

            <form action="/landing/contact_us" method="POST">
              <label class="label">First Name</label>
              <input type="text" name="first_name" class="form-control" required="required" placeholder="Type your first name">
              <br>
              <label class="label">Last Name</label>
              <input type="text" name="last_name" class="form-control" required="required" placeholder="Type your last name">
              <br>
              <label class="label">Phone</label>
              <input type="text" name="phone" class="form-control" required="required" placeholder="Type your phone number">
              <br>
              <label class="label">Email</label>
              <input type="email" name="email" class="form-control" required="required" placeholder="Type your email address">
              <br>
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <input type="hidden" name="from_url" value="{{ $_SERVER['SERVER_NAME'] }}" />

              <input type="submit" class="btn btn-lg btn-block btn-submit-message" value="Request a Demo">
            </form>
        </div>
      </div>
    </div>
</div>

