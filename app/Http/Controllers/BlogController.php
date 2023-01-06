<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categories;
use App\Models\BlogCategory;
use App\Models\Blog;

class BlogController extends Controller
{

    public $categories;
    public $blogCategories;
    public $title;
    public $popular;
    public $tags;
    public $app;

    public function __construct(){

        $this->categories = Categories::where(['active' => 1])->get();
        $this->blogCategories = BlogCategory::where(['active' => 1])->get();
        $this->title = 'Blog';
        $this->popular = Blog::where(['active' => 1])->orderBy('views')->get()->take(5);
        $this->tags = Blog::where(['active' => 1])->orderBy('views')->get('tags');
        $this->app = config('app.name');        
    }

    public function index(){
        
        $parameters = [
            'categories' => $this->categories,
            'blogCategories' => $this->blogCategories,
            'posts' => Blog::where(['active' => 1])->paginate(10),
            'title' => $this->title,
            'app' => $this->app,
            'popular' => $this->popular,
            'tags' => $this->tags
        ];
      
        return view('blog.index', $parameters);
    }

    public function detail(Request $request){

        $blog = Blog::where(['active' => 1 , 'slug' => $request->slug])->first();

        if($blog){
            // get previous post id
            $previous = Blog::where('id', '<', $blog->id)->max('id');

            // get next post id
            $next = BLog::where('id', '>', $blog->id)->min('id');

            Blog::find($blog->id)->increment('views', 1);

            $parameters = [
                'categories' => $this->categories,
                'blogCategories' => $this->blogCategories,
                'post' => $blog,
                'title' => $this->title . '|' . $blog->title,
                'previous' => $previous,
                'next' => $next,
                'popular' => $this->popular,
                'tags' => $this->tags
            ];

            return view('blog.detail.index', $parameters);
        }

        return redirect('home');

    }

    public function category(Request $request){

       $category = BlogCategory::where(['active' => 1 , 'slug' => $request->slug])->first();

       if($category){

            $parameters = [
                'categories' => $this->categories,
                'blogCategories' => $this->blogCategories,
                'posts' => Blog::where(['active' => 1, 'category_id' => $category->id])->paginate(10),
                'title' => $this->title,
                'popular' => $this->popular
            ];

            return view('blog.index', $parameters);
       }
       return redirect('blog');
    }

    public function tags(Request $request){

        $parameters = [
            'categories' => $this->categories,
            'blogCategories' => $this->blogCategories,
            'posts' => Blog::where(['active' => 1])->where('tags', 'like', '%'. $request->tag .'%')->paginate(10),
            'title' => $this->title,
            'popular' => $this->popular
        ];

        return view('blog.index', $parameters);
       
    }
}
