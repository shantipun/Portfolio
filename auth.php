<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "website"; // change this

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";
$error = "";

// Handle Register
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Email or username already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $username, $email, $password);
        if ($stmt->execute()) {
            $success = "Registration successful!";
        } else {
            $error = "Registration failed!";
        }
    }
}

// Handle Login
if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $success = "Login successful!";
            // You can redirect or set session here
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login & Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function toggleForm(showRegister) {
      document.getElementById("loginForm").classList.toggle("hidden", showRegister);
      document.getElementById("registerForm").classList.toggle("hidden", !showRegister);
      document.getElementById("toggleLogin").classList.toggle("text-cyan-400", !showRegister);
      document.getElementById("toggleRegister").classList.toggle("text-cyan-400", showRegister);
    }
  </script>
</head>
<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 min-h-screen flex items-center justify-center text-white p-4">

  <div class="bg-gray-800 p-8 rounded-2xl shadow-xl w-full max-w-md">
    <!-- Switch buttons -->
    <div class="flex justify-between mb-6 text-lg font-semibold">
      <button id="toggleLogin" onclick="toggleForm(false)" class="w-1/2 text-center border-b-2 border-cyan-400 text-cyan-400">Login</button>
      <button id="toggleRegister" onclick="toggleForm(true)" class="w-1/2 text-center border-b-2 border-transparent hover:text-cyan-300">Register</button>
    </div>

    <!-- Success/Error Message -->
    <?php if ($success): ?>
      <div class="bg-green-600 text-white p-2 mb-4 rounded"><?php echo $success; ?></div>
    <?php elseif ($error): ?>
      <div class="bg-red-600 text-white p-2 mb-4 rounded"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Login Form -->
    <form id="loginForm" class="space-y-5" method="post" action="">
      <div>
        <label for="loginEmail" class="text-sm">Email</label>
        <input type="email" id="loginEmail" name="email" required placeholder="Enter your email"
               class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:ring-cyan-400">
      </div>
      <div>
        <label for="loginPassword" class="text-sm">Password</label>
        <input type="password" id="loginPassword" name="password" required placeholder="Enter your password"
               class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:ring-cyan-400">
      </div>
      <button type="submit" name="login"
              class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-2 rounded-lg">
        Login
      </button>
    </form>

    <!-- Register Form -->
    <form id="registerForm" class="space-y-5 hidden" method="post" action="">
      <div>
        <label for="fullname" class="text-sm">Full Name</label>
        <input type="text" id="fullname" name="fullname" required placeholder="Enter full name"
               class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:ring-cyan-400">
      </div>
      <div>
        <label for="username" class="text-sm">User Name</label>
        <input type="text" id="username" name="username" required placeholder="Enter user name"
               class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:ring-cyan-400">
      </div>
      <div>
        <label for="registerEmail" class="text-sm">Email</label>
        <input type="email" id="registerEmail" name="email" required placeholder="Enter your email"
               class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:ring-cyan-400">
      </div>
      <div>
        <label for="registerPassword" class="text-sm">Password</label>
        <input type="password" id="registerPassword" name="password" required placeholder="Enter your password"
               class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-700 border border-gray-600 focus:ring-cyan-400">
      </div>
      <button type="submit" name="register"
              class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-2 rounded-lg">
        Register
      </button>
    </form>
  </div>

</body>
</html>
