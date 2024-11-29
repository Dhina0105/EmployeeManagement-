<!DOCTYPE html>
<html>
<head>
    <title>Create Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">

    <h2>Create Employee</h2>
    <form>
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input wire:model='name' type="text" name="name" class="form-control" id="name" required>
            @error('name')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input wire:model='email' type="email" name="email" class="form-control" id="email" required>
            @error('email')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input wire:model='age' type="number" name="age" class="form-control" id="age" required>
            @error('age')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="designation">Designation</label>
            <input wire:model='designation' type="text" name="designation" class="form-control" id="designation" required>
            @error('designation')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input wire:model='salary' type="number" step="0.01" name="salary" class="form-control" id="salary" required>
            @error('salary')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input wire:model='phonenumber' type="tel" name="phone_number" class="form-control" id="phone_number" required>
            @error('phonenumber')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <button wire:click.prevent="store()" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
