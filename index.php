<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shanti - Web Designer</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Fade-in animation on load
    document.addEventListener("DOMContentLoaded", () => {
      document.querySelectorAll('.fade-in').forEach(el => {
        el.classList.remove('opacity-0');
        el.classList.add('opacity-100');
      });
    });
  </script>
  <style>
    .transition-fade {
      transition: opacity 1.5s ease, transform 1.5s ease;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-[#0f2027] via-[#203a43] to-[#2c5364] text-white font-sans scroll-smooth">
  <div class="max-w-7xl mx-auto p-6">
    
    <!-- Navbar -->
    <div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 drop-shadow-lg">
  Portfolio
</h2>

      <ul class="flex space-x-6 text-sm font-semibold">
        <li><a href="index.php" class="hover:text-cyan-400 transition">HOME</a></li>
        <li><a href="index1.php" class="hover:text-cyan-400 transition">ABOUT</a></li>
        <li><a href="Skill.php" class="hover:text-cyan-400 transition">SKILLS</a></li>
        <li><a href="mywork.php" class="hover:text-cyan-400 transition">MY WORKS</a></li>
        <li><a href="auth.php" class="hover:text-cyan-400 transition">CONTACT</a></li>
      </ul>
    </div>

    <!-- Content -->
    <div class="flex flex-col md:flex-row items-center gap-10 fade-in opacity-0 transition-fade">
      <!-- Info -->
      <div class="flex-1">
        <h3 class="text-xl mb-2">Hi, I'm <span class="text-cyan-400 font-semibold">Shanti.</span></h3>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
          <span class="text-cyan-400">W</span>EB <span class="text-cyan-400">D</span>ESIGNER
        </h1>
        <p class="text-lg leading-relaxed mb-6">
          Web designer and developer from Nepal.<br />
          I create websites to help businesses grow online.
        </p>
        <a href="#" class="inline-block px-6 py-3 bg-cyan-400 text-black font-semibold rounded-lg shadow hover:bg-cyan-500 transition">Hire Me</a>
      </div>

      <!-- Image -->
      <div class="flex-1 flex justify-center md:justify-end">
        <img src="photos/9.png" alt="Profile" class="w-100 md:w-170 rounded-xl shadow-lg transform hover:scale-105 transition duration-500" />
      </div>
    </div>

    <!-- Social Icons -->
    <div class="flex space-x-6 mt-10 justify-center md:justify-start">
      <a href="https://www.facebook.com/" target="_blank" class="text-cyan-400 text-2xl hover:scale-125 transition">
        <ion-icon name="logo-facebook"></ion-icon>
      </a>
      <a href="https://www.instagram.com/" target="_blank" class="text-cyan-400 text-2xl hover:scale-125 transition">
        <ion-icon name="logo-instagram"></ion-icon>
      </a>
      <a href="https://x.com/" target="_blank" class="text-cyan-400 text-2xl hover:scale-125 transition">
        <ion-icon name="logo-twitter"></ion-icon>
      </a>
    </div>
  </div>

  <!-- Icons CDN -->
  <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
