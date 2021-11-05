<?php
    require_once "loaddata.php";//connection to header
    require_once "header.php";//connection to header

    $statement = $pdo->prepare('SELECT * FROM hotels ORDER BY create_date DESC');//select    table information (hotels)
    $statement->execute();
    $hotels = $statement->fetchAll(PDO::FETCH_ASSOC);//Each details fetched as an associative array
?>
    <!-- search bar -->
    <section class="searchbar">
        <div class="container">
            <h2>Hotels</h2>
            <div class="search-inputs">
                <input type="text" maxlength="20" placeholder="Search for hotels" id="filter">
            </div>
            
            <a href="createform.php">Register Hotel</a>
            <i class="fas fa-plus"></i>
        </div>
    </section>
    <!-- content -->
    <section class="content">
        <div class="container">
            <div class="grid" id="content-list">
                <!-- load content acoording to row count of the table -->
                <?php foreach ($hotels as $hotel): ?>
                <div class="card">
                    <h2><?php echo $hotel['title']; ?></h2>
                    <!-- check if there is a image and load image according to the condition -->
                    <?php if ($hotel['image']){ ?>
                        <img src="<?php echo $hotel['image'] ?>">
                    <?php } else { ?>
                        <img src="images/altImage.png">
                    <?php } ?>
                    <div class="details">
                        <!-- load location if there is one -->
                        <?php if ($hotel['location']): ?>
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="<?php echo $hotel['location']; ?>" target="_blank">Location</a>
                        <?php endif; ?>
                        <p><?php echo $hotel['description']; ?></p>
                        <ul>
                            <!-- load readmore link if there is one -->
                            <?php if ($hotel['article']): ?>
                                <li>
                                    <a href="<?php echo $hotel['article']; ?>" target="_blank">Read More</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo $hotel['reference']; ?>" target="_blank"><?php echo $hotel['reference']; ?></a>
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