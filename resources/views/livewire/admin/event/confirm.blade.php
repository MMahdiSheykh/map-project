<div dir="rtl">
    <a class="active">مکان های تایید نشده</a>
    <table class="table table-hover text-nowrap text-center">
        <thead>
        <tr>
            <th>اسم</th>
            <th>اقدامات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>
                    <button wire:click="selectEvent({{ $event->id }})" class="btn btn sm btn-outline-info ml-1">انتخاب</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
