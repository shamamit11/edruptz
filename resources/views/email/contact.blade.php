<html>
<head>
</head>
<body>
<div style="margin-bottom:15px"> {{ $first_name }} {{ $last_name }} has submitted Contact Form on Edruptz's website. </div>
<table width="100%">
  <tr>
    <td width='18%'><strong>Name:</strong></td>
    <td width='82%'>{{ $first_name }} {{ $last_name }}</td>
  </tr>
  <tr>
    <td><strong>Phone:</strong></td>
    <td>{{ $phone }}</td>
  </tr>
  <tr>
    <td><strong>Email:</strong></td>
    <td>{{ $email }}</td>
  </tr>
  <tr>
    <td><strong>Country:</strong></td>
    <td>{{ $country }}</td>
  </tr>
  <tr>
    <td><strong>Message:</strong></td>
    <td>{{ $messages }}</td>
  </tr>
</table>
<br>
<p> Thank You !!<br>
  Edruptz</p>
</body>
</html>