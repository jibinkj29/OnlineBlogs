<?php 
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $blogs = Blog::with('categories') // Eager load categories to avoid N+1 problem
            ->where('user_id', $user->id)
            ->get();

        $blogsWithCategories = $blogs->map(function ($blog) {
            $categories = $blog->categories->pluck('name')->implode(', ');

            return [
                'id' => $blog->id,
                'name' => $blog->name,
                'categories' => $categories,
                'date' => $blog->date,
                'author' => $blog->author,
                'content' => $blog->content,
                'image' => $blog->image,
            ];
        });

        return response()->json(['blogs' => $blogsWithCategories], 200);
    }
}
