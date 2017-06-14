<?php

namespace Easel\Http\Controllers\Frontend;

use Auth;
use Easel\Models\Tag;
use Easel\Models\Post;
use Easel\Models\User;
use Easel\Models\Settings;
use Illuminate\Http\Request;
use Easel\Jobs\BlogIndexData;
use Easel\Jobs\BlogFeedData;
use Easel\Jobs\BlogXmlData;
use Easel\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display the blog index page.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tag = $request->get('tag');
        $data = $this->dispatch(new BlogIndexData($tag));
        $layout = $tag ? Tag::layout($tag)->first() : config('blog.tag_layout');
        $socialHeaderIconsUser = User::where('id', Settings::socialHeaderIconsUserId())->first();
        $css = Settings::customCSS();
        $js = Settings::customJS();

        return view($layout, $data, compact('css', 'js', 'socialHeaderIconsUser'));
    }

    /**
     * Display a blog post page.
     *
     * @param $slug
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showPost($slug, Request $request)
    {
        $post = Post::with('tags')->whereSlug($slug)->firstOrFail();
        $socialHeaderIconsUser = User::where('id', Settings::socialHeaderIconsUserId())->first();
        $user = User::where('id', $post->user_id)->firstOrFail();
        $tag = $request->get('tag');
        $title = $post->title;
        $css = Settings::customCSS();
        $js = Settings::customJS();

        if ($tag) {
            $tag = Tag::whereTag($tag)->firstOrFail();
        }

        if (! $post->is_published && ! Auth::check()) {
            return redirect()->route('canvas.blog.post.index');
        }

        $ad1 = $contents = Settings::ad1();
        $ad2 = $contents = Settings::ad2();
        $post->content_html = str_replace('<span id="ad1"></span>', $ad1, $post->content_html);
        return view($post->layout, compact('post', 'tag', 'slug', 'title', 'user', 'css', 'js', 'socialHeaderIconsUser'));
    }

    public function feed(Request $request)
    {
        $tag = $request->get('tag');
        $data = $this->dispatch(new BlogFeedData($tag));

        return response()->view('canvas::frontend.blog.feed', compact('data'))->header('Content-Type', 'application/rss+xml');
    }

    public function sitemap(Request $request)
    {
        $tag = null;
        $data = $this->dispatch(new BlogXmlData($tag));
        return response()->view('canvas::frontend.blog.sitemap', compact('data'))->header('Content-Type', 'application/xml');
    }
}
