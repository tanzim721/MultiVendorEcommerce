<p>Dear {{$admin->name}}</p>
<p>
    We are received a request to reset the password for the multi vendor ecommerce associated with {{ $admin->email }}. You can reset your password by clicked the button below:
    <br>
    <a href="{{ $actionLink }}" target="_blank" style="color:#fff;border-color:green;border-style:solid;border-width:5px 10px;background-color:green;display:inline-block;text-decoration:none;border-radious:3px; box-shadow:0 2px 3px black;">Reset password</a>
    <br>
    <b>NB:</b>This link will valid within 15 minites
    <br>
    If you did not request for a password reset, please ignore this mail.
</p>

