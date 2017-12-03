<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>http://chloe.ogatism.com/</loc>
        <lastmod>{{ date('Y-m-d', strtotime($data['posts'][0]['updated_at'])) }}</lastmod>
    </url>
    @foreach ($data['posts'] as $key => $value)
    <url>
        <loc>{{ $data['url'] }}/blog/post/{{ $value['slug'] }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($value['updated_at'])->toAtomString() }}</lastmod>
    </url>
    @endforeach
    @foreach ($data['tags'] as $key => $value)
    <url>
        <loc>{{ $data['url'] }}/blog/?tag={{ $value['tag'] }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($value['updated_at'])->toAtomString() }}</lastmod>
    </url>
    @endforeach
</urlset>
