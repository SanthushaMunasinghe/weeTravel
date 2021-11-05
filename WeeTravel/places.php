<?php
    require_once "loaddata.php";//connection to header
    require_once "header.php";//connection to header
    
    $statement = $pdo->prepare('SELECT * FROM places ORDER BY create_date DESC');//select    table information (places)
    $statement->execute();
    $places = $statement->fetchAll(PDO::FETCH_ASSOC);//Each details fetched as an associative array
?>
    <!-- search bar -->
    <section class="searchbar">
        <div class="container">
            <h2>Discover</h2>
            <div class="search-inputs">
                <input type="text" maxlength="100" placeholder="Search for places" id="filter">
            </div>
            <a href="createform.php">Add Content</a>
            <i class="fas fa-plus"></i>
        </div>
    </section>
    <!-- content -->
    <section class="content">
        <div class="container">
            <div class="grid" id="content-list">
                <!-- load content acoording to row count of the table -->
                <?php foreach ($places as $place): ?>
                <div class="card">
                    <h2><?php echo $place['title']; ?></h2>
                    <!-- check if there is a image and load image according to the condition -->
                    <?php if ($place['image']){ ?>
                        <img src="<?php echo $place['image'] ?>">
                    <?php } else { ?>
                        <img src="images/altImage.png">
                    <?php } ?>
                    <div class="details">
                        <!-- load location if there is one -->
                        <?php if ($place['location']): ?>
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="<?php echo $place['location']; ?>" target="_blank">Location</a>
                        <?php endif; ?>
                        <p><?php echo $place['description']; ?></p>
                        <ul>
                            <li>
                                <!-- load readmore link if there is one -->
                                <?php if ($place['location']): ?>
                                    <a href="<?php echo $place['article']; ?>" target="_blank">Read More</a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <a href="<?php echo $place['reference']; ?>" target="_blank"><?php echo $place['reference']; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script src="main.js"></script>
    </body>
</html>