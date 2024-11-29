<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-gray-50 dark:bg-gray-900">
    <section class="w-100" style="max-width: 400px;">
        <div class="bg-white rounded-lg shadow dark:border dark:bg-gray-800">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-center text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
                    Login
                    {{-- <a href="/register" class="btn btn-primary">Admin</a> --}}
                </h1>
                <form action="{{ route('login.process') }}" method="POST" class="space-y-4 md:space-y-6">
                    @csrf
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <!-- Role Selection Field -->
                    <div>
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                        </select>
                    </div>
                    <br>
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="btn btn-primary w-100">Log in</button>
                    </div>
                    <!-- Registration Link -->
                    <div class="text-center mt-3">
                        <p>Don't have an account? <a href="/register" class="text-primary">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
