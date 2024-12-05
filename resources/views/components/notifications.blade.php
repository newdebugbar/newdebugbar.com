<div
    class="fixed inset-4 pointer-events-none grid justify-items-stretch place-items-end"
    x-data="{ notifications: [] }"
    @notify.window="notifications.push($event.detail[0])"
>
    <div class="grid gap-4">
        <template x-for="(notification, key) in notifications" :key="key">
            <x-notification />

            @session('status')
                <x-notification>
                    {{ $value }}
                </x-notification>
            @endsession
        </template>
    </div>
</div>
