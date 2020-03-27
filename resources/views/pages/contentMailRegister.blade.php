<h4>Confirm the account you have registered</h4>
<p><strong>Name:</strong>{{ $name }}</p></br>
<p><strong>Email:</strong>{{ $email }}</p></br>
<p><strong>Address:</strong>{{ $address }}</p></br>
<p><strong>Phone:</strong>{{ $phone }}</p></br>
<p><strong>Please active your account:</strong></br>
{{ Route('home.userActivation',$remember_token ) }}</p>
