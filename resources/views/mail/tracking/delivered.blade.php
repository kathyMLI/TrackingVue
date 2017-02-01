@component('mail::message')
# Hola

Tu envío ha sido entregado con éxito, los datos de entrega son los siguientes:

@component('mail::table')
| Código        | Descripción      |
| ------------- |:----------------:|
| {{ $code }}   | {{$description}} |
@endcomponent

Gracias por utilizar TrackingApp.

Atte,<br>
{{ config('app.name') }}
@endcomponent
