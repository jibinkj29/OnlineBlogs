<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class BlogController extends Controller
{
    use HasRoles;

public function index(Request $request)
{
    
        if ($request->ajax()) 
        {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
               
                $data = Blog::all();
            } else {
              
                $data = Blog::where('user_id', $user->id)->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    return '<img src="' . asset('storage/'.$row->image) . '" alt="Image" width="50" height="50">';
                })
                ->editColumn('content', function ($row) {
                    return $row->content;
                })
                ->addColumn('category', function ($row) {
                  
                    $categories = $row->categories->pluck('name')->implode(', ');
                    return $categories;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('blogs.edit', ['blog' => ($row->id)]) . '" class="btn btn-sm btn-icon">Edit</a>';
                    $actionBtn .= '<button class="btn btn-sm btn-icon delete-record" data-id="' . $row->id . '"><i class="ti ti-trash"></i></button>';
                    return $actionBtn;
                })
                                                
                ->rawColumns(['image', 'action','content','category'])
                ->make(true);

        }
        
    
 
    return view('user.blogs.index');
}

public function create()
{
    $user = Auth::user();
    if ($user->hasRole('admin')) {
               
        $category = Category::pluck('name','id')->all();
    } else {
      
        $category = Category::where('user_id', $user->id)->pluck('name', 'id');

    }
   
    return view('user.blogs.create' , compact('category'));
}

public function store(Request $request)
{
    
    $user_id = Auth::id();
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'name' => 'required|min:3',
        'category' => 'required|array',
        'author' => 'required|min:3',
        'date' => 'required',
        'content' => 'required|min:20'
    ]);
      
    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->storeAs('public/images', $imageName);  
    
    $blog=Blog::create(['user_id' =>$user_id,'name' => request('name'),'date' => request('date'),'author' => request('author'),'content' => request('content'),'image' => 'images/'.$imageName]);
    $categories = $request->input('category', []); 
    $blog->categories()->attach($categories, ['post_id' => $blog->id]);

    return response()->json(['status' => true]);
}

public function show(Blog $blog)
{
    return view('user.blogs.show', compact('blog'));
}

public function edit(Blog $blog)
{
    $user = Auth::user();
    if ($user->hasRole('admin')) {
               
        $category = Category::pluck('name','id')->all();
    } else {
      
        $category = Category::where('user_id', $user->id)->pluck('name', 'id');

    }
    $selectedcategory = DB::table('category_posts')->where('post_id', $blog->id)->get();
   
    return view('user.blogs.edit', compact('blog','category','selectedcategory'));
}



public function update(Request $request, Blog $blog)
{

   
    $request->validate([
        'name' => 'required|min:3',
        'category' => 'required|array',
        'author' => 'required|min:3',
        'date' => 'required',
        'content' => 'required|min:20'
    ]);
          
    if ($request->hasFile("image")) {
       
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName);
        $blog->update(array_merge($request->except('image','category'), ['image' => 'images/' . $imageName]));
        } else {
            $blog->update($request->except('image','category'));
        }

        $categories = $request->input('category', []); 
        $blog->categories()->sync($categories, ['post_id' => $blog->id]);

     return response()->json(['status' => true]);
   
}



public function destroy(Blog $blog)
{
    $blog->delete();

    return response()->json(['status' => true]);
}
}