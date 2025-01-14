@extends("layout.master")

@section('content')
    <div>
        <div class="subheader-title">
        View Employees
        </div>
        <div class="subheader-back" >
        <a href="{{ url('EmployeeList') }}">Back</a>
        </div>
    </div>
    
    <div class="view-div">
        <table  class="view-table">

        <!-- content -->
        
            @foreach($cols as $col=>$header)
            @if($col!="id")
            <tr><td align="left">{{ $header }}</td><td align="left">: {{$data[$col]}}</td></tr>
            @endif
            @endforeach

        </table>
    </div>

@stop

@push('scripts')
<script>
</script>
@endpush
