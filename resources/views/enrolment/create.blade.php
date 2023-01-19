{{-- @extends('layouts.app') --}}
@extends('layouts.userNavbar')

@section('content')
<main role="main" class="container">
    <h1 class="text-center mt-5">Enrolment</h1>
    <a >Name: {{ Auth::user()->name }}</a><br>
    <a>Matric Number: {{ Auth::user()->matric_no }}</a>
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEnrol" data-inline="true">
      Add Subject
    </button>
  
  <!-- Modal -->
  <div class="modal fade" id="addEnrol" tabindex="-1" role="dialog" aria-labelledby="addEnrolLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addEnrolLabel">Add New Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         
          <form action="{{ route('enrolment.store') }}" method="POST">
            @csrf

            <div class="form-group row">
              <label for="sem" class="col-4 col-form-label">Semester</label> 
              <div class="col-8">
                <select id="sem" name="sem" class="custom-select">
                  <option value="1">Semester 1</option>
                  <option value="2">Semester 2</option>
                  <option value="3">Semester 3</option>
                  <option value="4">Semester 4</option>
                  <option value="5">Semester 5</option>
                  <option value="6">Semester 6</option>
                  <option value="7">Semester 7</option>
                  <option value="8">Semester 8</option>
                </select>
              </div>
            </div> 

            <div class="form-group row">
              <label for="subject_id" class="col-4 col-form-label">Subject Code</label> 
              <div class="col-8">
                <select name="subject_id" class="form-control" required="required">
                  <option value="">Select Code Subject</option>
                  @foreach ($subjects as $subject)
                  <option value="{{ $subject -> id }}" > {{ $subject -> subject_code }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="result_id" class="col-4 col-form-label">Grade</label> 
              <div class="col-8">
                <select name="result_id" class="form-control" required="required">
                  <option value="">Select your grade</option>
                  @foreach ($results as $result)
                  <option value="{{ $result -> id }}" > {{ $result -> grade }}</option>
                  @endforeach
                </select>
              </div>
            </div>
 
            <div class="form-group row">
              <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    </div>

  <div class="d-flex flex-row-reverse bd-highlight mb-3">
      <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#muet" data-inline="true" style="display: inline-block;  width: auto;">
    MUET
  </button>

<!-- Modal -->
<div class="modal fade" id="muet" tabindex="-1" role="dialog" aria-labelledby="muetLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="muetLabel">Add Your Current MUET</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
        <form action="{{ route('enrolment.addMuet') }}" method="POST">
          @csrf

          <div class="form-group row">
            <label for="band" class="col-2 col-form-label">Band</label> 
            <div class="col-7">
              <select id="band" name="band" class="custom-select">
                <option value="">Select Band</option>
                <option value=1.0>1.0</option>
                <option value=2.0>2.0</option>
                <option value=2.5>2.5</option>
                <option value=3.0>3.0</option>
                <option value=3.5>3.5</option>
                <option value=4.0>4.0</option>
                <option value=4.5>4.5</option>
                <option value=5.0>5.0</option>
                <option value=6.0>6.0 / 5+</option>
              </select>
            </div>
          </div> 

          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    </div>

    <form action="{{ route('enrolment.create') }}">
      @csrf

      <div class="input-group mb-3">
        <button class="btn btn-primary" type="submit">Semester</button>
        <select class="form-select col-4" name="search_sem">
          <option value="0">Choose...</option>
          <option value="1">Semester 1</option>
          <option value="2">Semester 2</option>
          <option value="3">Semester 3</option>
          <option value="4">Semester 4</option>
          <option value="5">Semester 5</option>
          <option value="6">Semester 6</option>
          <option value="7">Semester 7</option>
          <option value="8">Semester 8</option>
        </select>
      </div>
    </form>



    <form action="{{ route('enrolment.create') }}">
      @csrf

      <div class="input-group mb-3">
        <button class="btn btn-primary" type="submit" > Search </button>
        <input type="text" class="form-control col-4" placeholder="Subject code or name .." name="search_code" value="{{ request('search_code') }}">
      </div>
    </form>

    <table class="table table-success table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Credit Hour</th>
                <th scope="col">Semester</th>
                <th scope="col">Grade</th>
                <th scope="col">Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datas->where('user_id',Auth::id()) as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->subject_code }}</td>
                <td>{{ $data->sub_name }}</td>
                <td>{{ $data->credit_hour }}</td>
                <td>{{ $data->sem }}</td>
                <td>{{ $data->grade }}</td>
                <td>{{ $data->status }}</td>
                <td>
                  

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-{{ $data->id }}">
                    Edit
                </button>
                  
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{ $data->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Enrolment</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          ...
                          <form action="{{route('enrolment.update', $data->id)}}" method="POST">
                            @csrf

                            <div class="form-group row">
                              <label for="sem" class="col-4 col-form-label">Semester</label> 
                              <div class="col-8">
                                <select id="sem" name="sem" class="custom-select" required="required">
                                  <option value="{{$data->sem}}">{{$data->sem}}</option>
                                  <option value="1">Semester 1</option>
                                  <option value="2">Semester 2</option>
                                  <option value="3">Semester 3</option>
                                  <option value="4">Semester 4</option>
                                  <option value="5">Semester 5</option>
                                  <option value="6">Semester 6</option>
                                  <option value="7">Semester 7</option>
                                  <option value="8">Semester 8</option>
                                </select>
                              </div>
                            </div> 

                              <div class="form-group row">
                                <label for="subject_id" class="col-4 col-form-label">Subject Code</label> 
                                <div class="col-8">
                                  <select name="subject_id" class="form-control" required="required">
                                    <option value="{{ $subject -> id }}">{{ $data -> subject_code }}</option>
                                    @foreach ($subjects as $subject)
                                    <option value="{{ $subject -> id }}" > {{ $subject -> subject_code }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>


                              <div class="form-group row">
                                <label for="result_id" class="col-4 col-form-label">Grade</label> 
                                <div class="col-8">
                                  <select name="result_id" class="form-control" required="required">
                                    <option value="{{ $result -> id }}">{{ $data -> grade }}</option>
                                    @foreach ($results as $result)
                                    <option value="{{ $result -> id }}" > {{ $result -> grade }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="form-group row">
                                <div class="offset-4 col-8">
                                  <button name="submit" type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            <td>
              
                <form action="{{  route('enrolment.destroy', $data->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
                </td>
            </tr>
            @empty

            @endforelse
        </tbody>
    </table>
    
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
       
    </div>

</main>
@endsection