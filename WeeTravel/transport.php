<?php
    require_once "loaddata.php";//connection to header
    require_once "header.php";//connection to header

    $statement = $pdo->prepare('SELECT * FROM transport ORDER BY create_date DESC');//select    table information (transport)
    $statement->execute();
    $transports = $statement->fetchAll(PDO::FETCH_ASSOC);//Each details fetched as an associative array
?>
    <!-- search bar -->
    <section class="searchbar">
        <div class="container">
            <h2>Transport</h2>
            <div class="search-inputs">
                <input type="text" maxlength="20" placeholder="Search for transport service" id="filter">
            </div>
            
            <a href="createform.php">Register Service</a>
            <i class="fas fa-plus"></i>
        </div>
    </section>
    <!-- content -->
    <section class="content">
        <div class="container">
            <div class="grid" id="content-list">
            <!-- load content acoording to row count of the table -->
            <?php foreach ($transports as $transport): ?>
                <div class="card">
                    <h2><?php echo $transport['title']; ?></h2>
                    <!-- check if there is a image and load image according to the condition -->
                    <?php if ($transport['image']){ ?> 
                        <img src="<?php echo $transport['image'] ?>">
                    <?php } else { ?>
                        <img src="images/altImage.png">
                    <?php } ?>
                    <div class="details">
                        <!-- load location if there is one -->
                        <?php if ($transport['location']): ?>
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="<?php echo $transport['location']; ?>" target="_blank">Location</a>
                        <?php endif; ?>
                        <p><?php echo $transport['description']; ?></p>
                        <ul>
                            <!-- load readmore link if there is one -->
                            <?php if ($transport['article']): ?>
                                <li>
                                    <a href="<?php echo $transport['article']; ?>" target="_blank">Read More</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo $transport['reference']; ?>" target="_blank"><?php echo $transport['reference']; ?></a>
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