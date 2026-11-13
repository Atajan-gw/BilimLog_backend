<div class="col-md-6 mb-3">
    <label class="form-label">Avatar</label>

    @if (! empty($avatarUrl))
        <div class="mb-2">
            <img src="{{ $avatarUrl }}" alt="Avatar" width="72" height="72"
                 class="rounded-circle object-fit-cover border">
        </div>
    @endif

    <input type="file" name="avatar" class="form-control"
           accept="image/jpeg,image/png,image/webp">
    <div class="form-text">JPG, PNG or WEBP. Max 2 MB.</div>
    @error('avatar') <div class="text-danger">{{ $message }}</div> @enderror
</div>
