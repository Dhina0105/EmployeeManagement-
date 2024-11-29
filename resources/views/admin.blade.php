<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    /* Styling for the active menu item */
    .list-group-item.active {
        background-color: #007bff !important; /* Bootstrap's primary blue color */
        color: #ffffff !important; /* White text color */
    }

    /* Profile icon styling */
    .profile-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #007bff;
        margin: 0 auto 10px;
    }
</style>

<body class="d-flex align-items-stretch vh-100 bg-gray-50 dark:bg-gray-900">

    <!-- Sidebar Menu -->
    <div class="bg-light border-end" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-uppercase border-bottom bg-primary">
            Admin Management
        </div>
        <div class="list-group list-group-flush my-3">
            <a href="{{route('admin')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-regular fa-folder"></i> Dashboard</a>
            <a href="{{route('employee')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-address-book"></i> Employee List</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-chart-line"></i> Reports</a>
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-cogs"></i> Settings</a>

            <!-- Sidebar Logout Button -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="list-group-item list-group-item-action bg-transparent text-primary fw-bold">
               <i class="fa-solid fa-power-off me-2"></i>
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
                            <!-- Profile Icon -->
                            <div class="profile-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
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
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-10">Welcome to the Admin Dashboard</h1>
                </div>
            </div>
            <div class="container mt-4">
                <h2 class="mb-4">All Leave Requests</h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaveRequests as $num=> $leave)
                            <tr>
                                <td>{{++$num}}</td>
                                <td>{{ $leave->employee_name }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td>{{ ucfirst($leave->status) }}</td>
                                <td>
                                    @if($leave->status == 'pending')
                                        <form action="{{ route('admin.leave-requests.update', $leave->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <select name="status" class="form-select d-inline w-50" required>
                                                <option value="">Select</option>
                                                <option value="approved">Approve</option>
                                                <option value="rejected">Reject</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                    @else
                                        <span class="badge {{ $leave->status == 'approved' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($leave->status) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
