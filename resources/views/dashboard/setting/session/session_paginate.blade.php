<table class="table table-bordered table-striped">
    <thead>
        <tr class="text-dark">
            <th scope="col">SR No</th>
            <th scope="col">Name</th>
            <th scope="col">Start date</th>
            <th scope="col">End date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <tbody id="session_tbody">
        @foreach($paginate_session as $session)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $session->name }}</td>
            
            <td>{{ Carbon\Carbon::parse($session->start_date)->format('d M Y') }}</td>
            <td>{{ Carbon\Carbon::parse($session->end_date)->format('d M Y') }}</td>
            <td><span class="{{ ($session->status == 1) ? 'badge_status_act' : 'badge_status_inact' }}">{{ ($session->status == 1) ? 'Active' : 'Inactive' }}</span></td>

            <td>
                <div class="actions_btn">
                    <button class="btn btn-primary mr-2 edit_btn" edit_id="{{ $session->id }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>

                    <button class="btn btn-danger del_btn" del_id="{{ $session->id }}">
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
            {{ $paginate_session->links() }}
        </div>
    </div>
</div>