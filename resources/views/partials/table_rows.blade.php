<tr>
    <th scope='row'>{{$client->id}}</th>
    <td>{{"$client->first_name $client->middle_name $client->last_name"}}</td>
    <td>{{$client->phone}}</td>
    <td>{{isset($iban) ? $iban : ""}}</td>
    <td>{{isset($last) && $last ? "True" : "False" }}</td>
    <td>{{$client->created_at}}</td>
</tr>
