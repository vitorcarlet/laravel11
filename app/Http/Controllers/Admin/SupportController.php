<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Services\SupportService;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $service
    )
    {
        
    }

    public function index(Request $request)
    {
        $supports = $this->service->getAll($request->filter);
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 3),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];

        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function create(){
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request, Support $support){
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );
        
        return redirect()->route('supports.index');
    }

    public function show(string $id){
       if(!$support = $this->service->findOne($id)) {
        return back();
       }
        return view('admin/supports/show', compact('support'));
    }

    public function edit(string $id){
        //if(!$support = $support::where('id', $id)->first()) 
        if(!$support = $this->service->findOne($id)){
            return back();
           }

        return view('admin/supports.edit',compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, string|int $id){
        
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );
        
        if(!$support) {
            return back();
           }



        return redirect()->route('supports.index');
    }

    public function destroy(string $id){
            $this->service->delete($id);

           return redirect()->route('supports.index');
    }
}
