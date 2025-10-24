<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0 font-size-18">{{ isset($subtitle) ? $subtitle : $title }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a>SmartSaving</a></li>
                    @if(isset($title))
                        <li class="breadcrumb-item @if(!isset($subtitle)) active @endif">{{ $title }}</li>
                        @if(isset($subtitle))
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        @endif
                    @endif
                    
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
