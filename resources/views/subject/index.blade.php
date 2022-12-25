@extends('layouts.layout')

@section('content')
<main role="main" class="container">
    <h1 class="text-center mt-5">Subject List</h1>
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Add Subject
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Subject</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
          <form action="{{ route('subject.store') }}" method="POST">
            @csrf
            <div class="form-group row">
              <label for="subject_code" class="col-4 col-form-label">Subject Code</label> 
              <div class="col-8">
                <input id="subject_code" name="subject_code" type="text" class="form-control" required="required">
              </div>
            </div>
            <div class="form-group row">
              <label for="sub_name" class="col-4 col-form-label">Subject Name</label> 
              <div class="col-8">
                <input id="sub_name" name="sub_name" type="text" class="form-control" required="required">
              </div>
            </div> 
            <div class="form-group row">
              <label for="category" class="col-4 col-form-label">Category</label> 
              <div class="col-8">
                <select id="category" name="category" class="custom-select">
                  <option value="core">Core</option>
                  <option value="elective">Elective</option>
                  <option value="university">University</option>
                </select>
              </div>
            </div> 
            <div class="form-group row">
                <label for="credit_hour" class="col-4 col-form-label">Credit Hour</label> 
                <div class="col-8">
                  <input id="credit_hour" name="credit_hour" type="number" class="form-control" required="required">
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
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Subject Code</th>
                <th scope="col">Subject Name</th>
                <th scope="col">Category</th>
                <th scope="col">Credit Hour</th>  
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subjects as $subject)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subject->subject_code }}</td>
                <td>{{ $subject->sub_name }}</td>
                <td>{{ $subject->category }}</td>
                <td>{{ $subject->credit_hour }}</td>
                <td>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-{{ $subject->id }}">
                        Edit
                      </button>
                      
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal-{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{ $subject->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              ...
                              <form action="{{route('subject.update', $subject->id)}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="subject_code" class="col-4 col-form-label">Subject Code</label> 
                                    <div class="col-8">
                                      <input id="subject_code" name="subject_code" type="text" class="form-control" required="required"> {{$subject->subject_code}}
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="sub_name" class="col-4 col-form-label">Subject Name</label> 
                                    <div class="col-8">
                                      <input id="sub_name" name="sub_name" type="text" class="form-control" required="required">{{$subject->sub_name}}
                                    </div>
                                  </div> 
                                  <div class="form-group row">
                                    <label for="category" class="col-4 col-form-label">Category</label> 
                                    <div class="col-8">
                                      <select id="category" name="category" class="custom-select">
                                        <option value="core">Core</option>
                                        <option value="elective">Elective</option>
                                        <option value="university">University</option>
                                      </select>{{$subject->category}}
                                    </div>
                                  </div> 
                                  <div class="form-group row">
                                      <label for="credit_hour" class="col-4 col-form-label">Credit Hour</label> 
                                      <div class="col-8">
                                        <input id="credit_hour" name="credit_hour"  type="number"  class="form-control" required="required">{{$subject->credit_hour}}
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


                    <form action="{{  route('subject.destroy', $subject->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                        <button name="submit" type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>

            </tr>
            @empty

            @endforelse
        </tbody>
    </table>
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
       
    </div>
</main>
@endsection