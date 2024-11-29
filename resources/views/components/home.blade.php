<x-home :assets="$assets??[]">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    /* Styling for the active menu item */
    .list-group-item.active {
        background-color: #007bff !important; /* Bootstrap's primary blue color */
        color: #ffffff !important; /* White text color */
    }
</style>

<body class="d-flex align-items-stretch vh-100 bg-gray-50 dark:bg-gray-900">

    <!-- Sidebar Menu -->
    <div class="bg-light border-end" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-uppercase border-bottom bg-primary">
            Admin Management
        </div>
        <div class="list-group list-group-flush my-3">
            <a href="{{route('admin')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Dashboard</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Leave Request</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Report</a>
    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Settings</a>

            <!-- Sidebar Logout Button -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="list-group-item list-group-item-action bg-transparent text-primary fw-bold">
                Logout
            </a>
        </div>
    </div>

    <!-- Page Content Wrapper -->
    <div id="page-content-wrapper" class="w-100">
        <div class="container-fluid">

            <!-- Profile Summary Section -->
            <div class="row my-3">
                <div class="col-md-3 col-lg-3 mx-auto">
                    <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                        <div class="card-body text-center">
                            <!-- Displaying Logged-in User's Profile -->
                            <h5 class="card-title mb-1">{{ Auth::user()->name }}</h5>
                            <p class="card-text text-muted mb-1">{{ Auth::user()->position ?? 'admin' }}</p>
                            <p class="card-text">Email: {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="row my-4">
                <div class="col text-center">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-10">Welcome to the Employee Dashboard</h1>
                </div>
            </div>

            <!-- Logout Form (Hidden) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <script>
        // Function to set the active class on the clicked link
        document.querySelectorAll('#sidebar-wrapper .list-group-item').forEach(link => {
            link.addEventListener('click', function() {
                // Remove 'active' class from all menu items
                document.querySelectorAll('#sidebar-wrapper .list-group-item').forEach(item => item.classList.remove('active'));
                // Add 'active' class to the clicked menu item
                this.classList.add('active');
            });
        });
    </script>

</body>
</html>
<x-home>
