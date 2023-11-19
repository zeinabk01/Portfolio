<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-[url(https://tse3.mm.bing.net/th?id=OIP.ouyt-LCQK5fQ3BeHi79KAwHaEK&pid=Api&P=0&h=220)] bg-cover">
    <?php
    // Start the session
    session_start();

    // Retrieve the userName from the session
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : '';

    if ($user === '') {
        header('Location: loginForm.php');
    }

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
    }

    // Define the common upload directory
    $uploadDir = __DIR__ . "/gallery/";

    // Read the gallery data from gallery.json
    $galleryData = [];

    if (file_exists('gallery.json')) {
        $galleryData = json_decode(file_get_contents('gallery.json'));
    }

    // Filter images based on the user's userName
    $userImages = array_filter($galleryData, function ($image) use ($user) {
        return $image->userName === $user->userName;
    });

    ?>
    <nav class="w-full flex items-center justify-between px-10 bg-[black] py-3">
        <section class="flex gap-5">
            <div class="max-w-[55px] rounded-full overflow-hidden">
                <img class="object-fit-cover"
                    src="https://tse3.mm.bing.net/th?id=OIP.eyhIau9Wqaz8_VhUIomLWgHaHa&pid=Api&P=0&h=220"
                    alt="profile pic" />
            </div>
            <div>
                <h2 class="text-[white] text-[18px]">
                    <?php echo ($user->fullName) ?>
                </h2>
                <h2 class="text-[14px] text-[lightgrey]">
                    <?php echo ($user->userName) ?>
                </h2>
            </div>
        </section>

        <section class="flex gap-5">
            <button onclick="openImagePicker()"
                class="text-[white] hover:text-black border border-solid border-[lightgrey] duration-[300ms] hover:bg-[lightgrey] rounded-[12px] py-2 w-[120px]">Add
                Image</button>
            <button onclick="handleLogout()"
                class="text-[white] hover:text-black border border-solid border-[lightgrey] duration-[300ms] hover:bg-[lightgrey] rounded-[12px] py-2 w-[120px]">Logout</button>
        </section>
    </nav>


    <section>
        <div class="grid gap-10 mx-auto w-[min(85%,1000px)] md:grid-cols-2 lg:grid-cols-3 mt-20">
            <?php
            // Display the user's images
            if (!empty($userImages)) {

                foreach ($userImages as $image) {
                    echo "<div class='px-5 pt-5 pb-20  bg-white rounded-[12px] flex flex-col justify-between'><img class='h-full mb-5 object-cover border border-solid border-[black]' src='{$image->imagePath}' alt='displayed gallery'/><p class='text-[18px]'>image path: {$image->imagePath}</p></div>";
                }
            } else {
                echo "<p class='text-white'>No images found for $user->userName. consider adding some images</p>";
            }
            ?>
    </section>
    </div>

    <!-- Popup form -->
    <div class="popup" id="popupForm">
    <form action="gallery.php" method="post" enctype="multipart/form-data">
        <input class="hidden" type="file" name="image" id="fileInput" accept="image/*" required>

        <input type="hidden" name="userName" value="<?php echo $user->userName; ?>">

        <input type="submit" id="submitButton" class="hidden">
    </form>
</div>
    <script>
        function handleLogout(){
            sessionStorage.clear();
            window.location.href='loginForm.php'
        }


        function openImagePicker() {
        var fileInput = document.getElementById("fileInput");

        // Add an event listener to handle file selection
        fileInput.addEventListener('change', () => {
            // Check if a file has been selected
            if (fileInput.files.length > 0) {
                document.getElementById('submitButton').click()
            }
        });

        fileInput.click();
    }

    </script>
</body>

</html>
