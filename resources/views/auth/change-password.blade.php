<form method="POST" action="{{ route('password.request.send') }}">
    @csrf

    <div>
        <label for="email">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" required autofocus>
    </div>

    <div>
        <button type="submit">{{ __('Send Password Reset Link') }}</button>
    </div>
</form>
