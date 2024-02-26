

<table class="table ">
    
    <thead>
        <tr>
            <th>Sr No</th>
            <th>Name</th>
            <th>Point</th>
            <th>Percent Form</th>
            <th>Percent UpTo</th>
            <th>Remark</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($marks as $value)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->point}}</td>
            <td>{{ $value->parcent_from }}</td>
            <td>{{ $value->parcent_upto }}</td>
            <td>{{ $value->remarks }}</td>
            <td>{{ $value->status==1 ? 'active' : 'inactive'}}</td>
            <td><button id='marks_grade_edit' marks_grade_id="{{$value->id}}"><i class='fa-solid fa-pen-to-square'></i></button> <button id='marks_grade_delete' marks_grade_id="{{$value->id}}"><i class='fa-solid fa-trash'></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $marks->render() !!}
