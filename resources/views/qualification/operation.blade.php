@extends('layouts.userNavbar')

@section('content')

<main role="main" class="container">
    <h1 class="text-center mt-5">Qualification</h1><br>

    @if($university >= 14 and $elective >= 18 and $total_core >= 78)
        @if($curriculum >= 3 or $curriculum_uniform >= 6)
            @if($muet >= 4.0)
            <div class="alert alert-success" role="alert">
                Congratulations, you pass for graduation!
              </div>
            @elseif ($muet < 4.0)
            <div class="alert alert-success" role="alert">
                You are qualified for intern,
                <a class="text-danger">but need to repeat your MUET! </a>
              </div>
            @else
            <div class="alert alert-success" role="alert">
                You are qualified for intern!
              </div>
            @endif

        @endif
    @else
        <div class="alert alert-danger" role="alert">
            You are not qualified for intern!
          </div>
    @endif


    <div class="card">
        <div class="card-header">
          University Course
        </div>
        <div class="card-body">
            <h6 class="card-text">Credit Hour: {{ $university }} /14 </h6>
            @if($university < 14)
            <a class="text-danger">Your university subject has not completed </a><br>
            <p class="card-text">Subject you have not taken: </p>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
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
                        <td>{{ $data_uni->subject_code }}</td>
                        <td>{{ $data_uni->sub_name }}</td>
                        <td>{{ $data_uni->credit_hour }}</td>
                        <td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            @else
            <a class="text-success">Your university subject has completed </a><br>
            @endif
        </div>
      </div><br>

      <div class="card">
        <div class="card-header">
          Core Course
        </div>
        <div class="card-body">
            <h6 class="card-text">Credit Hour: {{ $total_core }} /78 </h6>
            @if($total_core < 78)
            <a class="text-danger">Your core subject has not completed </a><br>
            <p class="card-text">Subject you have not taken: </p>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Credit Hour</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($list_core as $data_core)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data_core->subject_code }}</td>
                        <td>{{ $data_core->sub_name }}</td>
                        <td>{{ $data_core->credit_hour }}</td>
                        <td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            @else
            <a class="text-success">Your core subject has completed </a><br>
            @endif
        </div>
      </div><br>

      <div class="card">
        <div class="card-header">
          Elective Course
        </div>
        <div class="card-body">
            <h6 class="card-text">Credit Hour: {{ $elective }} /18 </h6>
            @if($elective < 18)
            <a class="text-danger">Your elective subject has not completed </a><br>
            <p class="card-text">Subject you have not taken: </p>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
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
                        <td>{{ $data_elective->subject_code }}</td>
                        <td>{{ $data_elective->sub_name }}</td>
                        <td>{{ $data_elective->credit_hour }}</td>
                        <td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            @else
            <a class="text-success">Your elective subject has completed </a><br>
            @endif
        </div>
      </div><br>

      <div class="card">
        <div class="card-header">
          Curriculum Course
        </div>
        <div class="card-body">
            @if($curriculum >= 3)
        <a>Credit Hour: {{ $curriculum }}/3</a><br>
        <a class="text-success">Your curriculum has completed </a><br>
    @elseif($curriculum < 3 and $curriculum >=1 )
        <a>Credit Hour: {{ $curriculum }}/3</a><br>
        <a class="text-danger">Your curriculum has not completed </a><br>
            
    @elseif ($curriculum == 0)
        @if($curriculum_uniform >= 6)
            <a>Credit Hour: {{ $curriculum_uniform }}/6</a><br>
            <a class="text-success">Your curriculum has completed </a><br>
        @else
            <a>Credit Hour: {{ $curriculum_uniform }}/6</a><br>
            <a class="text-danger">Your curriculum has not completed </a><br>
        @endif
    
    @endif
    </div>
    </div><br>

    <div class="card">
        <div class="card-header">
          MUET
        </div>
    <div class="card-body">
    @if($muet >= 4.0)
        <a>Band: {{ $muet }}</a><br>
        <a class="text-success">Your MUET has passed </a><br>
    @else
        <a>Band: {{ $muet }}</a><br>
        <a class="text-danger">Your MUET has not passed </a><br>
    
    @endif
    </div>
    </div><br>

    <div style="margin-bottom: 15px"><a class="btn btn-primary" onClick="window.print()">Download PDF</a></div>

</main>
@endsection