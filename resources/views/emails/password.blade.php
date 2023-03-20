<x-mail::message>
# Introduction

Dear {{$client->email}},
Your code is:{{$code}},


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
