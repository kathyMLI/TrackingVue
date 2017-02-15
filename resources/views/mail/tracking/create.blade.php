@component('mail::message')
# Hola {{ $user }} :

Tu envío ha sido registrado correctamente:

@component('mail::table')
|  Código   	         | Descripción      	  |
|:-----------------------|:--------------:|
| {{ $code }}  | 	{{ $description }} |
@endcomponent

Te notificaremos si tu envío cambia de estado.

Atte,<br>
{{ config('app.name') }}
@endcomponent
