<?php

namespace App\Http\Controllers;

use App\Events\NewFormRequestEvent;
use App\Http\Requests\StoreFormRequest;
use App\Models\FormRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Services\FormRequestService;

class FormRequestController extends Controller
{
    protected FormRequestService $formRequestService;

    public function __construct(FormRequestService $service)
    {
        $this->formRequestService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        Gate::authorize('manage-requests');

        $formRequests = FormRequest::with('author')->get();

        return view('form-request.index')
            ->with([
                'formRequests' => $formRequests,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        Gate::authorize('create-requests');

        return view('form-request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreFormRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreFormRequest $request)
    {
        Gate::authorize('create-requests');

        $storeResult = $this->formRequestService->store($request, auth()->user());

        if (!$storeResult['success']) {
            return back()->withErrors(['msg' => $storeResult['msg'] ?? '']);
        }

        return back()->with([
            'msg' => 'Request created successfully!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return int
     */
    public function update(Request $request, FormRequest $formRequest)
    {
        Gate::authorize('manage-requests');

        return $formRequest->update([
            'theme'     => $request->theme ?? $formRequest->theme,
            'message'   => $request->message ?? $formRequest->message,
            'file_path' => $request->file_path ?? $formRequest->file_path,
            'processed' => $request->processed ?? $formRequest->processed,
        ]);
    }
}
