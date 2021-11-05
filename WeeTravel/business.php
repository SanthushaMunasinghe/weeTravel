<?php
    require_once "header.php";//connection to header

    require "loaddata.php";//connection to header
    
    session_start();

    $errors = [];//create errors array
    //create requred variables
    $tableName = '';

    $id = '';
    $category = '0';
    $password = '';

    //Submiting the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Get post information
        $id = $_POST['id'];
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        //Check requred information is given by the user and if not give errors
        if (!$id || !$password) {
            $errors[] = 'fill required information';
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

        //if requred information is given check validate them
        if ($category != 0 && $password && $id) {
            //Check if there are rows according to the id and get the row count
            $query = $pdo->prepare("SELECT * FROM $tableName WHERE id = ?");
            $query->execute([$id]);
            $result = $query->rowCount();

            if ($result > 0) {
                //Get data according to the id
                $statement = $pdo->prepare("SELECT * FROM $tableName WHERE id = :id");
                $statement->bindValue(':id', $id);
                $statement->execute();
                $currentId = $statement->fetch(PDO::FETCH_ASSOC);

                //Match the password with the user given password
                if ($password == $currentId['password']) {
                    //save two sessions according to id and table name
                    $_SESSION['currentId'] = $id;
                    $_SESSION['currentTable'] = $tableName;
                    header('Location: article.php');//load the article
                } else {
                    $errors[] = 'password incorrect!';
                }
            } else {
                $errors[] = 'invalid id';
            }
        }
    }


?>
    <!-- coptions -->
    <section class="options">
        <div class="container">
            <div class="card">
                <h1>Edit Content</h1>
                <p>You can edit content by clicking the edit button down below. Make sure to enter correct details to get the correct article.</p>
                <?php if (!empty($errors)): ?>
                <div style="color: #ff0000;">
                    <!-- Display errors -->
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo $error ?></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="search-inputs">
                    <form method="POST">
                    <select name="category" style="display: block;">
                        <option value="0" <?php if ($category == 0) echo 'selected'; ?>>Select Category</option>
                        <option value="1" <?php if ($category == 1) echo 'selected'; ?>>Place</option>
                        <option value="2" <?php if ($category == 2) echo 'selected'; ?>>Hotel</option>
                        <option value="3" <?php if ($category == 3) echo 'selected'; ?>>Transport</option>
                    </select>
                        <input type="text" class="searchbar-dark" maxlength="8" placeholder="Type Content ID" name="id" value="<?php echo $id ?>">
                        <input type="password" class="searchbar-dark" maxlength="16" placeholder="Password" name="password" style="display: block;">
                        <input type="submit" value="Edit" class="btn">
                    </form>
                </div>
            </div>
            <div class="card">
                <h1>Add Content</h1>
                <p>We display articles about places, hotels and transport services in Sri Lanka. If you like to add your valuable content according to thease topics click the link down below.</p>
                <a href="createform.php">Create New Article</a>
            </div>
        </div>
    </section>
    <?php
    require_once "footer.php";
?>