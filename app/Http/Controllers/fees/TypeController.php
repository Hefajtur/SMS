<?php

namespace App\Http\Controllers\fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\fees\FeesTypeRequest;
use App\Models\Type;
use App\Services\fees\FeesTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $feesTypeService = new FeesTypeService();
            return $feesTypeService->index();
        }
        return view('dashboard.fees.type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.fees.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeesTypeRequest $request)
    {
        $validateData = $request->validated();
        $feesTypeService = new FeesTypeService();
        return $feesTypeService->create($request);

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    public function edit(string $id)
    {
        $feesTypeService = new FeesTypeService();
        $data= $feesTypeService->edit($id);
        return view('dashboard.fees.type.edit', [
            "type" => $data
        ]);
    }

    public function update(FeesTypeRequest $request, Type $type)
    {
        $validateData = $request->validated();
        $feesTypeService = new FeesTypeService();
        return $feesTypeService->update($request, $type);
    }

    public function destroy(Type $type)
    {
        $feesTypeService = new FeesTypeService();
        return $feesTypeService->destroy($type);   
    }
  
}