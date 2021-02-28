<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vinyl\BulkDestroyVinyl;
use App\Http\Requests\Admin\Vinyl\DestroyVinyl;
use App\Http\Requests\Admin\Vinyl\IndexVinyl;
use App\Http\Requests\Admin\Vinyl\StoreVinyl;
use App\Http\Requests\Admin\Vinyl\UpdateVinyl;
use App\Models\Vinyl;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VinylsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexVinyl $request
     * @return array|Factory|View
     */
    public function index(IndexVinyl $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Vinyl::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'author', 'year'],

            // set columns to searchIn
            ['id', 'name', 'author', 'year']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.vinyl.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.vinyl.create');

        return view('admin.vinyl.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVinyl $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreVinyl $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Vinyl
        $vinyl = Vinyl::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/vinyls'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/vinyls');
    }

    /**
     * Display the specified resource.
     *
     * @param Vinyl $vinyl
     * @throws AuthorizationException
     * @return void
     */
    public function show(Vinyl $vinyl)
    {
        $this->authorize('admin.vinyl.show', $vinyl);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vinyl $vinyl
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Vinyl $vinyl)
    {
        $this->authorize('admin.vinyl.edit', $vinyl);


        return view('admin.vinyl.edit', [
            'vinyl' => $vinyl,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateVinyl $request
     * @param Vinyl $vinyl
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateVinyl $request, Vinyl $vinyl)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Vinyl
        $vinyl->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/vinyls'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/vinyls');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyVinyl $request
     * @param Vinyl $vinyl
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyVinyl $request, Vinyl $vinyl)
    {
        $vinyl->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyVinyl $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyVinyl $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['id'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Vinyl::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
