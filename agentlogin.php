<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dialpro2";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $phone_username = $_POST["phone_username"];
    $phone_password = $_POST["phone_password"];
    $user_username = $_POST["user_username"];
    $user_password = $_POST["user_password"];
    $campaign = $_POST["campaign"];

    // Hash the passwords using password_hash
    $hashed_phone_password = password_hash($phone_password, PASSWORD_DEFAULT);
    $hashed_user_password = password_hash($user_password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM login_info WHERE phone_username = '$phone_username' AND user_username = '$user_username' AND campaign = '$campaign'";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        if (password_verify($phone_password, $row['phone_password']) && password_verify($user_password, $row['user_password'])) {
            // Valid login credentials, redirect to join.php
            header("Location: join.php");
            exit();
        } else {
            // Invalid login credentials
            echo "Invalid credentials";
        }
    } else {
        echo "Query error: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Agent Login</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/login.css">
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="brand_logo_container">
                    <img src="/img/agentlogo.png" class="brand_logo" alt="Agent Logo">
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="join.php" method="post">
                        <!-- Phone Login -->
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" name="phone_username" id="phone_username"
                                class="form-control input_user" placeholder="Phone Login" required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="phone_password" id="phone_password"
                                class="form-control input_pass" placeholder="Phone Password" required>
                        </div>

                        <!-- User Login -->
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="user_username" id="user_username"
                                class="form-control input_user" placeholder="User Login" required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="user_password" id="user_password"
                                class="form-control input_pass" placeholder="User Password" required>
                        </div>

                        <!-- Campaign Selection -->
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-bullhorn"></i></span>
                            </div>
                            <select name="campaign" id="campaign" class="form-control" required>
                                <option value="" disabled selected>Select Campaign</option>
                                <?php
                                // Establish database connection
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "dialpro2";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Fetch campaign data from the database
                                $sql = "SELECT campaign FROM login_info"; // Modify the query as needed
                                $result = $conn->query($sql);

                                $options = '<option value="" disabled selected>Select Campaign</option>';
                                while ($row = $result->fetch_assoc()) {
                                    $options .= '<option value="' . $row['campaign'] . '">' . $row['campaign'] . '</option>';
                                }

                                echo $options;

                                $conn->close();
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="d-flex justify-content-center mt-3 login_container">
                    <button type="button" name="button" id="login" class="btn login_btn">Login</button>
                </div>
                <div class="d-flex justify-content-center mt-3 login_container">
                    <button type="refresh" name="button" id="refresh" class="btn login_btn">Refresh Campaign List</button>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#refresh').click(function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'GET',
                    url: 'fetch_campaigns.php', // Verify the correct PHP file name
                    success: function (data) {
                        console.log("Fetched data:", data); // Debugging
                        $('#campaign').html(data);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching campaign data:", error); // Debugging
                        alert('There were errors while fetching campaign data.');
                    }
                });
            });

            $('#login').click(function (e) {
                var valid = this.form.checkValidity();

                if (valid) {
                    var phone_username = $('#phone_username').val();
                    var phone_password = $('#phone_password').val();
                    var user_username = $('#user_username').val();
                    var user_password = $('#user_password').val();
                    var campaign = $('#campaign').val();
                }

                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'agentlogin.php', 
                    data: {
                        phone_username: phone_username,
                        phone_password: phone_password,
                        user_username: user_username,
                        user_password: user_password,
                        campaign: campaign
                    },
                    success: function (data) {
                        console.log("Login response:", data); // Debugging
                        if ($.trim(data) === "1") {
                            // Redirect to join.php after successful login
                            window.location.href = 'join.php';
                        } else {
                            alert('Login failed. Please check your credentials.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error during login:", error); // Debugging
                        alert('There were errors while doing the operation.');
                    }
                });
            });
        });
    </script>
</body>

</html>
