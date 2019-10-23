<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <h2>Curriculum Vitae</h2>
        <div>
                <div>
                    <div>
                        <div>
                            <div>
                                <h3>Personal Particular</h3>
                            </div>
                            @if(auth()->user()->personalParticular()->count() > 0)
                            <div>
                                <div>
                                    <strong>Name:</strong> {{ $fullname }}
                                    <br>
                                    <br>
                                    <strong>Sex:</strong> {{ $sex == 0 ? 'Male' : 'Female' }}
                                    <br>
                                    <br>
                                    <strong>Religion:</strong> {{ $religion }}
                                    <br>
                                    <br>
                                    <strong>Occupation:</strong> {{ $occupation }}
                                    <br>
                                    <br>
                                    <strong>Address:</strong> {{ $address }}
                                    <br>
                                    <br>
                                    <strong>Age:</strong> {{ $age }}
                                    <br>
                                    <br>
                                    <strong>Telephone:</strong> {{ $telephone }}
                                    <br>
                                    <br>
                                    <strong>Mobilephone:</strong> {{ $mobilephone }}
                                    <br>
                                    <br>
                                    <strong>Email Address:</strong> {{ $email }}
                                    <br>
                                    <br>
                                    <strong>Date of Birth:</strong> {{ $birth }}
                                    <br>
                                    <br>
                                    <strong>Place of Birth:</strong> {{ $place_birth }}
                                    <br>
                                    <br>
                                    <strong>Citizenship:</strong> {{ $citizenship }}
                                    <br>
                                    <br>
                                    <strong>Marital Status:</strong> {{ $marital_status }}
                                    <br>
                                    <br>
                                    <strong>Name of Spouse:</strong> {{ $spouse == null ? 'Not Applicable' : $spouse }}
                                    <br>
                                    <br>
                                    <strong>Names and Ages of Children:</strong> {{ $names_ages_of_children == null ? 'Not Applicable' : $names_ages_of_children }}
                                </div>
                                <div>
                                    <img src="{{ $image ? asset('storage/' . $image) : 'https://via.placeholder.com/430x400' }}" alt="" width="430" height="400">
                                </div>
                            </div>
                            @else
                                <p>Empty Personal Particular</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div>
                    <div>
                        <div>
                            <div>
                                <div>
                                    <h3>Academic Degrees</h3>
                                </div>
                                @if(auth()->user()->academicDegrees()->count() > 0)
                                    <table>
                                        <thead>
                                            <th>Degree</th>
                                            <th>School</th>
                                            <th>Year Graduated</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody> 
                                            @foreach(auth()->user()->academicDegrees as $academicDegree)
                                            <tr>
                                                <td>{{ $academicDegree->degree }}</td>
                                                <td>{{ $academicDegree->school }}</td>
                                                <td>{{ $academicDegree->year_graduated }}</td>
                                                <td>{{ $academicDegree->validate == 0 ? 'On Approval' : 'Approved' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>Empty Academic Degrees</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
</body>
</html>