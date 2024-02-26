<?php

namespace App\Services\language;

use App\Models\Language;
use Yajra\DataTables\DataTables;

/**
 * Class LanguageService.
 */
class LanguageService
{
    
    // Language Index
    public function index()
    {
        $data = Language::all();
        // dd($data);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="lang_edit" lang_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="lang_del" lang_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make();
    }


    // Create Language
    public function create($request)
    {
        $data = new Language();
        $data->name = $request->name;
        $data->code = $request->code;
        $data->flag_icon = $request->flag_icon;
        $data->direction = $request->lang_dir;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }




    // Update Language
    public function update($request)
    {
        $data = Language::find($request->id);
        $data->name = $request->name;
        $data->code = $request->code;
        $data->flag_icon = $request->flag_icon;
        $data->direction = $request->lang_dir;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }




    // Delete Language
    public function delete($request)
    {
        $del_lang = Language::find($request->id);

        if ($del_lang) {
            $del_lang->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }

}
