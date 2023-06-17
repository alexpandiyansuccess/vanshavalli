<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Family Tree - Vanshavali</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dashboard/profile/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard/profile/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard/profile/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/profile/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/profile/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('dashboard/profile/images/favicon.svg') }}" type="image/x-icon">
	 <!-- <script src="jquery.js"></script>  -->

     
     
  
</head>  <style>
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
                            <a href="{{ route('dashboard-index') }}" class='sidebar-link'>
                                <i class="bi bi-person-circle"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ route('family-tree') }}" class='sidebar-link'>
                                <i class="bi bi-chat-quote-fill"></i>
                                <span>Foreroom</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ route('family-tree') }}" class='sidebar-link'>
                                <i class="bi bi-option"></i>
                                <span>Family Tree</span>
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
                                            <h6 class="mb-0 text-gray-600">Administrator</h6>
                                            <p class="mb-0 text-sm text-gray-600"><span id="user" class="message">Hello, <email-id></Email-id></span></p>
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
                                        <h6 class="dropdown-header">Hello, Admin!</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">
                                        <i class="icon-mid bi bi-chat-quote-fill me-2"></i>
                                        Foreroom
                                    </a>
                                </li>
                                    <li><a class="dropdown-item" href="./family-tree.html"><i class="icon-mid bi bi-option me-2"></i>
                                            Family Tree</a></li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li onclick="logout()"><a class="dropdown-item" href="#"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

 


            <div id="main-content">

                <div class="page-heading">
             
                    <section class="section">
                        <div class="card">
                            
                            <div style="width:100%; height:700px;" id="tree"></div>

                        
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
                            <p>2022 © Bumble Bees</p>
                        </div>
                        
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/iamraghavan/Vanshavali@main/familytree.js"></script>

    <script>

//JavaScript

var family = new FamilyTree(document.getElementById('tree'), {
    mouseScrool: FamilyTree.none,
    mode: 'dark',
    template: 'hugo',
    roots: [3],
    nodeMenu: {
        edit: { text: 'Edit' },
        details: { text: 'Details' },
    },
    nodeTreeMenu: true,
    nodeBinding: {
        field_0: 'name',
        field_1: 'born',
        img_0: 'photo'
    },
    editForm: {
        titleBinding: "name",
        photoBinding: "photo",
        addMoreBtn: 'Add element',
        addMore: 'Add more elements',
        addMoreFieldName: 'Element name',
        generateElementsFromFields: false,
        elements: [
            { type: 'textbox', label: 'Full Name', binding: 'name' },
            { type: 'textbox', label: 'Email Address', binding: 'email' },
            [
                { type: 'textbox', label: 'Phone', binding: 'phone' },
                { type: 'date', label: 'Date Of Birth', binding: 'born' }
            ],
            [
                { type: 'select', options: [{ value: 'bg', text: 'Bulgaria' }, { value: 'ru', text: 'Russia' }, { value: 'gr', text: 'Greece' }], label: 'Country', binding: 'country' },
                { type: 'textbox', label: 'City', binding: 'city' },
            ],
            { type: 'textbox', label: 'Photo Url', binding: 'photo', btn: 'Upload' },
        ]
    },
});

family.on('field', function (sender, args) {
    if (args.name == 'born') {
        var date = new Date(args.value);
        args.value = date.toLocaleDateString();
    }
});


family.load(
    [
        { id: 1, pids: [3], gender: 'male', photo: 'https://cdn.balkan.app/shared/m60/2.jpg', name: 'Zeph Daniels', born: '1954-09-29' },
        { id: 2, pids: [3], gender: 'male', photo: 'https://cdn.balkan.app/shared/m60/1.jpg', name: 'Rowan Annable', born: '1952-10-10' },
        { id: 3, pids: [1, 2], gender: 'female', photo: 'https://cdn.balkan.app/shared/w60/1.jpg', name: 'Laura Shepherd', born: '1943-01-13', email: 'laura.shepherd@gmail.com', phone: '+44 845 5752 547', city: 'Moscow', country: 'ru' },
        { id: 4, pids: [5], photo: 'https://cdn.balkan.app/shared/m60/3.jpg', name: 'Rowan Annable' },
        { id: 5, pids: [4], gender: 'female', photo: 'https://cdn.balkan.app/shared/w60/3.jpg', name: 'Lois Sowle' },
        { id: 6, mid: 2, fid: 3, pids: [7], gender: 'female', photo: 'https://cdn.balkan.app/shared/w30/1.jpg', name: 'Tyler Heath', born: '1975-11-12' },
        { id: 7, pids: [6], mid: 5, fid: 4, gender: 'male', photo: 'https://cdn.balkan.app/shared/m30/3.jpg', name: 'Samson Stokes', born: '1986-10-01' },
        { id: 8, mid: 7, fid: 6, gender: 'female', photo: 'https://cdn.balkan.app/shared/w10/3.jpg', name: 'Celeste Castillo', born: '2021-02-01' }
    ]
);

    </script> 


    <script src="{{ asset('dashboard/profile/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/profile/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dashboard/profile/js/main.js') }}"></script>

        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
            https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.6.7/firebase-auth.js"></script>
    
    
<script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.9.0/firebase-auth.js"></script>
<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyCJg-eG7QH6yFZRlRA2hjMwiU1Sd8t6Puw",
  authDomain: "kurudhiweb.firebaseapp.com",
  databaseURL: "https://kurudhiweb-default-rtdb.firebaseio.com",
  projectId: "kurudhiweb",
  storageBucket: "kurudhiweb.appspot.com",
  messagingSenderId: "993287986742",
  appId: "1:993287986742:web:3f28546bc8f14e6d190297",
  measurementId: "G-DVJ5PWQ84Z"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  var auth = firebase.auth();

  firebase.auth().onAuthStateChanged((user)=>{
    if(!user){
        // location.replace("../index.html")
    }else{
        // document.getElementById("user").innerHTML = "Hello, "+user.email    
    }
    
})


function logout(){
    firebase.auth().signOut()
}

</script>


     
<script>
    // Get the current year
var currentYear = new Date().getFullYear();

// Set the current year in the HTML element with the specified ID
var currentYearElement = document.getElementById('current-year');
// currentYearElement.textContent = currentYear.toString();


// Function to move data to another JavaScript file
function moveData(name, email) {
    // Store values in session storage
    sessionStorage.setItem('name', name);
    // sessionStorage.setItem('email', email);

    // Console log the values
    console.log('Name: ' + name);
    // console.log('Email: ' + email);
}


</script>

            



</body>


</html>