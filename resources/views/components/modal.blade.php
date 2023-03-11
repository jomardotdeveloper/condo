<div class="modal fade" id="{{ $id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">{{ $footer }}</span>
            </div>
        </div>
    </div>
</div>