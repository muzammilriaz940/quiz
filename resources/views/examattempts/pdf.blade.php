<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        .text-center{
            text-align: center;
        }

        .center-table{
            margin-left: auto;
            margin-right: auto;
        }

        .page-break {
            page-break-after: always;
        }

        .dot{
          height: 8px;
          width: 8px;
          border-radius: 50%;
          display: inline-block;
        }

        .green-dot {
          background-color: green;
        }

        .red-dot {
          background-color: red;
        }
    </style>
</head>

<body>
    <!-- <table width="100%">
        <tr class="text-center">
            <th>{{ $EA->exam->name }}</th>
        </tr>
        <tr class="text-center">
            <td><small>({{ count($EA->exam->test->questions) }} Questions)</small></td>
        </tr>
        <tr class="text-center">
            <th><hr/></th>
        </tr>

        @foreach($EA->exam->test->questions as $i => $question)
        <tr>
            <td>
                <ol>
                    <li value="{{ ($i+1) }}">{{ $question->description }}
                      <ol style="margin-top: 30px;">
                        @foreach($question->options as $key => $value)
                        <li type="A">{{ $value }}</li>
                        @endforeach
                      </ol>
                    </li>
                </ol>
            </td>
        </tr>
        @endforeach
    </table> -->

    <!-- <div class="page-break"></div>

    <table width="50%" class="center-table">
        <tr class="text-center">
            <th colspan="5">Answer Key</th>
        </tr>
        <tr class="text-center">
            <th colspan="5">{{ $EA->exam->name }}</th>
        </tr>
        <tr><th colspan="5"></th></tr>
        <tr><th colspan="5"></th></tr>
        <tr><th colspan="5"></th></tr>
        
        <tr class="text-center">
            <th colspan="1">Name: <u>{{ $EA->studentName }}</u></th>
            <th colspan="4">Date: <u>{{ $EA->created_at }}</u></th>
        </tr>
        <tr><th colspan="5"></th></tr>
        <tr class="text-center">
            <th colspan="1"><u>Question</u></th>
            <th colspan="4"><u>Answer</u></th>
        </tr>
        @foreach($EA->exam->test->questions as $i => $question)
        <tr class="text-center" @if($loop->iteration % 2 == 0) style="background-color: darkgrey;" @endif>
            <td>
                {{ $i+1 }}
            </td>

            @foreach($question->options as $key => $value)
            <td>
                <?php
                    $dot = "";

                    $correctAnswer = $question->correct_option;
                    $option = ($key+1);
                    $attemptedAnswer = $EA->answers->where('testQuestionId', $question->id)->first()->answer;

                    if($correctAnswer == $option){
                        $dot = "green-dot";
                    }

                    if($attemptedAnswer == $option && empty($dot)){
                        $dot = "red-dot";
                    }
                ?>
                {{ ($key+1) }}&nbsp;<span class="dot {{ $dot }}"></span>
            </td>
            @endforeach
        </tr>
        @endforeach
    </table>

    <div class="page-break"></div> -->
</body>
</html>