<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Care Report</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }
        .title {
            text-align: center;
            font-weight: bold;
        }
        .section-title {
            font-weight: bold;
            background-color: #f0f0f0;
            margin-right: 90px;
        }
        .checkbox-inline {
            display: inline-block;
            margin-right: 10px;
        }
        .input-group {
            margin-bottom: 10px;
        }
        .input-group label {
            margin-right: 10px;
        }
    </style>
</head>
<body>
        <button type="button" onclick="window.print()">Print</button>

    <h2 class="title">Patient Care Report</h2>

    <!-- Table Layout for the Entire Form -->
    <form action="save_patient_report.php" method="POST">
        <table>
            <!-- Section 1: Nature of Incident, Location, Date, etc. -->
            <tr>
                <td colspan="3" class="section-title">Nature of Incident</td>
                <td colspan="2" class="section-title">Location</td>
                <td colspan="2" class="section-title">Date</td>
            </tr>
            <tr>
                <td colspan="2">Call Received</td>
                <td colspan="1"><input type="checkbox" name="call_received"></td> 
                <td colspan="2" rowspan="2">Patient Name: <br><br><input type="text" name="patient-name"></td>        
                <td colspan="1" rowspan="4" >Chief Complaint: <br><textarea row="10"></textarea></td>

            </tr>
            <tr>
                <td colspan="2">Responded</td>
                <td colspan="1" ><input type="checkbox" name="call_received"></td> 
        
    

            </tr>
            <tr>
                <td colspan="2">Arrival at Scene</td>
                <td><input type="checkbox" name="arrival_scene"></td>
                <td colspan="2" rowspan="2">Address/Contact Number: <br><br><input type="text" name="address_contactnum"></td>
            </tr>
            <tr>
                <td colspan="2">Transported to Receiving Facility</td>
                <td><input type="checkbox" name="arrival_scene"></td>
                
               

            </tr>
            <tr>
                <td colspan="2">Transported to Receiving Facility</td>
                <td><input type="checkbox" name="transported"></td>
                <td>Age : <input type="number" name="age"></td>
                <td>Religion : <br><input type="text" name="religion"></td>
                <td> Sex : <br>
                    <select name="sex">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </td>

            </tr>
            <tr>
                <td colspan="2">Back to Base</td>
                <td><input type="checkbox" name="back_to_base"></td>
                <td>Date of Birth : <br><input type="date" name="dob"></td>
                <td>Destination Hospital/Clinic : <input type="text" name="clinic"></td>
                <td>Weight (kg) : <input type="text" name="weight"></td>
                
            </tr>
            <tr>
                <td colspan="2">In Quarters</td>
                <td><input type="checkbox" name="in_quarters"></td>
                <td colspan="4"></td>
            </tr>
        </table>

        <!-- Section 2: Patient Assessment -->
        <table>
            <tr>
                <th colspan="1"> TIME</th>
                <th colspan="1"> NUERO </th>
                <th colspan="1"> BP</th>
                <th colspan="1"> PULSE</th>
                <th colspan="1"> SPO2</t>
                <th colspan="1"> RESPI</th>
                <th colspan="1"> PATIENT ASSESSMENT</th>
                <th colspan="1"> MECHANISM OF INJURY / MOI</th>
            </tr>

            <tr>
            </tr>
            <!-- Add fields for vital signs: BP, Pulse, SPO2, Respi, and Neuro -->
            <tr>
                <td ></td>
                <th> <br><br>
                    <strong>A</strong><br><br>
                    <strong>V</strong><br><br>
                    <strong>P</strong><br><br>
                    <strong>U</strong><br>
                </th>
                <td></td>
                <td><br><br>
                    <input type="checkbox" name="Reg"> Reg<br><br><br>
                    <input type="checkbox" name="Irreg"> Irreg<br>
                </td>
                <td></td>
                <td><br><br>
                    <input type="checkbox" name="Regular"> Regular<br><br><br>
                    <input type="checkbox" name="Irreg"> Irregular<br><br><br>
                    <input type="checkbox" name="Labored"> Labored
                </td>
                <tH><BR><br>
                    <strong class="locba"> LOSS OF CONCIOUSNESS BEFORE ARRIVAL</strong><br><br>
                    <input type="checkbox" name="Regular"> Reg 
                    <input type="checkbox" name="Irreg"> Irreg<br><br><br>
                    <p><strong>CONCIOUSNESS UPON ARRIVAL</strong></p>
                    <input type="checkbox" name="yes"> Yes
                    <input type="checkbox" name="no"> No
                </tH>
                <td><br><br>
                    <input type="checkbox" name="assult"> Assult<br>
                    <input type="checkbox" name="no"> Attack/Bite Animal<br>
                    <input type="checkbox" name="yes"> Chemical Poisoning<br>
                    <input type="checkbox" name="no"> Drowning<br>
                    <input type="checkbox" name="yes"> Electrocution<br>
                    <input type="checkbox" name="no"> Excessive Heat<br>
                    <input type="checkbox" name="yes"> Fall<br>
                    <input type="checkbox" name="no"> RTA Bicycle<br>
                    <input type="checkbox" name="no"> RTA Motorbike<br>
                    <input type="checkbox" name="no"> RTA Pedestrian<br>
                    <input type="checkbox" name="no"> RTA Vehicle<br>
                    <input type="checkbox" name="no"> Water/ Air Transport Accident<br><br>
                </td>
            </tr>
            
        </table>

        <!-- Section 3: Mechanism of Injury (MOI) -->
        <table>
            <tr>
                <th> TYPES OF TRANSPORT</th>
                <th> AID PROIR TO ARRIVAL</th>
                <th colspan="2"> NATURE OF ILLNESS</th>
                <th > INVENTION/MANAGEMENT</th>
            </tr>

            <tr>
                <td rowspan="2"><br>
                    <input type="checkbox" name="emergencycall"> Emergency Call<br><br>
                    <input type="checkbox" name="hospitaltransfer"> Hospitan Transfer
                </td>
                

                <tr>
                    <td colspan="1"><br><input type="checkbox" name="none"> None<br><br>
                        <input type="checkbox" name="cpronly"> Yes, CPR Only<br><br>
                        <input type="checkbox" name="other"> Yes, Other <br><br>
                    </td>
                    <td rowspan="1"><input type="checkbox" name="none"> MEDICAL</td>
                    <td rowspan="1"><input type="checkbox" name="none"> TRAUMA</td>
                    
                    
                    
                     <td rowspan="2" colspan="3">
                        <input type="checkbox" name="none"> TRAUMA
                     </td>
                </tr>
                <td><br>  &emsp; Passengers<br><br>
                    <input type="checkbox" name="none"> M.D<br>
                    <input type="checkbox" name="none"> Respoder<br>
                    <input type="checkbox" name="none"> Relative
                </td>
                <td><br>  &emsp; Vehicular Extrication Required<br><br>
                    <input type="checkbox" name="none"> YEs<br>
                    <input type="checkbox" name="none"> No<br>
                    
                </td>

                
                <td rowspan="1"><br>
                    <input type="checkbox" name="none"> Repiratory<br>
                    <input type="checkbox" name="none"> Cardiac<br>
                    <input type="checkbox" name="none"> Medical<br>
                    <input type="checkbox" name="none"> OB / Gyne<br><br>
                </td>
                <td rowspan="1"><br>
                    <input type="checkbox" name="none"> Deformity <br>
                    <input type="checkbox" name="none"> Contusion <br>
                    <input type="checkbox" name="none"> Abrasion <br>
                    <input type="checkbox" name="none"> Puncture <br>
                    <input type="checkbox" name="none"> Burns  <br>
                    <input type="checkbox" name="none"> Tenderness <br> 
                    <input type="checkbox" name="none"> Laceration <br>
                    <input type="checkbox" name="none"> Swelling <br><br>
                </td>
            </tr> 
    
                
        </table>

        <!-- Section 4: History Taking -->
        <table>
            <tr>
                <th colspan="2" class="section-title">History Taking </th>
                <td colspan="9" class="section-title"> Physical Examinations  &emsp;&emsp; &emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</td>
            </tr>
            <td colspan="1">
                Signs/Symptoms <br><textarea rows="5" ></textarea><br><br>
                Allergies <br><textarea rows="4" ></textarea> <br><br>
                Medications <br><textarea rows="4" ></textarea> <br><br>
                Past Medical History <br><textarea rows="4" ></textarea> <br><br>
                Last Oral Intake <br><textarea rows="4" ></textarea> <br><br>
                Event Leading to Injury<br> or Illness <br> <textarea rows="4" ></textarea> <br><br>
            </td>
            <td colspan="1">
                Onset Pain <br><textarea rows="5" ></textarea><br><br>
                Provoking Factor <br><textarea rows="4" ></textarea> <br><br>
                Quality of Pain <br><textarea rows="4" ></textarea> <br><br>
                Radiation of Pain <br><textarea rows="4" ></textarea> <br><br>
                Severity of Pain <br><textarea rows="4" ></textarea> <br><br>
                Time <br> <textarea rows="4" ></textarea> <br><br>
            </td>

            <td colspan="1"><br><br><br><br><br><br> LEGEND :<br><br>
                <strong>D - </strong> Deformity<br>
                <strong>C - </strong> Contusion<br>
                <strong>A - </strong> Abrasion<br>
                <strong>P - </strong> Puncture<br>
                <strong>B - </strong> Burn<br>
                <strong>T - </strong> Tenderness<br>
                <strong>L - </strong> Laceration<br>
                <strong>S - </strong> Swelling<br>
            </td>
        </table>

        <!-- Section 5: Outcome -->
        <table>
            <tr>
                <td name="remarks" colspan="6"><strong>Remarks:</strong><br><br><textarea rows="4"></textarea></td>
            </tr>
            <tr>
                <td colspan="6"><strong>Outcome: </strong><br><br>
                 <input type="checkbox" name="none">Admitted To 
                 <input type="text" name="admitted_to"><br><br>
                 <input type="checkbox" name="none">Transferred To 
                 <input type="text" name="admitted_to"><br><br>
                 <input type="checkbox" name="none">D.O.A 
                </td>
            </tr>

        </table><br>

        <!-- Submit Button -->
        <div class="input-group">
            <input type="submit" value="Submit Report">
        </div>

    </form>
</body>
</html>
