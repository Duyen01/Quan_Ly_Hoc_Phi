@extends('layouts.admin')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')

<h1>List Tuition</h1>
<form class="form-inline" method="get">
    @csrf
    <div class="form-group">
        <input type="text" name="key" value="{{ $key }}" class="form-control" placeholder="Enter tuition..." aria-describedby="helpId">
    </div>
    <button class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<hr>
<div class="alert">

</div>
<a href="{{route('tuition.create')}}" class="btn btn-primary">Add tuition</a>
<hr>
    <div id="step1Content">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Course</th>
                    <th>Major</th>
                    <th>Standard tuition</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $key => $tuition)    
                <tr>
                    <td>{{$key + 1}}</td>
                    {{-- <td><input type="text" id="course" value="{{ $tuition->idCourse }}"></td>
                    <td><input type="text" id="major" value="{{ $tuition->idMajor }}"></td> --}}
                    <td>{{$tuition->course_name}}</td>
                    <td>{{$tuition->major_name}}</td>
                    <td>{{number_format($tuition->tuitionNorm)}}đ </td>
                    <td>
                        {{-- {{route('tuition.edit',['idCourse' => $tuition->idCourse,'idMajor' => $tuition->idMajor])}} --}}
                        <button id="editTuition" data-idCourse="{{ $tuition->idCourse }}" data-idMajor="{{ $tuition->idMajor}}"data-toggle="modal" data-target="#modelId" href="" class="btn btn-success">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            @endforeach    
            </tbody>
        </table>
    </div>
    <hr>
    <div class="">
        {{$data -> appends(request()->all())->links()}}
    </div>
    @stop()

    @section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                
            $('body').on('click', '#editTuition', function(e){
                let idCourse = $(this).attr('data-idCourse');
                let idMajor = $(this).attr('data-idMajor');
                // alert(idCourse + '' + idMajor);
                $.ajax({
                type:"POST",
                url: "{{route('tuition.edit')}}",
                data: {
                    _token: '{{csrf_token()}}',
                    idCourse:idCourse,
                    idMajor:idMajor,
                },              
                dataType: 'json',
                success: function(response){                
                    let resultData = response.tuition;              
                 
                    $("#tuitionNorm").val(resultData.tuitionNorm);
                    $("#courseUpdate").val(resultData.idCourse);
                    $("#majorUpdate").val(resultData.idMajor);
                                                   
                }
            });
        });
        $('#update-tuition').click(function(e){
            let tuitionNorm = $('#tuitionNorm').val();
            let courseUpdate = $('#courseUpdate').val();
            let majorUpdate = $('#majorUpdate').val();

            $.ajax({
                type:"POST",
                url: "{{ route('tuition.update') }}",
                context: this,
                data: {
                    _token: '{{csrf_token()}}',
                    tuitionNorm:tuitionNorm,
                    courseUpdate:courseUpdate,
                    majorUpdate:majorUpdate,
                },
               success: function(result){
                   if(result.success){
                    $('#step1Content').load(location.href + " #step1Content");
                    jQuery('#modelId').modal('hide');
                    // jQuery('#openModal').hide();
                   
                    jQuery('.alert').addClass("alert-success");
                   jQuery('.alert-success').html(result.success);
                   
                   setTimeout(function(){ jQuery('.alert-success').hide(); }, 3000);
                   }
               }
            })
        })
    });
          
    </script>
   @stop()
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tuition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                {{-- <form action="{{ route('tuition.update') }}" class="was-validated" method="POST" enctype="multipart/form-data"> --}}
                    {{-- @csrf
                    @method('PUT') --}}
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="hidden" id="majorUpdate" value="">
                                <input type="hidden" id="courseUpdate" value="">
                                <label for="tuitionNorm">Standard tuition:</label>
                                <input type="text" class="form-control" name="tuitionNorm" value="" id="tuitionNorm">
                                @error('tuitionNorm')
                                <small class="help-block">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button id="update-tuition" class="btn btn-primary">Update</button>
                {{-- </form>  --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>