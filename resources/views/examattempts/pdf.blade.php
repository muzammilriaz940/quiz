<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .text-left{
            text-align: left;
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
            font-size: 14px;
        }

        .table-border{
            border: 2pt solid cornflowerblue;
            border-radius: 12px;
            background-color: aliceblue;
            padding: 10px 10px 10px 10px;
        }

        .border-top{
            border-top: 1px solid black;
        }

        .border-right{
            border-right: 1px solid black;
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
        <tr>
            <td colspan="5">Basic Life Support<br><h2>Adult CPR & AED <br>Skills Testing Checklist</h2></td>
            <td colspan="5" class="text-right">LOGO HERE</td>
        </tr>
        <tr>
            <td colspan="5" class="text-left">Student Name: <u>{{ $EA->studentName }}</u></td>
            <td colspan="5" class="text-right">Date of Test: <u>{{ $EA->studentName }}</u> </td>
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
        <td><p>Once student shouts for help, instructor says, “Here's the barrier device. | am going to get the AED.”</p></td>
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
            <td colspan="10"><b>Cycle 2 of CPR (repeats stepsin Cycle 1) Only check box if step is successfully performed</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> Compressions
                <input type="checkbox" checked> Breaths
                <input type="checkbox" checked> Resumes compressions in less than 10 seconds
            </td>
        </tr>
    </table>

    <table width="100%">
    <tr>
        <td><p>Rescuer 2 says, “Here is the AED. I'll take over compressions, and you use the AED.”</p></td>
    </tr>
    </table>

    <table width="100%" class="table-border">
        <tr>
            <td colspan="10"><b>AED (follows prompts of AED)</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> Powers on AED
                <input type="checkbox" checked> Correctly attaches pads
                <input type="checkbox" checked> Clears for analysis
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> Clears to safely deliver a shock
                <input type="checkbox" checked> Safely delivers a shock
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" class="table-border">
        <tr>
            <td colspan="10"><b>Resumes Compressions</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> Ensures compressions are resumed immediately after shock delivery
                <ul>
                    <li>Student directs instructor to resume compressions or</li>
                    <li>Second student resumes compressions</li>
                </ul>
            </td>
        </tr>
    </table>
    <p class="text-center"><b>STOP TEST</b></p>

    <table width="100%" style="border: 1px solid black; border-collapse: collapse;">
        <tr class="text-left">
            <td colspan="10"><b>Instructor Notes</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <ul>
                    <li>Place a check in the box next to each step the student completes successfully.</li>
                    <li>lf the student does not complete all steps successfully (as indicated by at least 1 blank check box), the student
must receive remediation. Make a note here of which skills require remediation (refer to instructor manual for
information about remediation).
</li>
                </ul>
            </td>
        </tr>
        <tr class="border-top text-center">
            <td colspan="6" class="border-right">
                <p><b>Test Results</b>&nbsp;&nbsp;&nbsp; Cheak <b>PASS</b> or <b>NR</b> to indicate pass or needs remediation:
            </td>
            <td colspan="2" class="border-right">
                <input type="checkbox" checked> PASS
            </td>
            <td colspan="2">
                <input type="checkbox" > NR
            </td>
        </tr>
        <tr class="border-top text-center">
            <td colspan="10">
                <p>Instructor Initials _____________________
                &nbsp;&nbsp;&nbsp;Instructor Number ____________
                &nbsp;&nbsp;&nbsp;Date ____________</p>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    <table width="100%">
        <tr>
            <td colspan="5">Basic Life Support<br><h2>Infant CPR <br>Skills Testing Checklist(1 of 2)</h2></td>
            <td colspan="5" class="text-right">LOGO HERE</td>
        </tr>
        <tr>
            <td colspan="5" class="text-left">Student Name: <u>{{ $EA->studentName }}</u></td>
            <td colspan="5" class="text-right">Date of Test: <u>{{ $EA->studentName }}</u> </td>
        </tr>
        <tr class="text-left">
            <td colspan="10">
                <p>Hospital Scenario: “You are working in a hospital or clinic when a woman runs through the door, carrying an infant. She
shouts, ‘Help me! My baby’s not breathing.’ You have gloves and a pocket mask. You send your coworker to activate the
emergency response system and to get the emergency equipment.”Prehospital Scenario: “You arrive on the scene for an infant who is not breathing. No bystander CPR has been provided.
You approach the scene and ensure that it is safe. Demonstrate what you would do next.”</p>
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
        <td><p>Once student shouts for help, instructor says, “Here's the barrier device.”</p></td>
    </tr>
    </table>

    <table width="100%" class="table-border">
        <tr>
            <td colspan="10"><b>Cycle 1 of CPR(30:2) *CPR feedback devices are preferred for accuracy</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> <b>Infant Compressions</b>
                <ul>
                    <li>Performs high-quality compressions*:</li>
                    <li>Placement of 2 fingers or 2 thumbs in the center of the chest, just below the nipple line</li>
                    <li>30 compressions in no less than 15 and no more than 18 seconds</li>
                    <li>Compresses at least one third the depth of the chest, approximately 1% inches (4 cm)</li>
                    <li>Complete recoil after each compression</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> <b>Infant Breaths</b>
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
            <td colspan="10"><b>Cycle 2 of CPR(repeats stepsin Cycle 1) Only check box if step is successfully performed</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> Compressions
                <input type="checkbox" checked> Breaths
                <input type="checkbox" checked> Resumes compressions in less than 10 seconds
            </td>
        </tr>
    </table>

    <table width="100%">
    <tr>
        <td><p>Rescuer 2 arrives with bag-mask device and begins ventilation while Rescuer 1 continues compressions with 2 thumb—
encircling hands technique.</p></td>
    </tr>
    </table>

    <table width="100%" class="table-border">
        <tr>
            <td colspan="10"><b>Cycle 3 of CPR</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> <b>Rescuer 1: Infant Compressions</b>
                <ul>
                    <li>Performs high-quality compressions’:</li>
                    <li>15 compressions with 2 thumb-—encircling hands technique</li>
                    <li>15 compressions in no less than 7 and no more than 9 seconds</li>
                    <li>Compresses at least one third the depth of the chest, approximately 1% inches (4 cm)</li>
                    <li>Complete recoil after each compression</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> <b>Rescuer 2: Infant Breaths</b>
                <ul>
                    <li>This rescuer is not evaluated.</li>
                </ul>
            </td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td colspan="5">Basic Life Support<br><h2>Infant CPR <br>Skills Testing Checklist(2 of 2)</h2></td>
            <td colspan="5" class="text-right">LOGO HERE</td>
        </tr>
        <tr>
            <td colspan="5" class="text-left">Student Name: <u>{{ $EA->studentName }}</u></td>
            <td colspan="5" class="text-right">Date of Test: <u>{{ $EA->studentName }}</u> </td>
        </tr>
    </table>

    <table width="100%" class="table-border">
        <tr>
            <td colspan="10"><b>Cycle 4 of CPR</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> <b>Rescuer 2: Infant Compressions</b>
                <p>This rescuer is not evaluated.</p>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <input type="checkbox" checked> <b>Rescuer 1: Infant Breaths</b>
                <ul>
                    <li>Gives 2 breaths with a bag-mask device:</li>
                    <li>Each breath given over 1 second</li>
                    <li>Visible chest rise with each breath</li>
                    <li>Resumes compressions in less than 10 seconds</li>
                </ul>
            </td>
        </tr>
    </table>

    <p class="text-center"><b>STOP TEST</b></p>

    <table width="100%" style="border: 1px solid black; border-collapse: collapse;">
        <tr class="text-left">
            <td colspan="10"><b>Instructor Notes</b></td>
        </tr>
        <tr>
            <td colspan="10">
                <ul>
                    <li>Place a check in the box next to each step the student completes successfully.</li>
                    <li>lf the student does not complete all steps successfully (as indicated by at least 1 blank check box), the student
must receive remediation. Make a note here of which skills require remediation (refer to instructor manual for
information about remediation).</li>
                </ul>
            </td>
        </tr>
        <tr class="border-top text-center">
            <td colspan="6" class="border-right">
                <p><b>Test Results</b>&nbsp;&nbsp;&nbsp; Cheak <b>PASS</b> or <b>NR</b> to indicate pass or needs remediation:
            </td>
            <td colspan="2" class="border-right">
                <input type="checkbox" checked> PASS
            </td>
            <td colspan="2">
                <input type="checkbox" > NR
            </td>
        </tr>
        <tr class="border-top text-center">
            <td colspan="10">
                <p>Instructor Initials _____________________
                &nbsp;&nbsp;&nbsp;Instructor Number ____________
                &nbsp;&nbsp;&nbsp;Date ____________</p>
            </td>
        </tr>
    </table>
</body>
</html>