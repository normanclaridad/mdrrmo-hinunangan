<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: bold;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .form-group {
            flex: 1 1 calc(50% - 20px);
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #555;
        }
        input[type="text"], input[type="number"], input[type="datetime-local"], select, input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fafafa;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .section-header {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .radio-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .radio-group label {
            margin-right: 20px;
            font-weight: normal;
            font-size: 14px;
        }
        .submit-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .card {
            border: 0;
            background: #fff;
        }
        .card {
            --bs-card-spacer-y: 1rem;
            --bs-card-spacer-x: 1rem;
            --bs-card-title-spacer-y: 0.5rem;
            --bs-card-title-color: #343a40;
            --bs-card-subtitle-color: ;
            --bs-card-border-width: var(--bs-border-width);
            --bs-card-border-color: var(--bs-border-color-translucent);
            --bs-card-border-radius: 0.3125rem;
            --bs-card-box-shadow: ;
            --bs-card-inner-border-radius: calc(var(--bs-border-radius) -(var(--bs-border-width)));
            --bs-card-cap-padding-y: 0.5rem;
            --bs-card-cap-padding-x: 1rem;
            --bs-card-cap-bg: rgba(var(--bs-body-color-rgb), 0.03);
            --bs-card-cap-color: ;
            --bs-card-height: ;
            --bs-card-color: ;
            --bs-card-bg: #fff;
            --bs-card-img-overlay-padding: 1rem;
            --bs-card-group-margin: 0.75rem;
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            color: var(--bs-body-color);
            word-wrap: break-word;
            background-color: var(--bs-card-bg);
            background-clip: border-box;
            border: var(--bs-card-border-width) solid var(--bs-card-border-color);
            border-radius: var(--bs-card-border-radius);
        }
    </style>
    <script>
        function updateWaterLevelColor() {
            const waterLevelInput = document.getElementById("waterLevel");
            const waterLevelValue = Number(waterLevelInput.value);
            if (waterLevelValue < 0) {
                waterLevelInput.style.backgroundColor = "#ffffff"; // Reset to white for negative values
            } else if (waterLevelValue <= 50) {
                waterLevelInput.style.backgroundColor = "yellow";
            } else if (waterLevelValue <= 70) {
                waterLevelInput.style.backgroundColor = "orange";
            } else if (waterLevelValue <= 100) {
                waterLevelInput.style.backgroundColor = "red";
            } else {
                waterLevelInput.style.backgroundColor = "#ffffff"; // Reset to white for values above 100
            }
        }
    </script>
</head>
<body>

    <div class="container">
        <h1>Incident Report Form</h1>
        <form>
            <!-- Left Column -->
            <div class="form-group">
                <div class="section-header">Suspension</div>
                <label for="schoolList">Select School Level:</label>
                <select id="schoolList" name="schoolList">
                    <option value="primary">Primary</option>
                    <option value="secondary">Secondary</option>
                    <option value="tertiary">Tertiary</option>
                </select>

                <div class="section-header">Landslide</div>
                <label for="landslideLocation">Select Barangay Location:</label>
                <select id="landslideLocation" name="landslideLocation">
                    <option value="barangay1">Barangay 1</option>
                    <option value="barangay2">Barangay 2</option>
                    <option value="barangay3">Barangay 3</option>
                    <option value="barangay4">Barangay 4</option>
                    <!-- Add more barangay options as needed -->
                </select>

                <div class="section-header">Floods</div>
                <label for="floodLocation">Select Barangay Location:</label>
                <select id="floodLocation" name="floodLocation">
                    <option value="barangay1">Barangay 1</option>
                    <option value="barangay2">Barangay 2</option>
                    <option value="barangay3">Barangay 3</option>
                    <option value="barangay4">Barangay 4</option>
                    <!-- Add more barangay options as needed -->
                </select>
            </div>

            <!-- Right Column -->
            <div class="form-group">
                <div class="section-header">Engineering Office</div>
                <label for="bridgeList">List of Bridges (Location):</label>
                <input type="text" id="bridgeList" name="bridgeList" placeholder="e.g., Bridge A, Bridge B">
                
                <label for="roadList">List of Roads (Location):</label>
                <input type="text" id="roadList" name="roadList" placeholder="e.g., Road 1, Road 2">

                <div class="section-header">Damage</div>
                <label for="damageLocation">Location (Property Name):</label>
                <input type="text" id="damageLocation" name="damageLocation" placeholder="Property Name">
                <label>Type of Damage:</label>
                <div class="radio-group">
                    <input type="radio" id="partial" name="damageType" value="partial">
                    <label for="partial">Partial</label>
                    <input type="radio" id="total" name="damageType" value="total">
                    <label for="total">Total</label>
                </div>

                <label for="householdsAffected">Households Affected:</label>
                <input type="number" id="householdsAffected" name="householdsAffected" placeholder="e.g., 5">
            </div>

            <!-- Full Width for Casualties -->
            <div class="form-group" style="flex: 1 1 100%;">
                <div class="section-header">Casualties</div>
                <label for="casualtyLocation">Location:</label>
                <select id="casualtyLocation" name="casualtyLocation">
                    <option value="barangay1">Barangay 1</option>
                    <option value="barangay2">Barangay 2</option>
                    <option value="barangay3">Barangay 3</option>
                    <option value="barangay4">Barangay 4</option>
                    <!-- Add more barangay options as needed -->
                </select>

                <label for="casualtyName">Name:</label>
                <input type="text" id="casualtyName" name="casualtyName" placeholder="Full Name">

                <label for="mdt">MDT:</label>
                <input type="text" id="mdt" name="mdt" placeholder="e.g., MDT 12345">

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" placeholder="Age">

                <label for="gender">Gender:</label>
                <select name="gender" id="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="LGBTQ">LGBTQ+</option>
                </select>
            </div>

            <!-- Right Column for Evacuees, Water Level -->
            <div class="form-group">
                <div class="section-header">Evacuees</div>
                <label for="evacLocation">Location:</label>
                <select id="evacLocation" name="evacLocation">
                    <option value="barangay1">Barangay 1</option>
                    <option value="barangay2">Barangay 2</option>
                    <option value="barangay3">Barangay 3</option>
                    <option value="barangay4">Barangay 4</option>
                    <!-- Add more barangay options as needed -->
                </select>

                <label>Age Bracket:</label>
                <select name="ageBracket" id="ageBracket">
                    <option value="5-10">5-10</option>
                    <option value="11-20">11-20</option>
                </select>
            </div>

            <!-- Water Level Section -->
            <div class="form-group" style="flex: 1 1 100%;">
                <div class="section-header">Water Level</div>
                <label for="waterLocation">Location:</label>
                <select id="waterLocation" name="waterLocation">
                    <option value="barangay1">Barangay 1</option>
                    <option value="barangay2">Barangay 2</option>
                    <option value="barangay3">Barangay 3</option>
                    <option value="barangay4">Barangay 4</option>
                    <!-- Add more barangay options as needed -->
                </select>

                <label for="waterLevel">Water Level (cm):</label>
                <input type="number" id="waterLevel" name="waterLevel" placeholder="Water Level (cm)" oninput="updateWaterLevelColor()">
            </div>

            <!-- Electricity and Stranded -->
            <div class="form-group" style="flex: 1 1 100%;">
                <div class="section-header">Electricity</div>
                <label for="electricityStatus">Status:</label>
                <input type="text" id="electricityStatus" name="electricityStatus" placeholder="e.g., No interruptions">

                <div class="section-header">Stranded</div>
                <label for="strandedLocation">Location:</label>
                <input type="text" id="strandedLocation" name="strandedLocation" placeholder="Bus Terminal">
                <label for="strandedType">Type:</label>
                <select id="strandedType" name="strandedType">
                    <option value="local">Local</option>
                    <option value="tourist">Tourist</option>
                </select>
                <label for="strandedCount">Count:</label>
                <input type="number" id="strandedCount" name="strandedCount" placeholder="Number of Stranded">
            </div>

            <!-- Communication -->
            <div class="form-group" style="flex: 1 1 100%;">
                <div class="section-header">Communication</div>
                <label for="telcoName">Telco Name:</label>
                <input type="text" id="telcoName" name="telcoName" placeholder="Telco Provider">
                <label for="signalStatus">Signal Status:</label>
                <input type="text" id="signalStatus" name="signalStatus" placeholder="e.g., No Signal">
                <label for="restoreTime">Restore (Date/Time):</label>
                <input type="datetime-local" id="restoreTime" name="restoreTime">
            </div>

            <!-- Submit Button -->
            <div class="submit-container">
                <input type="submit" value="Submit Report">
            </div>
        </form>
    </div>

    <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Horizontal Two column</h4>
            <form class="form-sample">
              <p class="card-description"> Personal info </p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">First Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Last Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-9">
                      <select class="form-select">
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date of Birth</label>
                    <div class="col-sm-9">
                      <input class="form-control" placeholder="dd/mm/yyyy" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                      <select class="form-select">
                        <option>Category1</option>
                        <option>Category2</option>
                        <option>Category3</option>
                        <option>Category4</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Membership</label>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" checked> Free </label>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2"> Professional </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <p class="card-description"> Address </p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address 1</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">State</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address 2</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Postcode</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">City</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Country</label>
                    <div class="col-sm-9">
                      <select class="form-select">
                        <option>America</option>
                        <option>Italy</option>
                        <option>Russia</option>
                        <option>Britain</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

</body>
</html>
