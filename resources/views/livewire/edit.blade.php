<!DOCTYPE html>
<html>
<head>
    <title>Create Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <center><h2>Update Employee Detail</h2></center>
    <form>
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input wire:model='name' type="text" name="name" class="form-control" id="name" required>
            @error('title')
               <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input wire:model='email' type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input wire:model='age' type="number" name="age" class="form-control" id="age" required>
        </div>
        <div class="form-group">
            <label for="designation">Designation</label>
            <input wire:model='designation' type="text" name="designation" class="form-control" id="designation" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input wire:model='salary' type="number" step="0.01" name="salary" class="form-control" id="salary" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input wire:model='phonenumber' type="tel" name="phone_number" class="form-control" id="phone_number" required>
        </div>
        <button wire:click.prevent="update()" type="submit" class="btn btn-primary">Update</button>
        <button wire:click.prevent="cancelUpdate()" type="submit" class="btn btn-danger">Cancel</button>
    </form>
</div>
</body>
</html>
