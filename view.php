<?php
error_reporting(0);
include_once "./database/database.php";
include_once "./classes/operations.php";

$database = new Database();
$db = $database->getConnection();

$operation = new Operations($db);
$show = $operation->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" referrerpolicy="no-referrer" />
    <title>View Users</title>
</head>

<body>
    <div>
        <h1 class="text-3xl mt-1 font-bold text-center">All User's Details</h1>
        <hr class=" block mt-2 mb-2 w-96 mx-auto">
        <table class="border-collapse border border-black-800 m-8">
            <thead>
                <tr>
                    <th class="border border-black-600 p-2">ID</th>
                    <th class="border border-black-600 p-2">NAME</th>
                    <th class="border border-black-600 p-2">AGE</th>
                    <th class="border border-black-600 p-2">COUNTRY</th>
                    <th class="border border-black-600 p-2">GENDER</th>
                    <th class="border border-black-600 p-2">LANGUAGES</th>
                    <th class="border border-black-600 p-2">BIRTHDATE</th>
                    <th class="border border-black-600 p-2">COMMENTS</th>
                    <th class="border border-black-600 p-2">FILE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($show as $row){
                ?>
                <tr>
                    <td class="border border-black-600 p-2"><?php echo $row['id']; ?></td>
                    <td class="border border-black-600 p-2"><?php echo $row['name']; ?></td>
                    <td class="border border-black-600 p-2"><?php echo $row['age']; ?></td>
                    <td class="border border-black-600 p-2"><?php echo $row['country']; ?></td>
                    <td class="border border-black-600 p-2"><?php echo $row['gender']; ?></td>
                    <td class="border border-black-600 p-2"><?php echo $row['languages']; ?></td>
                    <td class="border border-black-600 p-2"><?php echo $row['birthdate']; ?></td>
                    <td class="border border-black-600 p-2"><?php echo $row['comments']; ?></td>
                    <td class="border border-black-600 p-2"><?php echo $row['filename']; ?></td>
                    <td class="border border-black-600 p-2"><a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;&nbsp; <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>