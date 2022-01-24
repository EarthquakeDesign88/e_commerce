@if (session('success'))
    <div class="alert alert-success alert-dismissible " id="alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>{{ session('success') }}</strong>
    </div>

@elseif(session('error'))
    <div class="alert alert-danger alert-dismissible " id="alert" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>{{ session('error') }}</strong>
    </div>    
@endif