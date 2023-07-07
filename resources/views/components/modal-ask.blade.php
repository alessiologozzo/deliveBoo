<div class="al-confirm d-none">
    <div class="d-flex flex-column">
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
                    <input type="password" name="password" id="password" placeholder="Password...">
                @endif
            </form>
        @endif
    </div>

    <div class="d-flex justify-content-center align-items-center gap-4 pt-4">
        <div onclick="window.Func.removeConfirmElement()" class="al-round al-red">
            <i class="fa-solid fa-xmark"></i>
        </div>
        @if ($password)
            <div onclick="window.Func.submitForm(event)" class="al-round al-green">
                <i class="fa-solid fa-check"></i>
            </div>
        @else
            <div onclick="window.Func.submitFormIndex(event, window.Var.modalFormIndex)" class="al-round al-green">
                <i class="fa-solid fa-check"></i>
            </div>
        @endif
    </div>
</div>
