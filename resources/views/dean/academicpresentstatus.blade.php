@extends('layouts.inside')

@section('top-nav-bar')
 
@include('top-nav-bar.dean')

@endsection

@section('side-nav-bar')

@include('side-nav-bar.dean')

@endsection


@section('content')

    {{-- @if(auth()->user()->academicPresentStatus()->count() == 0)
    No info
    <br>
    <a href="{{ route('add.academic.present', auth()->user()->id) }}" class="btn btn-info">Add Academic Present Status</a>
    @elseif(auth()->user()->academicPresentStatus()->count() > 0) --}}
        
    <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header bg-primary">
                            <h3 class="col-md-4">Academic Present Status</h3>
                            @if(auth()->user()->academicPresentStatus()->count() == 0)
                            <a href="{{ route('add.academic.present', auth()->user()->id) }}" class="btn btn-success float-right">Add</a>
                            @endif
                        </div>
                        <table class="table">
                                <thead>
                                    <th>Academic Rank</th>
                                    <th>Employment Status</th>
                                    <th>Yr. Appointed in UST</th>
                                    <th>No. of years in UST</th>
                                    <th>Present Position in UST</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                @if(auth()->user()->academicPresentStatus()->count() > 0)
                                <tbody>
                                    <tr>
                                        <td>
                                                @if(auth()->user()->academicPresentStatus->academic_rank == 1)
                                                Instructor I
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 2)
                                                Instructor II
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 3)
                                                Instructor III
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 4)
                                                Instructor IV
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 5)
                                                Instructor V
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 6)
                                                Asst. Professor I
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 7)
                                                Asst. Professor II
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 8)
                                                Asst. Professor III
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 9)
                                                Asst. Professor IV
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 10)
                                                Asst. Professor V
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 11)
                                                Assoc. Professor I
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 12)
                                                Assoc. Professor II
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 13)
                                                Assoc. Professor III
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 14)
                                                Assoc. Professor IV
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 15)
                                                Assoc. Professor V
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 16)
                                                Professor I
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 17)
                                                Professor II
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 18)
                                                Professor III
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 19)
                                                Professor IV
                                            @elseif(auth()->user()->academicPresentStatus->academic_rank == 20)
                                                Professor V
                                            @endif
                                        </td>
                                        <td>{{ auth()->user()->academicPresentStatus->employment_status }}</td>
                                        <td>{{ auth()->user()->academicPresentStatus->year_appointed_in_ust }}</td>
                                        <td>{{ auth()->user()->academicPresentStatus->num_of_years_in_ust }}</td>
                                        <td>{{ auth()->user()->academicPresentStatus->pos_in_ust }}</td>
                                        <td><a href="{{ route('edit.academic.present', auth()->user()->academicPresentStatus->id) }}" class="btn btn-info">Edit</a></td>
                                        <form action="{{ route('delete.academic.present', auth()->user()->academicPresentStatus->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                        </form>
                                    </tr>
                                </tbody>
                                @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection