<table class="table table-bordered table-striped">
    <thead>
        <tr class="text-dark">
            <th scope="col">SR No</th>
            <th scope="col">Name</th>
            <th scope="col">Code</th>
            <th scope="col">Icon</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <tbody id="lang_tbody">
        @foreach($paginate_lang as $lang)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lang->name }}</td>
            <td>{{ $lang->code }}</td>
            <td>{{ $lang->flag_icon }}</td>

            <td>
                <div class="actions_btn">
                    <button class="btn btn-primary mr-2" id="edit_btn" edit_id="{{ $lang->id }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>

                    <button class="btn btn-danger" id="del_btn" del_id="{{ $lang->id }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="paginate_nav row">
    <div class="col-12">
        <div class="pagination_button float-right mt-5">
            {{ $paginate_lang->links() }}
        </div>
    </div>
</div>