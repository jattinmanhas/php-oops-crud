<?php
    error_reporting(0);
    include_once("./database/database.php");
    include_once("./classes/operations.php");

    $database = new Database();
    $db = $database -> getConnection();

    $operation = new Operations($db);
    $show = $operation -> getData();

    foreach($show as $row){
        $name = $row['name'];
        $age = $row['age'];
        $country = $row['country'];
        $gender = $row['gender'];
        $languages = $row['languages'];
        $comments = $row['comments'];
        $time = $row['birthdate'];
        $filename = $row['filename'];
    }

    $a = $languages;
    $b = explode(",",$a);

    if(isset($_POST['submit'])){
        $result = $operation -> update();
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" referrerpolicy="no-referrer" />
    <title>Update Page</title>
</head>

<body >
    <div class="text-center mx-auto mt-4 border border-purple-50 w-5/12 bg-gray-50 filter drop-shadow-lg">
        <h1 class="text-3xl mt-1 font-bold">Enter User Details</h1>
        <hr class="mr-40 ml-40 mt-2 mb-2">
        <form class="flex flex-col justify-center" action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="mt-4">
                <label class="text-gray-500 font-bold mb-1 pr-4 text-xl" for="">Name: </label>
                <input class="bg-gray-50 appearance-none border-2 border-gray-200 rounded w-2/4 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-700" type="text" name="name" value="<?php echo $name; ?>">
            </div>

            <div class="mt-4">
                <label class="text-gray-500 font-bold mb-1 pr-4 text-xl" for="">Age: </label>
                <input class="bg-gray-50 appearance-none border-2 border-gray-200 rounded w-2/4 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-700" type="number" name="age" value="<?php echo $age; ?>">
            </div>

            <div class="flex justify-center mt-4">
                <label class="text-gray-500 font-bold mb-1 pr-4 text-xl" for="">Country: </label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2" name="country">
                    <!-- <option value="" selected hidden>Select Country</option> -->
                    <option value="USA" <?php if($country == 'USA'){echo "selected";} ?> >USA</option>
                    <option value="UK" <?php if($country == 'UK'){echo "selected";} ?> >UK</option>
                    <option value="India" <?php if($country == 'India'){echo "selected";} ?> >India</option>
                </select>
            </div>


            <div class="mt-4">
                <label class="text-gray-500 font-bold mb-1 mr-4 pr-4 text-xl" for="">Gender:</label>
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" name="gender" value="Male" <?php if($gender == 'Male'){echo "checked";} ?> >&nbsp;<span class="text-lg mr-6">Male</span>
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" name="gender" value="Female" <?php if($gender == 'Female'){echo "checked";} ?> >&nbsp;<span class="text-lg mr-6">Female</span>
                <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500" type="radio" name="gender" value="Other" <?php if($gender == 'Other'){echo "checked";} ?> >&nbsp;<span class="text-lg mr-6">Other</span>
            </div>

            <div class="mt-4">
                <label class="text-gray-500 font-bold mb-1 pr-4 text-xl" for="">Languages: </label>
                <input type="checkbox" name="languages[]" value="English" <?php if(in_array("English", $b)){echo "checked";} ?>>&nbsp;English
                <input type="checkbox" name="languages[]" value="Hindi" <?php if(in_array("Hindi", $b)){echo "checked"; } ?> >&nbsp;Hindi
                <input type="checkbox" name="languages[]" value="Spanish" <?php if(in_array("Spanish", $b)){echo "checked";} ?>>&nbsp;Spanish
                <input type="checkbox" name="languages[]" value="Japanese" <?php if(in_array("Japanese", $b)){echo "checked"; } ?> >&nbsp;Japanese
            </div>


            <div class="flex justify-center mt-4">
                <label class="text-gray-500 font-bold mb-1 pr-4 text-xl" for="">Date: </label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 pl-10 p-1" type="date" name="birthdate" value="<?php echo $time;?>">
            </div>


            <div class="mt-4">
                <label class="text-gray-500 font-bold mb-1 pr-4 text-xl" for="">Upload File: </label>
                <input class="form-control
                    w-2/4
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0 outline-none
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" name="fileudate"> <span><?php echo $filename; ?></span>
            </div>


            <div class="mt-4">
                <textarea  rows="4" class="block p-2.5 w-3/4 mx-auto text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-600 focus:border-blue-700 transition ease-in duration-200 outline-none" placeholder="Comments" name="comments"><?php echo $comments; ?></textarea>
            </div>

            <br>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded p-4 m-2" type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>