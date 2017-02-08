@component('mail::message')
# Hola {{ $user }} :

Tu envío ya cambió de estado:

@component('mail::table')
|  Código   	         | Estado      	  |
|:-----------------------|:--------------:|
| {{ $trackingNumber }}  | 	{{ $status }} |
@endcomponent

Te notificaremos si tu envío cambia de estado nuevamente.

Atte,<br>
{{ config('app.name') }}
@endcomponent
