<?php
    require "loaddata.php";//connection to header
    
    //Prepare variables
    $errors = [];
    $tableName = '';

    $title = '';
    $category = '0';
    $description = '';
    $location = '';
    $article = '';
    $reference = '';
    $password = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get Post Information
        $title = $_POST['title'];
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $description = $_POST['description'];
        $location = $_POST['location'];
        $article = $_POST['article'];
        $reference = $_POST['reference'];
        $password = $_POST['password'];
        $date = date('Y,m,d H:i:s');//create current date

        //Check whether required information has been given or give an error
        if (!$title || !$description || !$reference || !$password) {
            $errors[] = 'fill required information';
        }

        if (strlen($password) < 8 || strlen($password) > 16) {
            $errors[] = 'password must have 8-16 characters';
        }

        if ($category == '0') {
            $errors[] = 'please select a category';
        }if ($category=='1') {
            $tableName = 'places';
        } else if ($category=='2') {
            $tableName = 'hotels';
        } else if ($category=='3') {
            $tableName = 'transport';
        }

        if ($category != '0') {
            $id = RandomID($tableName, $pdo);//Generate id function according to the given table
        }

        //Make directory for image if there is not one
        if (!is_dir($tableName.'images')) {
            mkdir($tableName.'images');
        }

        if (empty($errors)) {
            //if the user has given an image rename the image according to the id and save it in suitable directory
            $image = $_FILES['image'] ?? null;
            $imagePath = '';

            if ($image && $image['tmp_name']) {
                $imagePath = $tableName.'images/'.$id.$image['name'];
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            //insert given details in the table
            $statement = $pdo->prepare("INSERT INTO $tableName (id, title, description, image, location, article, reference, password, create_date) VALUES (:id, :title, :description, :image, :location, :article, :reference, :password, :date) ");

            $statement->bindValue(':id', $id);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':image', $imagePath);
            $statement->bindValue(':location', $location);
            $statement->bindValue(':article', $article);
            $statement->bindValue(':reference', $reference);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':date', $date);

            $statement->execute();

            session_start();
            //save two sessions according to id and table name
            $_SESSION['currentId'] = $id;
            $_SESSION['currentTable'] = $tableName;
            header('Location: article.php');
        }
    }

    //Generate Id
    function RandomID ($table_name, $pdo) {
        //Get all ids according to the table
        $sql = "SELECT id FROM $table_name";
        $statement = $pdo->query($sql);
        $ids = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $a = 0;
        //loop untill create a unique id
        do {
            //Generate random id with 8 characters
            $str = '';
            for ($i=0; $i < 8; $i++) {
                $index = rand(0, strlen($characters) - 1);//select random character from characters
                $str .= $characters[$index];//concatenate to the str
            }
            
            //check whether created id already exist
            if (!empty($ids)) {
                foreach ($ids as $iD) {
                    if ($iD != $str) {
                        return $str;
                        $a = 0;
                    }
                }
            } else {
                return $str;//return unique id
                $a = 0;
            }
            
        } while ($a < 1);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- font awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- local style -->
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="style.css">
    <title>Wee Travel | Sri Lankan Travel Network</title>
</head>
<body>
    <header class="navbar">
        <div class="container">
            <h1>weeTravel</h1>
        </div>
    </header>
    <section class="create-form">
        <div class="container">
            <h1>Create New Article</h1>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <!-- Display Errors -->
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo $error ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" maxlength="100" placeholder="Enter Title" class="form-control" name="title" value="<?php echo $title ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category">
                        <option value="0" <?php if ($category == 0) echo 'selected'; ?>>Select Category</option>
                        <option value="1" <?php if ($category == 1) echo 'selected'; ?>>Place</option>
                        <option value="2" <?php if ($category == 2) echo 'selected'; ?>>Hotel</option>
                        <option value="3" <?php if ($category == 3) echo 'selected'; ?>>Transport</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" maxlength="100" placeholder="Enter Title" class="form-control" name="image">
                    <div class="form-text">(Optional)</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea type="text" maxlength="512" placeholder="Write a description" class="form-control" name="description"><?php echo $description ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <textarea type="text" maxlength="512" placeholder="Enter Location" class="form-control" name="location"><?php echo $location ?></textarea>
                    <div class="form-text">(Optional)</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Read More</label>
                    <textarea type="text" maxlength="512" placeholder="Enter link to article" class="form-control" name="article"><?php echo $article ?></textarea>
                    <div class="form-text">(Optional)</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Reference</label>
                    <textarea type="text" maxlength="512" placeholder="Enter link to website" class="form-control" name="reference"><?php echo $reference ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" maxlength="20" class="form-control" placeholder="Enter Password" name="password" value="<?php echo $password ?>">
                    <div class="form-text">Password must have 8-16 characters</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
    <?php
    require_once "footer.php";//Load footer
?>