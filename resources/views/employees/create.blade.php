@extends("layout.master")

@section('content')
    <div>
        <div class="subheader-title">
        {{$title}} Employees
        </div>
        <div class="subheader-back" >
        <a href="{{ url('EmployeeList') }}">Back</a>
        </div>
    </div>
    <div style="margin-top:18px;display:flex;justify-content:center">
    <form id="form1" name="form1" method="post" action="{{ ($title=="Create"?url('Employee'):url('Employee/'.$id)) }}"> 
   <table class="ins-table" style="width:100%;min-width:265px">
        <tr>
            <td @if($errors->has('first_name')) style="padding-bottom:18px" @endif>
             First Name 
            </td>
            <td>
                <div>
                    <div>: 
                        <input type="text" id="first_name" name="first_name" value="{{ (isset($data['first_name'])?$data['first_name']:(app('request')->has('first_name')?app('request')->product_id:'')) }}"
                         placeHolder="Please Enter the First Name" />
                        <span class="required">*</span>
                    </div>
                    <div>
                        @if($errors->has('first_name'))
                            <div class="error">{{ str_ireplace('first name','First Name',$errors->first('first_name')) }}</div>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td @if($errors->has('last_name')) style="padding-bottom:18px" @endif>
            Last Name 
            </td>
            <td>
                <div>
                    <div>: 
                        <input type="text" maxlength="100" id="last_name" name="last_name" value="{{ (isset($data['last_name'])?$data['last_name']:(app('request')->has('last_name')?app('request')->last_name:'')) }}" 
                        placeHolder="Please Enter the Last Name" />
                        <span class="required">*</span>
                    </div>
                    <div>
                        @if($errors->has('last_name'))
                            <div class="error">{{ str_ireplace('last name','Last Name',$errors->first('last_name')) }}</div>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td @if($errors->has('willing_to_work')) style="padding-bottom:18px" @endif>
            Willing To Relocate 
            </td>
            <td>
                <div>
                    <div>: 
                        <input value="1" type="checkbox" id="willing_to_work" name="willing_to_work" {{ ((isset($data['willing_to_work']) && $data['willing_to_work'])?"checked":((app('request')->has('willing_to_work')&& app('request')->willing_to_work==1)?"checked":'')) }}" 
                         /> Yes
                        
                        <span class="required">*</span>
                    </div>
                    <div>
                        @if($errors->has('willing_to_work'))
                            <div class="error">{{ str_ireplace('willing_to_work','Willing To Relocate',$errors->first('willing_to_work')) }}</div>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
		<tr>
            <td @if($errors->has('language_known')) style="padding-bottom:18px" @endif>
            Langusge Known 
            </td>
            <td>
                <div>
                    <div>: 
                        <select id="language_known" name="language_known" value="{{ (isset($data['language_known'])?$data['language_known']:(app('request')->has('language_known')?app('request')->language_known:'')) }}" 
                         >
						 <?php echo $language_known_opt ?>
						 </select>
                        <span class="required">*</span>
                    </div>
                    <div>
                        @if($errors->has('language_known'))
                            <div class="error">{{ str_ireplace('language known','Language Known',$errors->first('language_known')) }}</div>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
        
        <tr>
            <td colspan="2" align="center">
                <input type="submit" id="bt1" name="bt1" value="Submit" />
                <input type="hidden" id="id" name="id" value="{{ ($title=='Update'?$id:0)}}" />
                @csrf
            </td>
        </tr>
    </table>
</div>

@stop

@push('scripts')
<script>

</script>
@endpush
