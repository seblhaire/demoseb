@extends('layout')
@section('title', 'Specialauth')
@section('content')
<h3>Specialauth</h3>
<p class="lead">Library based on Laravel authentication libraries (login, logout, password reset procedure) provided in
  <a rel="noopener noreferrer" target="_blank" href="https://laravel.com/docs/master/starter-kits#laravel-breeze">Laravel Breeze</a>
  but does not contain registration process. <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/specialauth">Project on GitHub</a>.
  <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/specialauth">Project on Packagist</a>.</p>
<p>For some application, you may not need people to be able to sign in on their own. You might want admin accounts or some powerful users to create
accounts for others and to assign  them some rights. This package comes with functions and examples that will facilitate a fast implementation.</p>
<p>This page does not contain a demo because we can not set up a convenient, secure space.</p>
<img src="/img/specialauth_login.png" /><br/>
<p>If you ask for password reset, this page will be displayed:</p>
<img src="/img/specialauth_reset.png" />
<p>Then an email is sent to the user containing a link to this page:</p>
<img src="/img/specialauth_reset2.png" />
<p>The same page is open when an administrator creates an account for a user.</p>
<br/><br/><br/>
@endsection
