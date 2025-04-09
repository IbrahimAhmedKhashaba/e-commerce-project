<div class="form-group">
  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <a href="{{ route('dashboard.categories.edit' , $category->id) }}" class="btn btn-outline-success">{{ __('dashboard.edit') }}</a>
    <a href="{{ route('dashboard.categories.status' , $category->id) }}" class="btn btn-outline-secondary">{{ __('dashboard.change_status') }}</a>
    <div class="btn-group" role="group">
      <button id="btnGroupDrop3" type="button" class="btn btn-outline-danger dropdown-toggle"
      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{ __('dashboard.delete') }}
      </button>
      <div class="dropdown-menu" aria-labelledby="btnGroupDrop3">
        <form action="{{ route('dashboard.categories.destroy' , $category->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="deleteBtn dropdown-item">{{ __('dashboard.delete') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>