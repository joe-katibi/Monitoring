{{-- <x-mail::message style="background-color: #f3f8fb; padding: 20px;">
<p style="font-size: 16px; font-weight: bold;">Dear Sir/Madam,</p>
<br>
<p style="font-size: 14px;">You have been audited. Please log in to view your results.</p>
<br>
<p style="font-size: 14px;">Thank you.</p>
<br>
<p style="font-size: 14px;">{{ config('app.name') }}</p>
</x-mail::message> --}}

{{-- @component('mail::message ')
# {{ config('audit_notification.title') }}

{{ str_replace([':user_name', ':supervisor_name'], [$data->user->name, $data->supervisor->name
]) }}

{{ config('audit_notification.no_reply_message') }}

Thanks,<br>
{{ config('audit_notification.from_name') }}
@endcomponent --}}

@component('mail::message')
<style>
    /* Add your custom styles here */
    .body {
        background-color: #E6F4F1;
        color: #333333;
    }
    .blue {
        color: #006699;
    }
    .green {
        color: #5CB85C;
    }
</style>

<div class="body">
    @if ($type == 'results')
        <h2 class="blue">{{ config('audit_notification.title') }}</h2>
        {{ str_replace([':user_name', ':supervisor_name',':quality_name'], [$user->name, $supervisor->name, $qualityAnalysts->name], config('audit_notification.results_message')) }}

    @elseif ($type == 'liveCalls')
        <h2 class="blue">{{ config('audit_notification.live_calls_title') }}</h2>
        {{ str_replace([':user_name', ':supervisor_name',':quality_name'], [$user->name, $supervisor->name, $qualityAnalysts->name], config('audit_notification.live_calls_message')) }}
    @elseif ($type == 'autofails')
        <h2 class="red">{{ config('audit_notification.autofails_title') }}</h2>
        {{ str_replace([':user_name', ':supervisor_name',':quality_name'], [$user->name, $supervisor->name, $qualityAnalysts->name], config('audit_notification.autofails_message')) }}
    @elseif ($type == 'coaching')
        <h2 class="red">{{ config('audit_notification.coaching_title') }}</h2>
        {{ str_replace([':user_name', ':supervisor_name',':quality_name'], [$user->name, $supervisor->name, $qualityAnalysts->name], config('audit_notification.coaching_message')) }}
    @elseif ($type == 'exam_results')
        <h2 class="blue">{{ config('audit_notification.exam_results_title') }}</h2>
        {{ str_replace([':user_name', ':supervisor_name'], [$userEmail->name, $supervisorEmail->name], config('audit_notification.exam_results_message')) }}
    @endif

    {{ config('audit_notification.no_reply_message') }}
</div>

Thanks,<br>
<span class="blue">{{ config('audit_notification.from_name') }}</span>
@endcomponent

