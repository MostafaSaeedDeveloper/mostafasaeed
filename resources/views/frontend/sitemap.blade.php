<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ route('home') }}</loc></url>
    <url><loc>{{ route('about') }}</loc></url>
    <url><loc>{{ route('services') }}</loc></url>
    <url><loc>{{ route('projects') }}</loc></url>
    <url><loc>{{ route('clients') }}</loc></url>
    <url><loc>{{ route('contact') }}</loc></url>
    @foreach($projects as $project)
        <url><loc>{{ route('projects.show', $project->slug) }}</loc></url>
    @endforeach
</urlset>
