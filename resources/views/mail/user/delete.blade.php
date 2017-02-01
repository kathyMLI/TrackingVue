@component('mail::message')
# Hola {{ $user }}

Tus registros han sido eliminado correctamentes. Gracias por utilizar TrackingApp, recuerda que puedes volver a registrate cuando quieras.

Para acceder a la página principal de TrackingApp pulsa el botón:

@component('mail::button', ['url' => $url ])
TrackingApp
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
