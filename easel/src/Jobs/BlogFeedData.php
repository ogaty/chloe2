<?php

namespace Easel\Jobs;

use Carbon\Carbon;
use Easel\Models\Tag;
use Easel\Models\Post;
use Easel\Models\Settings;
use Illuminate\Queue\SerializesModels;

/**
 * Class BlogIndexData.
 */
class BlogFeedData
{
    use SerializesModels;

    protected $tag;

    /**
     * Constructor.
     *
     * @param string|null $tag
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Execute the command.
     *
     * @return array
     */
    public function handle()
    {
        if ($this->tag) {
            return $this->tagFeedData($this->tag);
        }

        return $this->normalFeedData();
    }

    /**
     * Return data for a tag index page.
     *
     * @param string $tag
     * @return array
     */
    protected function tagFeedData($tag)
    {
        $tag = Tag::where('tag', $tag)->firstOrFail();

        $reverse_direction = (bool) $tag->reverse_direction;

        $posts = Post::where('published_at', '<=', Carbon::now())
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('id', '=', $tag->id);
            })
            ->where('is_published', 1)
            ->orderBy('published_at', $reverse_direction ? 'asc' : 'desc')
            ->simplePaginate(config('blog.posts_per_page'));

        $posts->addQuery('tag', $tag->tag);

        $page_image = $tag->page_image ?: config('blog.page_image');

        return [
            'title' => $tag->title,
            'subtitle' => $tag->subtitle,
            'posts' => $posts,
            'page_image' => $page_image,
            'tag' => $tag,
            'reverse_direction' => $reverse_direction,
            'meta_description' => $tag->meta_description ?: \
            Settings::where('setting_name', 'blog_description')->find(1),
        ];
    }

    /**
     * Return data for normal index page.
     *
     * @return array
     */
    protected function normalFeedData()
    {
        $posts = Post::with('tags')
            ->where('published_at', '<=', Carbon::now())
            ->where('is_published', 1)
            ->orderBy('published_at', 'desc')
            ->simplePaginate(config('blog.posts_per_page'));

        return [
            'title' => Settings::blogTitle(),
            'subtitle' => Settings::blogSubTitle(),
            'url' => 'http://chloe.ogatism.com',
            'posts' => $posts,
            'page_image' => config('blog.page_image'),
            'meta_description' => Settings::blogDescription(),
            'reverse_direction' => false,
            'tag' => null,
        ];
    }
}
