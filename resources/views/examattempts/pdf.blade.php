<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        .text-center{
            text-align: center;
        }
        
        body ol > li::marker {
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