<x-layouts.docs
    meta-title="Preview Laravel mail and debug notifications | New Debug Bar"
    description="Preview Laravel mail, inspect recipients and attachments, review notification channels and payloads, and follow queued delivery outcomes."
    :canonical="url('/docs/mail-and-notifications')"
    og-title="Inspect Laravel mail and notifications"
    og-description="See what a request created, who should receive it, how each channel ran, and what happened to queued delivery."
    page-title="Mail and notifications"
    :sections="[
        ['id' => 'mail', 'label' => 'Mail'],
        ['id' => 'previews', 'label' => 'Previews and files'],
        ['id' => 'notifications', 'label' => 'Notifications'],
        ['id' => 'queued', 'label' => 'Queued delivery'],
        ['id' => 'workflow', 'label' => 'Debugging workflow'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="Inspect communication before it leaves the app">
        Review recipients, subjects, previews, attachments, channels, payloads, failures, and queued outcomes for the selected request or worker profile.
    </x-docs.page-header>

    <x-docs.section id="mail" title="Inspect created mail">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Mail section retains bounded message metadata, sender and recipient addresses, subject, headers, HTML and text bodies, attachments, source, and queued facts when available.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Confirm To, Cc, and Bcc recipients before judging delivery behavior.</x-docs.check-item>
            <x-docs.check-item>Open the HTML and text forms to catch missing content or different fallback copy.</x-docs.check-item>
            <x-docs.check-item>Check the application source when a message is created more than once.</x-docs.check-item>
            <x-docs.check-item>Use the worker profile when queued mail is rendered or sent outside the web request.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="previews" title="Mail previews and attachments are bounded">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Each retained HTML and text body is limited to 50,000 bytes by default. Attachment bodies are retained up to a 2 MB budget per message; metadata remains visible when a file body is beyond the budget.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Preview and download responses are local package routes with private, no-store caching. They still expose the values already present in the local profile, so protect any shared development environment.</p>
    </x-docs.section>

    <x-docs.section id="notifications" title="Review each notification channel">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Notifications section connects the notification class and recipient to each channel delivery. Inspect payload, status, failure, timing, source, and related mail evidence instead of treating one multi-channel notification as several unrelated operations.</p>

        <x-docs.callout class="mt-6" title="A created notification is not always delivered:">
            check the channel status and queued outcome. The originating request may only record that delivery work was queued.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="queued" title="Follow queued communication into the worker">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Queued mail and notifications can show pending background activity in the origin profile. After a local worker handles the job, refresh related activity and open the correlated worker profile for the final sent or failed outcome.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Keep the origin and worker evidence separate: the origin explains who queued the communication; the worker explains rendering, channel calls, failures, and side effects during delivery.</p>
    </x-docs.section>

    <x-docs.section id="workflow" title="Debug one message or notification">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Confirm the selected profile">Choose the web request or worker that actually created or sent the communication.</x-docs.step>
            <x-docs.step number="2" title="Check recipient and content">Review addresses, subject, body forms, attachment metadata, channel, and payload.</x-docs.step>
            <x-docs.step number="3" title="Open its source">Trace duplicate or missing communication to the application call site.</x-docs.step>
            <x-docs.step number="4" title="Follow queued outcomes">Refresh related activity and inspect the worker profile before concluding delivery failed.</x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.queues')"
        title="Understand the worker profile"
        description="Connect an origin request to a delayed, sent, or failed local queue-worker execution."
        link-label="Open the queues guide"
    />
</x-layouts.docs>
