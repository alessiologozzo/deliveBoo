<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11000">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            @if ($failed)
                <div class="rounded me-2 bg-danger" style="width: 20px; height: 20px"></div>
            @else
                <div class="rounded me-2 bg-success" style="width: 20px; height: 20px"></div>
            @endif
            <strong class="me-auto">DeliveBoo</strong>

            @if ($failed)
                <small class="text-danger">Failed</small>
            @else
                <small class="text-success">Success</small>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ $mex }}
        </div>
    </div>
</div>
