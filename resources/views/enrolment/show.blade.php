@extends('layouts.layout')

@section('content')
<main role="main" class="container">
    <h1 class="text-center mt-5">Enrolment</h1>
    <a >Name: {{ Auth::user()->name }}</a><br>
    <a>Matric Number: {{ Auth::user()->matric_no }}</a>

    <form action="{{route('enrolment.show', $id)}}" method="GET">
    @csrf

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Subject ID</th>
                <th scope="col">User ID</th>
                <th scope="col">Result ID</th>
                <th scope="col">Semester</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subject->$result->enrolments->where('user_id',Auth::id()) as $enrolment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $enrolment->subject_code }}</td>
                <td>{{ $enrolment->sub_name }}</td>
                <td>{{ $enrolment->credit_hour }}</td>
                <td>{{ $enrolment->sem }}</td>
                <td>{{ $enrolment->status }}</td>
                <td>
              
            
            </tr>
            @empty

            @endforeach
        </tbody>
    </table>


</main>
@endsection