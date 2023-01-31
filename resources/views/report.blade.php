<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<table style="border: 1px solid black">
  <thead>
  <th style="border: 1px solid black;background: black; color: white; font-weight: bold; width: 300px">Date</th>
  <th style="border: 1px solid black;background: black; color: white; font-weight: bold; width: 300px">Time</th>
  </thead>
  <tdody>
    @foreach($attn as $sAtten)
    <tr>
      <td style="border: 1px solid black; text-align: center">{{ $sAtten['day'] }}</td>
      <td style="border: 1px solid black; text-align: center">{{ $sAtten['time'] }}</td>
    </tr>
    @endforeach
  </tdody>
</table>

</body>
</html>