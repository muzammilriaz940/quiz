<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEST</title>
</head>
<style type="text/css">
    .text-center{
        text-align: center;
    }
    
    ol > li::marker {
      font-weight: bold;
    }
</style>
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