<div>
    @if(session()->has('message'))
       <div class="alert alert-success">
       {{session('message')}}
</div>
@endif
@include('livewire.create')
      {{-- @if($edit_mode)
      @include('livewire.edit')
      @else

      @endif --}}

<h2>Employee List</h2>

<table class="employee-list">
    <thead>
        <tr>
            <th width="150px">Name</th>
            <th width="150px">Email</th>
            <th width="150px">Age</th>
            <th width="150px">Designation</th>
            <th width="150px">Salary</th>
            <th width="150px">Phone Number</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $details)
        <tr>
            <td>{{$details->name}}</td>
            <td>{{$details->email}}</td>
            <td>{{$details->age}}</td>
            <td>{{$details->designation}}</td>
            <td>{{$details->salary}}</td>
            <td>{{$details->phonenumber}}</td>
            <td><button wire:click="edit()"{{$details->name}} class="btn btn-primary btn-sm">Edit</button>
            <button class="btn btn-danger btn-sm">Delete</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

