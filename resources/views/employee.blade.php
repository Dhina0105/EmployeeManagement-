<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    .list-group-item.active {
        background-color: #007bff !important;
        color: #ffffff !important;
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

            <!-- Employee List Section -->
            <div class="row my-4">
                <div class="col text-center">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mt-10">Employee List</h1>
                </div>
            </div>

            <!-- Add Employee Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                ADD NEW
            </button>
             <!-- Filter Form -->
<form method="GET" action="{{ route('employee') }}" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="Search by Name">
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ request('email') }}" placeholder="Search by Email">
        </div>
        <div class="col-md-4">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="employee" {{ request('role') == 'employee' ? 'selected' : '' }}>Employee</option>
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('employee') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

            <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registerModalLabel">Register</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('register.save') }}" method="POST">
                                @csrf
                                <!-- Name Field -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                <!-- Email Field -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                <!-- Confirm Password Field -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                </div>
                                <!-- Role Selection Field -->
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-select" required>
                                        <option value="" disabled selected>Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                </div>
                                <!-- Submit Button -->
                                <div>
                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                </div>
                                <!-- Already have an account link -->
                                {{-- <div class="text-center mt-3">
                                    <p>Already have an account? <a href="/login" class="text-primary">Log in</a></p>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Employee Table -->
            <div class="row">
                <div class="col">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $key => $employee)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ ucfirst($employee->role) }}</td>
                                    <td>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- Logout Form (Hidden) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        document.querySelectorAll('#sidebar-wrapper .list-group-item').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('#sidebar-wrapper .list-group-item').forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>

</body>
</html>
