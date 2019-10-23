@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Place of birth</th>
                            <th>Sex</th>
                            <th>Religion</th>
                            <th>Occupation</th>
                            <th>Address</th>
                            <th>Telephone</th>
                            <th>Mobile Phone</th>
                            <th>Email Address</th>
                            <th>Date of Birth</th>
                            <th>Citizenship</th>
                            <th>Marital Status</th>
                            <th>Name of Spouse</th>
                            <th>Names and Ages of Children</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->age }}</td>
                                <td>{{ $user->place_birth }}</td>
                                <td>{{ $user->sex == 1 ? 'Male' : 'Female' }}</td>
                                <td>{{ $user->religion }}</td>
                                <td>{{ $user->occupation }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->telephone }}</td>
                                <td>{{ $user->mobilephone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->birth }}</td>
                                <td>{{ $user->citizenship }}</td>
                                <td>{{ $user->marital_status }}</td>
                                <td>{{ $user->spouse == null ? 'Not applicable' : $user->spouse }}</td>
                                <td>{{ $user->names_ages_of_children == null ? 'Not applicable' : $user->names_ages_of_children }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
