<div
    class="fixed inset-4 pointer-events-none grid justify-items-stretch place-items-end"
    x-data="{ notifications: [] }"
    @notify.window="notifications.push($event.detail[0])"
>
    <div class="grid gap-4">
        <template x-for="(notification, key) in notifications" :key="key">
            <x-notification />
        </template>

        @session('notification')
            <x-notification
                x-data="{
                    notification: {
                        type: '{{ $value['type'] }}',
                        message: '{{ $value['message'] }}',
                    },
                    visible: false,
                }"
            />
        @endsession
    </div>
</div>
