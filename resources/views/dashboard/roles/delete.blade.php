<!-- Button trigger modal -->
<button type="button" class="dropdown-item" data-bs-toggle="modal{{ $role->id }}"
    data-bs-target="#exampleModal{{ $role->id }}">
    <i class="la la-trash"></i> {{ __('dashboard.delete') }}
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $role->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel{{ $role->id }}">{{ __('dashboard.delete_role') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('dashboard.close') }}</button>
                <button type="button" class="btn btn-primary">{{ __('dashboard.save') }}</button>
            </div>
        </div>
    </div>
</div>
