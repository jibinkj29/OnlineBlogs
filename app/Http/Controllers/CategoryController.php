<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class CategoryController extends Controller
{
    use HasRoles; 

public function index(Request $request)
{
    
        if ($request->ajax()) 
        {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
               
                $data = Category::all();
            } else {
              
                $data = Category::where('user_id', $user->id)->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
               
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('categories.edit', ['category' => ($row->id)]) . '" class="btn btn-sm btn-icon">Edit</a>';
                    $actionBtn .= '<button class="btn btn-sm btn-icon delete-record" data-id="' . $row->id . '"><i class="ti ti-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                                
                ->rawColumns([ 'action'])
                ->make(true);

        }
        
    
 
    return view('user.Categorys.index');
}

public function create()
{
    return view('user.Categorys.create');
}

public function store(Request $request)
{
    
    $user_id = Auth::id();
    $request->validate([
                'name' => 'required|min:3',
       
    ]);
      
       
    Category::create(['user_id' =>$user_id,'name' => request('name')]);
      
    return response()->json(['status' => true]);
}

public function show(Category $Category)
{
    return view('user.Categorys.show', compact('category'));
}

public function edit(Category $category)
{
 
    return view('user.Categorys.edit', compact('category'));
}



public function update(Request $request, Category $Category)
{

   
    $request->validate([
        'name' => 'required|min:3',
        
    ]);
          
          $Category->update($request->all());
     return response()->json(['status' => true]);
   
}



public function destroy(Category $Category)
{
    $Category->delete();

    return response()->json(['status' => true]);
}
}