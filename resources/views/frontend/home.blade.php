@extends('layouts.frontend')

@section('title', 'Mostafa Saeed | Full Stack Web Developer')
@section('meta_description', 'Mostafa Saeed is a Full Stack Web Developer, WordPress Developer, SEO Specialist, and Media Buyer based in Alexandria, Egypt.')

@section('content')
<section class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="text-primary fw-semibold">Hello, I'm</span>
            <h1 class="display-5 fw-bold mt-2">Mostafa Saeed</h1>
            <h2 class="h3 text-muted mb-3">A <span id="typed-role" class="text-dark fw-semibold">Full Stack Web Developer</span></h2>
            <p class="lead">Full Stack Web Developer | WordPress Developer | SEO Specialist | Media Buyer based in Alexandria, Egypt. I build custom websites, Laravel applications, WordPress solutions, SEO-ready experiences, and high-performing ad funnels.</p>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('projects') }}" class="btn btn-primary">View Projects</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Me</a>
            </div>
            <div class="mt-4 small text-muted">
                <div><strong>Email:</strong> mostafasaeed.developer@gmail.com / info@mostafasaeed.com</div>
                <div><strong>Phone:</strong> 01003770730</div>
                <div><strong>Website:</strong> mostafasaeed.com</div>
                <div><strong>Location:</strong> Alexandria, Egypt</div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow-sm"><div class="card-body">
                <h3 class="h5 mb-3">Core Skills</h3>
                @foreach ([
                    'PHP & MySQL' => 90,
                    'WordPress' => 95,
                    'Laravel' => 85,
                    'Bootstrap & jQuery' => 88,
                    'SEO' => 80,
                    'HTML & CSS' => 95,
                    'Adobe Photoshop' => 70,
                    'Hosting Management' => 85,
                ] as $skill => $percent)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between"><span>{{ $skill }}</span><span>{{ $percent }}%</span></div>
                        <div class="progress" role="progressbar"><div class="progress-bar" style="width: {{ $percent }}%"></div></div>
                    </div>
                @endforeach
            </div></div>
        </div>
    </div>
</section>

<section class="container py-4">
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100"><div class="card-body">
                <h3 class="h4">Services</h3>
                <ul class="mb-0">
                    <li><strong>Web Development (PHP & Laravel):</strong> Custom websites, web apps, and APIs.</li>
                    <li><strong>WordPress Development:</strong> Themes, plugins, WooCommerce, and speed optimization.</li>
                    <li><strong>SEO Optimization:</strong> On-page SEO, technical SEO, keyword research, and ranking improvement.</li>
                    <li><strong>Media Buying:</strong> Facebook Ads, Google Ads, and campaign management.</li>
                </ul>
            </div></div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100"><div class="card-body">
                <h3 class="h4">Experience Timeline</h3>
                <ul class="mb-0">
                    <li>Bishop Integrated Solutions — Full Stack Web Developer (2021 – Present)</li>
                    <li>Emtiaz Soft, UAE (Remote) — Full Stack Web Developer (Nov 2024 – Apr 2025)</li>
                    <li>Withaq, Saudi Arabia (Remote) — WordPress Developer (2019 – 2022)</li>
                    <li>MWheba Agency — WordPress Developer (2019 – 2020)</li>
                    <li>WEGO Station — WordPress Developer (2019)</li>
                    <li>Mediabyte — WordPress Developer (2018)</li>
                    <li>Aaser Media — WordPress Developer (2017)</li>
                </ul>
            </div></div>
        </div>
    </div>
</section>

<section class="container py-4">
    <div class="row g-4">
        <div class="col-lg-4"><div class="card h-100"><div class="card-body"><h3 class="h5">Education</h3><p class="mb-0">Bachelor's in Geographic Information System (GIS)<br>Faculty of Arts, Alexandria University (2013 – 2017)</p></div></div></div>
        <div class="col-lg-8"><div class="card h-100"><div class="card-body"><h3 class="h5">Certificates</h3><ul class="mb-0"><li>Computer Hardware & Software — Smouha Academy (2016)</li><li>SEO Training Course — MOZ (2018)</li><li>PHP & MySQL Development — Eduonix Learning Solutions (2019)</li><li>Backend Development Diploma — Route Academy (2021)</li></ul></div></div></div>
    </div>
</section>

<section class="container py-4">
    <h3 class="h4 mb-3">Recent Projects</h3>
    <div class="row g-3">
        @foreach($projects as $project)
            <div class="col-md-4">
                <div class="card h-100"><div class="card-body"><h4 class="h6">{{ $project->getTranslated('title') }}</h4><p class="text-muted">{{ $project->description ?: $project->getTranslated('summary') }}</p><a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a></div></div>
            </div>
        @endforeach
    </div>
</section>
@endsection

@push('scripts')
<script>
const roles = ["Full Stack Web Developer", "WordPress Developer", "SEO Specialist", "Media Buyer"];
let roleIndex = 0;
setInterval(() => {
    roleIndex = (roleIndex + 1) % roles.length;
    document.getElementById('typed-role').textContent = roles[roleIndex];
}, 1800);
</script>
@endpush
