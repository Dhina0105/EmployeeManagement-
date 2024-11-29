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

    /* Shadow for the sidebar */
    #sidebar-wrapper {
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Creates a subtle shadow on the right */
        z-index: 1040; /* Ensures it stays above other content */
    }

    /* Adjusting background color for better visibility */
    .bg-light {
        background-color: #f8f9fa !important; /* Light gray color */
    }

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
            Employee Management
        </div>
        <div class="list-group list-group-flush my-3">
            <a href="{{route('home')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                <i class="fa-regular fa-folder"></i>
                Dashboard</a>
            <a href="{{route('leave')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                <i class="fa-solid fa-file"></i> Leave Request
            </a>
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
    {{-- <div id="page-content-wrapper" class="w-100">
        <div class="container-fluid">

            <!-- Profile Summary Section -->
            <div class="row my-3">
                <div class="col-md-3 col-lg-3 mx-auto">
                    <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                        <div class="card-body text-center">
                            <!-- Displaying Logged-in User's Profile -->
                            <h5 class="card-title mb-1">{{ Auth::user()->name }}</h5>
                            <p class="card-text text-muted mb-1">{{ Auth::user()->position ?? 'Employee' }}</p>
                            <p class="card-text">Email: {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <div class="col text-center">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-10">Welcome to the Employee Dashboard</h1>
                </div>
            </div> --}}

            <!-- Logout Form (Hidden) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="container mt-4">
        <h2 class="mb-4">Leave Request</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Leave Request Form -->
        <!-- Button to Trigger Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#leaveRequestModal">
    Request Leave
</button>

<!-- Modal Structure -->
<div class="modal fade" id="leaveRequestModal" tabindex="-1" aria-labelledby="leaveRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leaveRequestModalLabel">Leave Request Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('leave-store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <textarea id="reason" name="reason" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="leave_type" class="form-label">Leave Type</label>
                        <select id="leave_type" name="leave_type" class="form-control" required>
                            <option value="" disabled selected>Select Leave Type</option>
                            <option value="casual leave">Casual Leave</option>
                            <option value="loss of pay">Loss of Pay</option>
                            <option value="medical leave">Medical Leave</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <!-- List of Leave Requests -->
        <h3 class="mt-5">My Leave Requests</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>type of leave</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveRequests as $key=> $leave)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{ $leave->start_date }}</td>
                        <td>{{ $leave->end_date }}</td>
                        <td>{{ $leave->reason }}</td>
                        <td>{{$leave->leave_type}}</td>
                        <td>{{ ucfirst($leave->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
