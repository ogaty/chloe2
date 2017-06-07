<?php

namespace Easel\Jobs;

use Carbon\Carbon;
use Easel\Models\Tag;
use Easel\Models\Post;
use Easel\Models\Settings;
use Illuminate\Queue\SerializesModels;

/**
 * Class BlogXmlData.
 */
class BlogXmlData
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
        return $this->xmlData();
    }

    /**
     * Return data for normal index page.
     *
     * @return array
     */
    protected function xmlData()
    {
        $posts = Post::with('tags')
            ->where('published_at', '<=', Carbon::now())
            ->where('is_published', 1)
            ->orderBy('published_at', 'desc')
            ->get();

        $tags = Tag::all();

        return [
            'url' => 'http://chloe.ogatism.com',
            'posts' => $posts,
            'tags' => $tags,
        ];
    }
}
