@component('mail::message')
# Hola {{ $user }}

Te damos la bienvenida a TrackingApp, la aplicación que monitorea tus envíos. Nosotros te notificamos cada vez que tus envíos cambien de estado.

Para terminar tu registro hazle click al botón!

@component('mail::button', ['url' => $url ])
TrackingApp
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
