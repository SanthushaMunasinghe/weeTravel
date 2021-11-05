<?php
    require_once "header.php";//connection to header
?>
    <!-- showcase -->
    <section class="showcase">
        <div class="container grid slide-in-anim">
            <div class="bg-image">
            </div>
            <div class="showcase-text">
                <h1>Best Travel Network In Sri Lanka</h1>
                <p>Best Guidance, Best Tour In Sri Lanka.</p>
            </div>
            <div class="slant"></div>
        </div>
        
    </section>
    <!-- about -->
    <section class="about">
        <div class="container slide-in-anim">
            <div class="description">
                <h2>About Us</h2>
                <p>
                    Sri Lanka is one of the most beautiful countries in the world. The island is located in the Indian Ocean and offers an amazing natural beauty tourist destination. There are many places in Sri Lanka that a tourist can visit. Our website is very popular in world. Through our website you can find out about places to visit in Sri Lanka, transportation and accommodation.
                </p>
            </div>
            <div class="services">
                <h2>Services</h2>
                <div class="grid">
                    <div class="card">
                        <div class="flex">
                            <i class="fas fa-map-marked-alt"></i>
                            <h3>Discover Places</h3>
                        </div>
                        <img src="images/location.png">
                        <p>Plan your itinerary with our list of best places to visit in Sri Lanka
                            <a href="places.php">Go to</a>
                        </p>
                    </div>
                    <div class="card">
                        <div class="flex">
                            <i class="fas fa-hotel"></i>
                            <h3>Find Best Hotels</h3>
                        </div>
                        <img src="images/Hotel.png">
                        <p>There are number of hotels in Sri Lanka at budget friendly prices that provide guests with relaxation and comfort. If you are planning a trip and looking for accommodation, these hotels are what you need.
                            <a href="hotels.php">Go to</a>
                        </p>
                    </div>
                    <div class="card">
                        <div class="flex">
                            <i class="fas fa-bus-alt"></i>
                            <h3>Find Transport</h3>
                        </div>
                        <img src="images/Bus.png">
                        <p>There are many modes of transport to travel. They are walking, biking, cars,trains, buses and boats. You can give it a try.
                            <a href="transport.php">Go to</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    require_once "footer.php"; //load footer
?>