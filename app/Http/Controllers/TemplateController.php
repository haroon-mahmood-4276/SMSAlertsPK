<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if( !request()->ajax() ) {

            $data = [
                'Templates' => ( new Template() )->getAll(),
            ];

            return view('template.index', $data);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store( Request $request )
    {
        $request->validate([
            'name' => 'bail|required|between:1,50',
            'template' => 'bail|required|between:1,255',
        ]);
        try {
            if( !request()->ajax() ) {

                $response = ( new Template() )->storeTemplate($request->post());

                if( $response ) {
                    return redirect()->route('templates.index')->with('AlertType', 'success')->with('AlertMsg', 'Data saved.');
                } else {
                    return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data not saved.');
                }
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch( Exception $ex ) {
            return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show( $id ) : Response
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|JsonResponse|RedirectResponse|View
     */
    public function edit( $id )
    {
        try {
            if( !request()->ajax() ) {
                $data = [
                    'Template' => ( new Template() )->find(decryptParams($id)),
                ];
//                dd($data);

                return view('template.edit', $data);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch( Exception $ex ) {
            return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse|RedirectResponse
     */
    public function update( Request $request, $id )
    {
        $request->validate([
            'name' => 'bail|required|between:1,50',
            'template' => 'bail|required|between:1,255',
        ]);
        try {
            if( !request()->ajax() ) {

                $response = ( new Template() )->updateTemplate($request->post(), $id);

                if( $response ) {
                    return redirect()->route('templates.index')->with('AlertType', 'success')->with('AlertMsg', 'Data updated.');
                } else {
                    return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data not updated.');
                }
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch( Exception $ex ) {
            return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse|RedirectResponse
     */
    public function destroy( Request $request, $id )
    {
        try {
            if( !request()->ajax() ) {
                $AlertType = "";
                $AlertMsg = "";
                $response = false;
                if( $request->template_ids != null ) {
                    $request->template_ids = array_map('decryptParams', $request->template_ids);
                    $response = ( new Template() )->whereIn('id', $request->template_ids)->delete();
                    $AlertType = "success";
                    $AlertMsg = "Selected data deleted";
                } else {
                    $AlertType = "warning";
                    $AlertMsg = "Please select atleast one row.";
                }

                return redirect()->route('templates.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
            } else {
                return ApiErrorResponse('ajax request is not supported');
            }
        } catch( Exception $ex ) {
            return redirect()->route('templates.index')->with('AlertType', 'danger')->with('AlertMsg', $ex->getMessage());
        }
    }

    public function deleteAll( Request $request )
    {

        try {
            if( !request()->ajax() ) {
                $response = ( new Template() )->deleteAllTemplates();
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




















        // return $request->template_ids;
        $AlertType = "";
        $AlertMsg = "";
        try {
            if( $request->template_ids != null ) {
                Template::whereIn('id', $request->template_ids)->delete();
                $AlertType = "success";
                $AlertMsg = "Selected data deleted";
            } else {
                $AlertType = "warning";
                $AlertMsg = "Please select atleast one row.";
            }
        } catch( \Illuminate\Database\QueryException $ex ) {
            if( $ex->getCode() == 23000 ) {
                $AlertType = "danger";
                $AlertMsg = "These selected sections linked with other data, therefore system cannot delete them.";
            } else {
                $AlertType = "danger";
                $AlertMsg = "Something went wrong";
            }
        }
        return redirect()->route('templates.index')->with('AlertType', $AlertType)->with('AlertMsg', $AlertMsg);
    }
}
