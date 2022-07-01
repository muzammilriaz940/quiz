<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" /> -->
    <style type="text/css">
        .text-center{
            text-align: center;
        }
        
        ol > li::marker {
          font-weight: bold;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr class="text-center">
            <th>{{ $exam->name }}</th>
        </tr>
        <tr class="text-center">
            <td><small>({{ count($exam->test->questions) }} Questions)</small></td>
        </tr>
        <tr class="text-center">
            <th><hr/></th>
        </tr>

        @foreach($exam->test->questions as $i => $question)
        <tr>
            <td>
                <ol>
                  <li>{{ $question->description }}
                    <ol>
                        @foreach($question->options as $key => $value)
                        <li type="A">{{ $value }}</li>
                        @endforeach
                    </ol>
                  </li>
                </ol>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>