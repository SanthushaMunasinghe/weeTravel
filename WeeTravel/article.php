<?php
    require_once "loaddata.php";//connection to header
    
    $_POST = array();//clear all post values

    session_start();

    $statement = $pdo->prepare('SELECT * FROM '.$_SESSION['currentTable'].' WHERE'.$_SESSION['currentId'].' ORDER BY create_date DESC');//select table information
    $statement->execute();
    $article = $statement->fetch(PDO::FETCH_ASSOC);//Each details fetched as an associative array
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <section class="content">
        <div class="container">
            <div class="grid">
                <div class="card">
                    <div class="grid">
                        <div class="btns">
                            <!-- redirect to editform -->
                            <form method="get" action="editform.php">
                                <!-- get the current article id and load the php file according to it -->
                                <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                <button type="submit" class="btn">Edit</button>
                            </form>
                            <!-- redirect to delete -->
                            <form method="post" action="delete.php">
                                <!-- get the current article id and load the php file according to it -->
                                <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                    <!-- load table row data according to the current id -->
                    <p>Content Id : <?php echo $article['id']; ?> (Remember the Content Id to access your article again!)</p>
                    <h2><?php echo $article['title']; ?></h2>
                    <?php if ($article['image']){ ?>
                        <img src="<?php echo $article['image'] ?>">
                    <?php } else { ?>
                        <img src="images/altImage.png">
                    <?php } ?>
                    <div class="details">
                        <?php if ($article['location']): ?>
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="<?php echo $article['location']; ?>" target="_blank">Location</a>
                        <?php endif; ?>
                        <p><?php echo $article['description']; ?></p>
                        <ul>
                            <li>
                                <?php if ($article['location']): ?>
                                    <a href="<?php echo $article['article']; ?>" target="_blank">Read More</a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <a href="<?php echo $article['reference']; ?>" target="_blank"><?php echo $article['reference']; ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- redirect to the home page -->
                    <div class="btns"><a href="home.php">Confirm</a></div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
