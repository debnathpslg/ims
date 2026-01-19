<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">
                {{ $pageName }}
            </h4>
        </div>


        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        @foreach ($breadCrumbs as $crumb)
                            @if ($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $crumb['label'] ?? '' }}
                                </li>
                            @else
                                <li class="breadcrumb-item">
                                    <a href="{{ $crumb['url'] ?? '#' }}">
                                        {{ $crumb['label'] ?? '' }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>