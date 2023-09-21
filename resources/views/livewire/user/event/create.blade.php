<div>
    <a class="active">ساخت یک رویداد</a>

    <div class="container mt-5">
        <form wire:submit="createEvent">
            <div class="form-group">
                <label for="eventName">نام رویداد</label>
                <input wire:model.blur="name" type="text" class="form-control" id="eventName">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mt-4">
                <label for="address">آدرس رویداد</label>
                <textarea wire:model.blur="address" id="address" class="form-control"></textarea>
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mt-4">
                <label for="eventDescription">توضیحات رویداد</label>
                <textarea wire:model.blur="description" type="text" class="form-control" id="eventDescription"></textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-dark mt-4 ml-2">ساخت رویداد</button>
            <br><br>@error('latlng') <span class="text-danger">{{ $message }}</span> @enderror

        </form>
    </div>

    <br><br><br><br>
    <div class="mt-5 ml-1 mr-1">
        <strong>
            نکته: رویدادهای شما با رنگ قرمز مشخص شده اند
        </strong>
    </div>
</div>
