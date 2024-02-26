<?php

namespace App\Http\Controllers\session;

use App\Http\Controllers\Controller;
use App\Http\Requests\setting\SessionRequest;
use App\Models\SchoolSession;
use App\Services\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public $data = [];

    // Session Index
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new SessionService();
            return $res->index();
        }
        return view('dashboard.setting.session.index');
    }



    // Create Add Session Form
    public function create()
    {
        return view('dashboard.setting.session.create_session');
    }


    // Store Session Data
    public function store(SessionRequest $request)
    {

     
        $validateData = $request->validated();
        $createSession = new SessionService();
        $data = $createSession->create($request);

        return $data;
    }




    // Edit Session Data
    public function edit(SchoolSession $schoolSession)
    {
    //    dd($schoolSession);
        return view('dashboard.setting.session.edit_session', [
            'edit_data' => $schoolSession,
        ]);
    }




    // update Session Data
    public function update(SessionRequest $request, SchoolSession $schoolSession)
    {

        die();
     dd($schoolSession);
        $validateData = $request->validated();
        $updateSession = new SessionService();
        $data = $updateSession->update($request, $schoolSession);

        return $data;
        
    }



    // Delete Session Data
    public function destroy(SchoolSession $session)
    {
        $deleteSession = new SessionService();
        return $deleteSession->delete($session);
    }
}
