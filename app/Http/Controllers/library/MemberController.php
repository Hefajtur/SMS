<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use App\Http\Requests\library\MemberRequest;
use App\Models\Gender;
use App\Models\library\MemberCategory;
use App\Models\Member;
use App\Models\User;
use App\Services\library\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $users;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new MemberService();
            return $res->index();
        }

        return view('dashboard.library.member.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.library.member.create', [
            'member_cats' => MemberCategory::all(),
            // 'members' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        
        $validateData = $request->validated();
        $book = new MemberService();
        $data = $book->create($request);
       
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {

        return view('dashboard.library.member.edit', [
            'members' => $member,
            'users' => User::all(),
            'member_cats' => MemberCategory::all(),
            'genders' => Gender::all(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        // dd($member);
        // $validateData = $request->validated();
        $updateBook = new MemberService();
        $data = $updateBook->update($request, $member);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        // dd($religion);
        $deleteBook = new MemberService();
        return $deleteBook->delete($member);
    }





    // Get All Member
    // public function getAllMember(Request $request)
    // {
    //     dd($request->search);
    //     $search = $request->search;
    //     if($search == '') {
    //         $this->users = User::select('id', 'name')
    //         ->get();
    //     }else {
    //         $this->users = User::where('name', 'like', '%'.$search.'%')
    //         ->select('id', 'name')            
    //         ->get();
    //     }
    //     dd($this->users);
    //     $response = [];
    //     foreach($this->users as $user) {
    //         echo '<pre>';
    //         print_r($user);
    //         $response[] = [
    //             'id' => $user->id,
    //             'text' => $user->name,
    //         ];
    //     }

    //     echo json_encode($response);
    //     exit;
    // }


    public function getAllMember(Request $request)
    {
        $search = $request->term;
        if($search != '') {
            $users = User::where('name', 'LIKE', '%' . $search . '%')->get();
 
            $response = [];
            $i = 0;
            foreach ($users as $user) {
                $response[$i]['id'] = $user->id;
                $response[$i]['text'] = $user->name;
                $i++;
            }
        }else {
            $users = '';
        }
        
        return response()->json($response);
    }

}
