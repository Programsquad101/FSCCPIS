<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Farmingdale CPIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name ="description" content = "Check out what is going on with the CPIS Department at Farmingdale">
    <meta name="author" content="cpis.com">
    <link rel="stylesheet" type="text/css" media="screen" href="css/tutor_signup.css" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script src="js/tutor_signup.js"></script>
</head>

<body>
    <main>

            <div class="header">
                    <h1> <a href="index.php" id="title">Farmingdale CPIS</a></h1>
            </div>

        <div class="container">
            <form action="scripts/create_tutor.php" method="post">
                <h2 style="text-align:center;">Tutor Sign Up</h2>

                <div class="group">
                    <input  name="username" class="inputMaterial" type="text" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Username</label>
                </div>
                <div class="group">
                    <input name="password" class="inputMaterial" type="password" id="myInput" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Password</label>
                    <div class="main1">
                        <div id="div1"></div>
                        <div id="div2"><input type="checkbox" id="showPassword" onclick="myFunction()"> </div>
                    </div>

                </div>
                <div class="group">
                    <input name="firstName" class="inputMaterial" type="text" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>First name</label>
                </div>
                <div class="group">
                    <input name="lastName" class="inputMaterial" type="text" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Last Name</label>
                </div>


                <!-- <div class="group">
                    <input id="location-input" name="address" class="inputMaterial" type="text">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Address</label>
                </div>This is where geocde takes the address and finds lat and long. lat and long does not print to user. css is display:none
                <div id="full-address"></div>
                <div id="lat"></div>
                <div id="lng"></div>
                END GEOCODE !-->

                <div class="group">
                    <input name="email" class="inputMaterial" type="text" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Email</label>
                </div>

                  <h2>Skills</h2>
                    BCS 120<input name="skills[]" type="checkbox" value="BCS 120">
                    BCS 230<input name="skills[]" type="checkbox" value="BCS 230">
                    Java<input name="skills[]" type="checkbox" value="Java">
                    BCS 430W<input name="skills[]" type="checkbox" value="BCS 430W">
                    Perl<input name="skills[]" type="checkbox" value="Perl">
                    BCS 370<input name="skills[]" type="checkbox" value="BCS 370">
                    JavaScript<input name="skills[]" type="checkbox" value="JavaScript">
                    XML<input name="skills[]" type="checkbox" value="XML">
                    SQL<input name="skills[]" type="checkbox" value="SQL">


                <div class="group">
                    <input name="pricing" class="inputMaterial" type="text" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Pricing</label>
                </div>

                <div class="group2">
                        <div id="div3"><label>Status:</label> </div>
                        <div id="div4">
                            <input type="radio" name="status" value="Student"> Student
                            <input type="radio" name="status" value="Teacher"> Teacher
                            <input type="radio" name="status" value="Other"> Other
                        </div>
                </div>

                <button  name="submit" id="btn_login" type="submit">Sign Up</button>
              </form>
        </div>
    </main>
</body>

</html>
