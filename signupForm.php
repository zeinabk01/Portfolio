<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Signup</title>
</head>
<?php
  // Start the session to access session variables
  session_start();

  // Check if there are any errors in the session
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    echo '<div class="bg-red-500 text-white p-4 mb-5 rounded-md fixed top-10 right-10">';

    if (is_array($_SESSION['error'])) {
        // If $_SESSION['error'] is an array, iterate through it
        foreach ($_SESSION['error'] as $error) {
            echo '<p class="text-[18px]"><b>Error:</b> ' . $error . '</p>';
        }
    } else {
        // If $_SESSION['error'] is not an array, just echo it
        echo '<p class="text-[18px]"><b>Error:</b> ' . $_SESSION['error'] . '</p>';
    }

    echo '</div>';

    // Clear the errors from the session
    unset($_SESSION['error']);
}
  ?>
<body
    class="bg-[url(https://tse3.mm.bing.net/th?id=OIP.ouyt-LCQK5fQ3BeHi79KAwHaEK&pid=Api&P=0&h=220)] bg-cover">
    <form id="signupForm" class="w-full flex items-center justify-center min-h-[100dvh]" action="signup.php" method="POST">
    <article class="rounded-[12px] bg-[white] border border-solid border-[lightgrey] pb-10 w-[min(85%,450px)] relative">
        <div id="banner" class="w-full h-[50px] bg-[#002cff] rounded-[12px]"></div>

        <div class="px-7">
            <h2 class="mb-10 text-[32px] w-fit mx-auto">Sign Up</h2>

            <section class="flex flex-col gap-5 mb-7">
                <div class="flex flex-col gap-1">
                    <label class="text-[18px]" for="userName">Username:</label>
                    <input class="text-[18px] border border-solid border-[lightgrey rounded-[2px] pl-3 py-2" type="text"
                        id="userName" name="userName" required>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-[18px]" for="fullName">Full Name:</label>
                    <input class="text-[18px] border border-solid border-[lightgrey rounded-[2px] pl-3 py-2" type="text"
                        id="fullName" name="fullName" required>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-[18px]" for="fullName" for="password">Password:</label>
                    <input class="text-[18px] border border-solid border-[lightgrey rounded-[2px] pl-3 py-2"
                        type="password" id="password" name="password" required>
                </div>
            </section>

            <section class="flex items-end justify-between mb-5">
                <div class="flex flex-col gap-1">
                <label for="dob">Date of Birth:</label>
                <input class="border border-solid border-[lightgrey]" type="date" id="dob" name="dob" required>
            </div>
                <div class="w-fit ml-auto"><b>Already a member?</b> <a href="loginForm.php">Login</a></div>
            </section>

            <section class="w-full mx-auto flex gap-5">
                <div class="flex-1 border border-solid border-[lightgrey] rounded-[11px] flex cursor-pointer overflow-hidden">
                    <div onclick="setGender('Male')" id="Male"
                        class="flex-1 py-2 border-r border-solid border-[lightgrey] flex items-center justify-center gender hover:bg-[lightgrey] duration-[300ms]">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z" />
                        </svg>
                    </div>
                    <div onclick="setGender('Female')" id="Female"
                        class="flex-1 py-2 flex items-center justify-center gender hover:bg-[lightgrey] duration-[300ms]"><svg
                            xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M160 0a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM88 384H70.2c-10.9 0-18.6-10.7-15.2-21.1L93.3 248.1 59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l53.6-89.2c20.3-33.7 56.7-54.3 96-54.3h11.6c39.3 0 75.7 20.6 96 54.3l53.6 89.2c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9l-33.9-56.3L265 362.9c3.5 10.4-4.3 21.1-15.2 21.1H232v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384H152v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V384z" />
                        </svg></div>
                </div>

                <input type="hidden" id="sex" name="sex" id="sex" value="Male">
                <button class="flex-1 py-2 border border-solid border-[lightgrey] hover:bg-[lightgrey] duration-[300ms] rounded-[11px]"
                    type="submit">Signup</button>
            </section>


        </div>
    </article>
    </form>
    <script>
        function setGender(gender) {
            // Set gender value in the hidden input
            document.getElementById('sex').value = gender;

            // Set background color based on gender for the 'banner' div
            const bannerDiv = document.getElementById('banner');
            if (gender === 'Male') {
                bannerDiv.style.backgroundColor = '#002cff';
            } else if (gender === 'Female') {
                bannerDiv.style.backgroundColor = '#ff008b';
            }
        }
    </script>


</body>

</html>
