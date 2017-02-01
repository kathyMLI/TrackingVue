@component('mail::message')
# Hola {{ $name }}

Tu envío, código {{ $code }}, ha sido eliminado correctamente.

Recuerda que puedes volver a registar un envío cuando quieras.

Atte,<br>
{{ config('app.name') }}
@endcomponent
