<?php
    require_once "loaddata.php";//connection to header

    $id = $_GET['id'] ?? null;//Get the post id if there is one

    //just incase if there is not one redirect to home page
    if (!$id) {
        header('Location: home.php');
        exit;
    }

    session_start();

    $table = $_SESSION['currentTable'];//Get current table

    //select details according to the table
    $statement = $pdo->prepare("SELECT * FROM $table WHERE id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    $currentArticle = $statement->fetch(PDO::FETCH_ASSOC);

    //Define all varibles according to table details
    $errors = [];

    $title = $currentArticle['title'];
    $description = $currentArticle['description'];

    if ($currentArticle['location']) {
        $location = $currentArticle['location'];
    } else {
        $location = '';
    }

    if ($currentArticle['article']) {
        $article = $currentArticle['article'];
    } else {
        $article = '';
    }

    $reference = $currentArticle['reference'];
    $password = $currentArticle['password'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Change variables according to the post data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $article = $_POST['article'];
        $reference = $_POST['reference'];
        $password = $_POST['password'];

        //Check if required information given or give an error
        if (!$title || !$description || !$reference || !$password) {
            $errors[] = 'fill required information';
        }

        if (strlen($password) < 8 || strlen($password) > 16) {
            $errors[] = 'password must have 8-16 characters';
        }

        if (!is_dir($table.'images')) {
            mkdir($table.'images');
        }

        //Update or add image
        if (empty($errors)) {
            //get and rename the image according to the id and save image
            $image = $_FILES['image'] ?? null;
            $imagePath = $currentArticle['image'];

            if ($image && $image['tmp_name']) {
                //Delete the if there is an image
                if ($currentArticle['image']) {
                    unlink($currentArticle['image']);
                }

                $imagePath = $table.'images/'.$id.$image['name'];
                move_uploaded_file($image['tmp_name'], $imagePath);
            }

            //Update details according to new details
            $statement = $pdo->prepare("UPDATE $table SET title = :title, description = :description, image = :image, location = :location, article = :article, reference = :reference, password = :password WHERE id = :id");

            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':image', $imagePath);
            $statement->bindValue(':location', $location);
            $statement->bindValue(':article', $article);
            $statement->bindValue(':reference', $reference);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':id', $id);

            $statement->execute();

            header('Location: article.php');//Redirect to article page
        }
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
    <section class="edit-form">
        <div class="container">
            <h1>Edit Article</h1>
            <p>Content Id : <?php echo $_SESSION['currentId']; ?></p>
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
                <div>
                    <?php if ($currentArticle['image']): ?>
                        <img src="<?php echo $currentArticle['image'];?>" style="width: 300px;">
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" maxlength="100" class="form-control" name="image">
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
                    <input type="password" maxlength="16" class="form-control" placeholder="Enter Password" name="password" value="<?php echo $password ?>">
                    <div class="form-text">Password must have 8-16 characters</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
    <?php
    require_once "footer.php";
?>