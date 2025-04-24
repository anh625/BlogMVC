<div class="toast-container" id="toast-container">
    @foreach($toasts as $toast)
        <div class="toast bg-{{ $toast['type'] }} text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">{{ $toast['title'] }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $toast['message'] }}
            </div>
        </div>
    @endforeach
</div>

<style>
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
    }
    .toast {
        min-width: 250px;
        margin-bottom: 10px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toasts = document.querySelectorAll('.toast');
        toasts.forEach(toast => {
            const bootstrapToast = new bootstrap.Toast(toast);
            bootstrapToast.show();
        });
    });
</script>
