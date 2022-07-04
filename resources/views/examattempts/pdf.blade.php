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

        table {
            font-size: 12px;
        }

        .table-border{
            border: 1px solid black;
            border-radius: 12px;
        }

    </style>
</head>

<body>
    <table width="100%">
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
    </table>

    <div class="page-break"></div>

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

    <div class="page-break"></div>

    <table width="100%">
        <tr class="text-center">
            <td colspan="5">Student Name: <u>{{ $EA->studentName }}</u></td>
            <td colspan="5">Date of Test: <u>{{ $EA->studentName }}</u> </td>
        </tr>
        <tr class="text-left">
            <td colspan="10">
                <p>Hospital Scenario: “You are working in a hospital or clinic, and you see a person who has suddenly collapsed in the
hallway. You check that the scene is safe and then approach the patient. Demonstrate what you would do next.”
Prehospital Scenario: “You arrive on the scene for a suspected cardiac arrest. No bystander CPR has been provided. You
approach the scene and ensure that itis safe. Demonstrate what you would do next.”</p>
            </td>
        </tr>
    </table>

    <table width="100%" class="table-border">
        <tr>
            <td colspan="10"><b>Assesments & Activation</b></td>
        </tr>
        <tr>
            <td colspan="5">
                <input type="checkbox" checked> Checks Responsiveness
            </td>
            <td colspan="5">
                <input type="checkbox" checked> Shouts for help/Activates emergency response system/Sends for AED
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <input type="checkbox" checked> Checks Breathing
            </td>
            <td colspan="5">
                <input type="checkbox" checked> Checks Pulse
            </td>
        </tr>
    </table>

    <table width="100%">
    <tr>
        <p>Once student shouts for help, instructor says, “Here's the barrier device. | am going to get the AED.”</p>
    </tr>
    </table>

    <table width="100%" class="table-border">
        <tr>
            <td colspan="10"><b>Cycle 1 of CPR(30:2) *CPR feedback devices are required for accuracy</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> Adult Compressions
                <ul>
                    <li>Performs high-quality compressions*:</li>
                    <li>Hand placement on lower half of sternum</li>
                    <li>30 compressions in no less than 15 and no more than 18 seconds</li>
                    <li>Compresses at least 2 inches (5 cm)</li>
                    <li>Complete recoil after each compression</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> Adult Breaths
                <ul>
                    <li>Gives 2 breaths with a barrier device:</li>
                    <li>Each breath given over 1 second</li>
                    <li>Visible chest rise with each breath</li>
                    <li>Resumes compressions in less than 10 seconds</li>
                </ul>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" class="table-border">
        <tr>
            <td colspan="9"><b>Cycle 2 of CPR (repeats stepsin Cycle 1) Only check box if step is successfully performed</b></td>
        </tr>
        <tr>
            <td colspan="9">
                <input type="checkbox" checked> Compressions
                <input type="checkbox" checked> Compressions
                <input type="checkbox" checked> Compressions
            </td>
        </tr>
    </table>
</body>
</html>