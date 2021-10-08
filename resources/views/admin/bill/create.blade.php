@extends('layouts.admin')
@section('main')

<h1>Add Bill</h1>
<a class="btn btn-secondary" href="{{ url()->previous() }}
">Go back</a>
<hr>
<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
                Grade
            </button>
    <div class="dropdown-menu" aria-labelledby="triggerId">
        @foreach ($grade as $item)
            <a class="dropdown-item" href="{{ route('bill.filter', $idGrade = $item->id) }}">{{ $item->name }}</a>
            <div class="dropdown-divider"></div>
        @endforeach        
    </div>
</div>
<form action="" class="form-inline" method="get">
    @csrf
    <div class="form-group">
        {{-- {{$key}} --}}
        <input class="form-control" name="search" value="{{$search}}" class="form-control" placeholder="Enter name..." aria-describedby="helpId">
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <td>ID</td>
                <th>Student</th>
                <th>Email</th>
                <th>Grade</th>
                <th>DOB</th>
                <th>Course</th>
                <th>Major</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($student as $st)    
            <tr>
                <td>{{$st->id}}</td>
                <td>{{($st->firstname).
                    " ".($st->lastname)}}</td> 
                <td>{{$st->email}}</td>              
                <td>{{$st->grade->name}}</td>              
                <td>{{$st->dob}}</td>              
                <td>{{$st->grade->course->name}}</td>              
                <td>{{$st->grade->major->name}}</td>               
                <td>
                    <a href="javascript:void(0)" data-target="#modelId" data-toggle="modal" data-id="{{$st->id }}" class="btn btn-info button_add_bill">Add bill</a>
                </td>
                           
            </tr>
        @endforeach    
        </tbody>
    </table>
    <div class="">
        {{$student -> appends(request()->all())->links()}}
    </div>
@endsection

    {{-- @section('js') --}}
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.button_add_bill').click(function(e){
                var idStudent = $(this).data('id');
                $.ajax({
                type:"POST",
                data: {
                    _token: $("#csrf").val(),
                    id:idStudent,
                },
                url: "{{route('bill.add')}}",
                context: this,
                dataType: 'json',
                success: function(response){
                    resultData = response.student;
                    resultTuition = response.studentTuition;
                    resultScholarship = response.studentScholarship;


                    idStudent = resultData.idStudent;
                    firstname = resultData.firstname;
                    lastname = resultData.lastname;
                    idTypePay = resultData.idTypePay;
                    typeofpay = resultData.typeofpay;

                    tuitionNorm = resultTuition.tuitionNorm;
                    nameGrade = resultTuition.namegGade;
                    dob = resultTuition.dob;
                    moneyScholarship = resultScholarship.money;
                    
                    moneyYear = Math.round((tuitionNorm - moneyScholarship)/3);
                    // alert(moneyYear);
                    if(idTypePay == 1){
                        moneyResult = moneyYear/10;
                    }else if(idTypePay == 2){
                        moneyResult = moneyYear/2;
                    }else if(idTypePay == 3){
                        moneyResult = moneyYear;
                    }
                    console.log(idStudent);
                    $("input[name='idStudent']").val(idStudent);
                    $("label[name='firstname']").html(firstname);
                    $("label[name='lastname']").html(lastname);
                    $("input[name='typeofpay']").val(typeofpay);
                    $("input[name='idTypePay']").val(idTypePay);
                    $("input[name='money']").val(moneyResult);              
                    $("input[name='dob']").val(dob);              
                    $("input[name='nameGrade']").val(nameGrade);              
                }
            });
        });
    });
          
    </script>

{{-- @endsection --}}
@stop
<!-- Button trigger modal -->
        
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Bill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bill.store') }}">
                    <div class="form-group">

                        <label name='firstname' for="firstname"></label>                      
                        <label name='lastname' for="lastname"></label>
                        <input type="hidden" class="form-control" name="idStudent">
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>                     
                        <input type="text" class="form-control" name="nameGrade" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="dob">DOB</label>                     
                        <input type="text" class="form-control" name="dob" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="idTypePay">Type of Pay</label>                     
                        <input type="hidden" class="form-control" name="idTypePay">
                        <input type="text" class="form-control" name="typeofpay" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="money">Money</label>                     
                        <input type="text" class="form-control" name="money">
                    </div>
                    <div class="form-group">
                        <label for="dateTime">Date</label>                  
                        <input type="text" class="form-control" name="dateTime" value="{{Carbon\Carbon::now();}}">
                    </div>
                    <div class="form-group">
                        <label for="idAdmin">Admin</label>                    
                        <input type="hidden" class="form-control" name="idAdmin" value="{{ Session::get('admin')->id }}">
                        <input type="text" class="form-control" value="{{ Session::get('admin')->name }}">
                    </div>
                     <div class="form-group">
                        <label for="note">Note</label>                    
                        <textarea name="note" rows="4" cols="50">Học phí {{Carbon\Carbon::now()->format('m-Y');}}</textarea>
                    </div>
                    <button class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
            </div>
        </div>
    </div>
</div>