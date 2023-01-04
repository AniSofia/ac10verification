@extends('layouts.layout')

@section('content')
<main role="main" class="container">
    <h1 class="text-center mt-5">Qualification</h1>



    <h3>University Course</h3>
    <a>Credit Hour: {{ $university }} /17 </a><br>

    @if($university <= 17)
    <a>Recommendations: </a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject ID</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Credit Hour</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list_uni as $data_uni)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_uni->id }}</td>
                    <td>{{ $data_uni->subject_code }}</td>
                    <td>{{ $data_uni->sub_name }}</td>
                    <td>{{ $data_uni->credit_hour }}</td>
                    <td>
                
                </tr>
                @empty
    
                @endforelse
            </tbody>
        </table>
        @endif

    <h3>Elective Course</h3>
    <a>Credit Hour: {{ $elective }}/18</a>

    @if($elective <= 18)
    <a>Recommendations: </a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject ID</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Credit Hour</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list_elective as $data_elective)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_elective->id }}</td>
                    <td>{{ $data_elective->subject_code }}</td>
                    <td>{{ $data_elective->sub_name }}</td>
                    <td>{{ $data_elective->credit_hour }}</td>
                    <td>
                
                </tr>
                @empty
    
                @endforelse
            </tbody>
        </table>
        @endif


    <h3>Core Course</h3>
    <a>Credit Hour: {{ $core }}</a>

    <h3>Core Important Course</h3>
    <a>Credit Hour: {{ $core_important }}</a>

    <h3>Core Course</h3>
    <a>Credit Hour: {{ $total_core }}/78</a><br>

    @if($total_core <= 78)
    <a>Recommendations: </a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject ID</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Credit Hour</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list_core as $data_uni)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_uni->id }}</td>
                    <td>{{ $data_uni->subject_code }}</td>
                    <td>{{ $data_uni->sub_name }}</td>
                    <td>{{ $data_uni->credit_hour }}</td>
                    <td>
                
                </tr>
                @empty
    
                @endforelse
            </tbody>
        </table>
        @endif


    <h3>Curriculum Course</h3>

    @if($curriculum >= 3)
        <a>Credit Hour: {{ $curriculum }}/3</a><br>
        <a>Your curriculum has completed </a><br>
    @elseif($curriculum < 3 and $curriculum >=1 )
        <a>Credit Hour: {{ $curriculum }}/3</a><br>
        <a>Your curriculum has not completed </a><br>
            
    @elseif ($curriculum == 0)
        @if($curriculum_uniform >= 6)
            <a>Credit Hour: {{ $curriculum_uniform }}/6</a><br>
            <a>Your curriculum has completed </a><br>
        @else
            <a>Credit Hour: {{ $curriculum_uniform }}/3</a><br>
            <a>Your curriculum has not completed </a><br>
        @endif
    
    @endif
</main>
@endsection