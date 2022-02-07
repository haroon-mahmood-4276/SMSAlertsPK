<?php

namespace App\Http\Controllers;

use App\Models\{Group};
use App\Rules\{CheckGroupCode};
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\{Request};
use Illuminate\Support\{Str};


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if( !request()->ajax() ) {
            $data = [
                'groups' => ( new Group() )->getAllWithPaginate(50),
            ];
            return view('group.index', $data);
        } else {
            return ApiErrorResponse('ajax request is not supported');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\JsonResponse
     */
    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
            $request->validate([
                'code' => [ 'bail', 'required', 'numeric', 'digits:5', new CheckGroupCode() ],
                'name' => 'bail|required|between:1,50',
            ]);
            try {
                if( !request()->ajax() ) {
                    $response = ( new Group() )->storeGroup($request->post());

                    if( $response ) {
                        return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
                    } else {
                        return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
                    }
                } else {
                    return ApiErrorResponse('ajax request is not supported');
                }
            } catch( Exception $ex ) {
                return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
            }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request, $id )
    {
        try {
            if( !request()->ajax() ) {
                $id = decryptParams($id);

                $data = [
                    'group' => ( new Group() )->find($id),
                ];
                return view('group.edit', $data);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch( Exception $ex ) {
            return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        $request->validate([
            'name' => 'bail|required|between:1,50',
        ]);
        try {
            if( !request()->ajax() ) {
                $id = decryptParams($id);


                $data = [
                    'name' => $request->name,
                ];

                $response = ( new Group() )->where('id', $id)->update($data);

                if( $response ) {
                    return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
                } else {
                    return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
                }
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch( Exception $ex ) {
            return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request )
    {
        try {
            if( !request()->ajax() ) {
                $AlertType = "";
                $AlertMsg = "";
                $response = false;
                if( $request->group_ids != null ) {
                    $request->group_ids = array_map('decryptParams', $request->group_ids);
                    $response = ( new Group() )->whereIn('id', $request->group_ids)->delete();
                    $AlertType = "success";
                    $AlertMsg = "Selected data deleted";
                } else {
                    $AlertType = "warning";
                    $AlertMsg = "Please select atleast one row.";
                }

                return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch( Exception $ex ) {
            return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    public function deleteAll()
    {
        try {
            if( !request()->ajax() ) {
                $response = ( new Group() )->deleteAllGroups();
                $AlertType = "success";
                $AlertMsg = "Data deleted";

                if( $response ) {
                    return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
                } else {
                    return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
                }
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch( Exception $ex ) {
            return redirect()->route(( session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index' ))->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    public function CheckGroupCodeExistance( Request $request )
    {
        if( $request->has('code') ) {
            $group = ( new Group() )->checkCode(filter_strip_tags($request->code));

            if( $group ) {
                return response()->json([ 'This code is taken.' ]);
            }
            return "true";
        }
    }
}
