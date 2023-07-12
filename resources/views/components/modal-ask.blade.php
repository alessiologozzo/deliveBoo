<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">
                <div class="d-flex flex-column text-center py-2">
                    <div>
                        <span>{{ $mex }}</span>
                        @if ($danger)
                            This action is <strong class="text-danger">irreversible</strong>.
                        @endif
                    </div>
            
                    @if ($password)
                        <label for="password" class="pt-3 pb-1">Enter your password to continue</label>
            
                        <form action={{ $route }} method="POST">
                            @csrf
                            @method($method)
            
                            @if ($password)
                                <input type="password" name="password" id="password" placeholder="Password..." required maxlength="255">
                            @endif
                        </form>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <div class="w-100 d-flex justify-content-center align-items-center flex-wrap gap-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    @if ($password)
                    <button onclick="window.Func.submitForm(event)" type="button" class="btn btn-danger">Delete</button>

                    @else
                        <button onclick="window.Func.submitFormIndex(event, window.Var.modalFormIndex)" type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
