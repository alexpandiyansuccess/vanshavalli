<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Dashboard - Vanshavali</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/iamraghavan/Vanshavali@main/css/ishulove.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom/profile/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/profile/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/profile/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/profile/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/profile/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Mouse+Memoirs&display=swap');

.header-logo-text {
    font-family: 'Mouse Memoirs', sans-serif;
    color: #FFF;
}
</style>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <h3 class="header-logo-text">Vanshavali</h3>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>


                <div class="sidebar-menu">
                <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-person-circle"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-chat-quote-fill"></i>
                                <span>Foreroom</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ url('/create-chart') }}" class='sidebar-link'>
                                <i class="bi bi-option"></i>
                                <span>Family Tree</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ url('/familyTree') }}" class='sidebar-link'>
                                <i class="bi bi-option"></i>
                                <span> Manage Chart</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
        <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Notifications</h6>
                                        </li>
                                        <li><a class="dropdown-item">No notification available</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">Hello, {{ Auth::user()->name }}</h6>
                                            <p class="mb-0 text-sm text-gray-600"><span id="user" class="message">
                                                    <email-id>{{ Auth::user()->email }}</Email-id>
                                                </span></p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="https://kurudhi.netlify.app/admin/images/man.png">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="icon-mid bi bi-chat-quote-fill me-2"></i>
                                            Foreroom
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('/create-chart') }}"><i
                                                class="icon-mid bi bi-option me-2"></i>
                                            Family Tree</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/familyTree') }}"><i
                                                class="icon-mid bi bi-option me-2"></i>
                                            Manage Chart</a></li>

                                    <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a>
                                            

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            
                        
                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">

                            </div>

                        </div>
                    </div>
                    <section class="section">
                        <div class="card">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="page-content">
                                <div class="form-v10-content">
                                    <form class="form-detail" method="POST" action="{{ route('updateprofile') }}"
                                        autocomplete="nope">
                                        @csrf
                                        <div class="form-left">
                                            <h2>General Information</h2>
                                            <div class="form-group">
                                                <div class="form-row form-row-1">
                                                    <input type="text" oninput="this.value = this.value.toUpperCase()"
                                                        name="full_name" value="{{$userProfile->full_name}}"
                                                        inputmode="text" id="full_name" class="input-text"
                                                        placeholder="Full Name" autocomplete="nope" required>
                                                </div>
                                                <div class="form-row form-row-2">
                                                    <select id="gender" name="gender" autocomplete="off">
                                                        @if($userProfile->gender)
                                                        <option selected value="{{$userProfile->gender}}">
                                                            {{$userProfile->gender}}</option>
                                                        @endif
                                                        <option value="#">Select Your Gender</option>
                                                        <option value="MALE">MALE</option>

                                                        <option value="Female">FEMALE</option>
                                                        <!-- <option>TRANSGENDER</option> -->
                                                    </select>
                                                    <span class="select-btn">
                                                        <i class="zmdi zmdi-chevron-down"></i>
                                                    </span>


                                                </div>

                                            </div>



                                            <div class="form-group">
                                                <div class="form-row form-row-1">
                                                    <!-- <input placeholder="Date of Birth" type="text" onfocus="(this.type='date')" id="date"> -->
                                                    <input id="dob" runat="server" name="dob"
                                                        placeholder="Date Of Birth" value="{{$userProfile->dob}}"
                                                        type="text" onfocus="(this.type='date')"
                                                        onchange="DateSelectionChanged()" autocomplete="off">

                                                </div>
                                                <div class="form-row form-row-2">
                                                    <input name="age" placeholder="Age" id="age" type="text" required
                                                        disabled autocomplete="off">
                                                </div>
                                            </div>

                                            <h2>Contact Information</h2>


                                            <div class="form-group">
                                                <div class="form-row form-row-1">
                                                    <input inputmode="email" value="{{$userProfile->email}}"
                                                        name="email" type="email"
                                                        pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})"
                                                        id="email_input" class="input-text" placeholder="Email" required
                                                        autocomplete="off">
                                                </div>
                                                <div class="form-row form-row-2">
                                                    <input inputmode="tel" value="{{$userProfile->contact_number}}"
                                                        name="contact_number" type="number" pattern="[0-9]*"
                                                        inputmode="numeric" id="id6" class="business"
                                                        placeholder="Contact Number" required autocomplete="off">
                                                </div>

                                                <!-- <div class="form-row form-row-2">
                                                    <input inputmode="tel" name="wNumber" type="number" pattern="[0-9]*" inputmode="numeric" id="id6" class="business" placeholder="Whatsapp Number" required>
                                                </div> -->
                                            </div>


                                            <h2>Location Information</h2>
                                            <div class="form-group ">
                                                <div class="form-row  form-row-1">
                                                    <input inputmode="tel" value="{{$userProfile->door_number}}"
                                                        name="door_number" type="number" pattern="[0-9]*"
                                                        inputmode="numeric" placeholder="Enter Flat / Door / Block No."
                                                        required autocomplete="off">
                                                </div>
                                                <div class="form-row  form-row-2">
                                                    <input type="text" id="street_name"
                                                        value="{{$userProfile->street_name}}" name="street_name"
                                                        placeholder="Enter your Street Name" required
                                                        autocomplete="off">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="form-row form-row-1">
                                                    <input inputmode="tel" type="text" value="{{$userProfile->pincode}}"
                                                        id="pincode" maxlength="6" name="pincode" pattern="[0-9]*"
                                                        inputmode="numeric" placeholder="Pincode" required
                                                        autocomplete="off">
                                                </div>
                                                <div class="form-row form-row-2">
                                                    <input type="text" oninput="this.value = this.value.toUpperCase()"
                                                        name="area" value="{{$userProfile->area}}" inputmode="text"
                                                        id="area" class="input-text" placeholder="Area" readonly
                                                        required autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="form-row form-row-1">

                                                    <input type="text" value="{{$userProfile->district}}"
                                                        oninput="this.value = this.value.toUpperCase()" name="district"
                                                        inputmode="text" id="district" class="input-text"
                                                        placeholder="District" readonly required autocomplete="off">
                                                </div>
                                                <div class="form-row form-row-2">
                                                    <input type="text" value="{{$userProfile->state}}"
                                                        oninput="this.value = this.value.toUpperCase()" name="state"
                                                        inputmode="text" id="state" class="input-text"
                                                        placeholder="State" readonly required autocomplete="off">
                                                </div>
                                                <div class="form-row form-row-2">
                                                    <input type="text" oninput="this.value = this.value.toUpperCase()"
                                                        name="country" value="{{$userProfile->country}}"
                                                        inputmode="text" id="country" class="input-text"
                                                        placeholder="Country" readonly required autocomplete="off">
                                                </div>

                                            </div>

                                            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                            <script>
                                            $('#pincode').change(function() {
                                                var zipcode = $(this).val();
                                                $.ajax({
                                                    url: 'https://api.postalpincode.in/pincode/' +
                                                        zipcode,
                                                    type: 'GET',
                                                    success: function(response) {

                                                        let postArea = response[0].PostOffice[0]
                                                            .Name;
                                                        console.log("Area : " + postArea);
                                                        $('#area').val(postArea);

                                                        let postDistrict = response[0].PostOffice[0]
                                                            .District;
                                                        console.log(postDistrict);
                                                        $('#district').val(postDistrict);

                                                        let postState = response[0].PostOffice[0]
                                                            .State;
                                                        console.log(postState);
                                                        $('#state').val(postState);

                                                        let postCountry = response[0].PostOffice[0]
                                                            .Country;
                                                        console.log(postCountry);
                                                        $('#country').val(postCountry);
                                                    }
                                                });
                                            });
                                            </script>


                                            <h2>Social Media Information</h2>


                                            <div class="form-group">
                                                <div class="form-row form-row-1">
                                                    <input inputmode="text" name="instagram_username" type="text"
                                                        pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})"
                                                        class="input-text" placeholder="Instagram" required
                                                        autocomplete="off" value="{{$userProfile->instagram_username}}">
                                                </div>

                                                <div class="form-row form-row-2">
                                                    <input inputmode="text" name="facebook_username" type="text"
                                                        pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})"
                                                        class="input-text" placeholder="Facebook" required
                                                        autocomplete="off" value="{{$userProfile->facebook_username}}">
                                                </div>

                                                <div class="form-row form-row-2">
                                                    <input inputmode="text" name="website_url" type="text"
                                                        pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})"
                                                        class="input-text" placeholder="Enter your website"
                                                        value="{{$userProfile->website_url}}" required
                                                        autocomplete="off">
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div class="form-row form-row-1">
                                                    <input inputmode="text" value="{{$userProfile->twitter_username}}"
                                                        name="twitter_username" type="text"
                                                        pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})"
                                                        class="input-text" placeholder="Twitter" required
                                                        autocomplete="off">
                                                </div>

                                                <div class="form-row form-row-2">
                                                    <input inputmode="text" value="{{$userProfile->github_url}}"
                                                        name="github_url" type="text"
                                                        pattern="[A-Za-z0-9._%+-]{3,}@[a-zA-Z]{3,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})"
                                                        class="input-text" placeholder="Github" required
                                                        autocomplete="off">
                                                </div>

                                            </div>


                                            <div class="col-12 d-flex justify-content-center">
                                                <button class="btn btn-lg bg-btn-submit mr-4 mb-4 hover-success"
                                                    type="submit" name="Submit" value="Submit">Submit</button>



                                                <button type="reset"
                                                    class="btn btn-lg bg-btn-clr mr-4 mb-4 hover-primary">Reset</button>
                                            </div>

                                            <br>


                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
                <!--                 
        <button onclick="swalelement">submit</button>

        <script>

            swal("Here's the title!", "...and here's the text!");
        </script> -->

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p> <span id="current-year">2023</span> © Vanshavali</p>
                        </div>

                    </div>
                </footer>
            </div>
        </div>


        <script src="./vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="./js/bootstrap.bundle.min.js"></script>
        <script src="./js/main.js"></script>




        <script>
        // Get the current year
        var currentYear = new Date().getFullYear();

        // Set the current year in the HTML element with the specified ID
        var currentYearElement = document.getElementById('current-year');
        currentYearElement.textContent = currentYear.toString();
        </script>

        <script type="text/javascript">
        $(document).ready(function() {
            DateSelectionChanged();
        });

        function DateSelectionChanged() {
            var today = new Date();

            var dob = new Date(document.getElementById('dob').value);
            var months = (today.getMonth() - dob.getMonth() + (12 * (today.getFullYear() - dob.getFullYear())));

            let findDate = Math.round(months / 12);
            let donorName = document.getElementById('full_name').value;
            console.log(donorName);

            if (findDate >= 18 && findDate < 55) {
                document.getElementById('age').value = ("AGE : " + "" + findDate);
            } else {
                alert('Age Restricted' + ' ' + `Sorry! ${donorName} you are not allowed to vanshavali`);

            }

        }
        </script>





</body>


</html>