<html lang="en-US">
<head>
    <meta charset="text/html">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .button_2 {
            background-color: green; /* Green */
            color: #ffffff;
            padding: 5px;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 20px;
            font-weight: 700;
        }
    </style>
</head>
<body>
<p>Dear Concern ,</p>
<p>This is a new account creation request for KBANK - Knowledge Bank System.</p>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <td>{{ $name }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $email }}</td>
    </tr>
    <tr>
        <td></td>
        <td><a href="{{ url('/new_account_requests') }}" class="button_2">Confirmation Link </a></td>
    </tr>
    </thead>
</table>
<br />
<br />
<p>Thank You</p>
</body>
</html>