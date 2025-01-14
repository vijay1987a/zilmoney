@extends("layout.master")

@section('content')
    <div>
        <div class="subheader-title" >
        Employee List
        </div>
    </div>
    @csrf
    <div title="Add Product" style="text-align:right" onclick="redirect_page()" class="tab-link add-button">
    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="35px" height="35px">    <path d="M25,2C12.317,2,2,12.317,2,25s10.317,23,23,23s23-10.317,23-23S37.683,2,25,2z M37,26H26v11h-2V26H13v-2h11V13h2v11h11V26z"/></svg>
    </div>
    <div>Total : {{$total}}</div>
    <div>
    <table border="1" class="list-table">

    <!-- header -->
    <tr>
    @foreach($cols as $col=>$header)
    <th>{{$header}}</th>
    @endforeach
    <th>Action</th>
    </tr>

<?php
        //sno calculation
        $i = ($data->currentpage()-1)* $data->perpage() + 1;
        $start=$i;
        $lalign=["name"];
        ?>

    <!-- content -->
    @foreach($data as $iter)
    <tr>
        @foreach($cols as $col=>$header)
        @if($col=="id")
            <td align="center">{{
            $start++
            }}</td>
        @else
            @if(in_array($col,$lalign))
            <td style="padding-left:5px" align="left">{{$iter[$col]}}</td>
            @else
            <td style="padding-right:5px" align="right">{{$iter[$col]}}</td>
            @endif
        @endif
        @endforeach
        <!-- Edit,Delete,View Links -->
        <td>
            <div class="action-tab">
                <div class="action-sub-tab">
                <a href="{{ url('Employee/'.$iter['id'].'/view') }}" class="tab-link">View</a>
                </div>
                <div class="action-sub-tab">
                <a href="{{ url('Employee/'.$iter['id'].'/edit') }}" class="tab-link">Edit</a>
                </div>
                <div class="action-sub-tab">
                <span onclick="delete_record({{ $iter['id'] }})" class="tab-link">Delete</span>
                </div>
            </div>
        </td>
    </tr>
    @endforeach

</table>

{{ $data->links('pagination::bootstrap-4') }}
</div>

@stop

@push('scripts')
<script>
//insert page
function redirect_page()
{
window.location.href="{{url('Employee/create')}}";
}
//delete record
function delete_record(id)
{
if("undefined" != typeof id && "" != id)
{
var data={
_token:$("input[name='_token']").val(),
id:id
};
var url="{{url('deleteEmployee')}}";
$.post(url,data,(res)=>{
if(res.status)
{
alert("Deleted Succesfully");
window.location.reload();
}
else
alert(res.errMsg);

})
}
else
alert("Invalid id");
}
</script>
@endpush
