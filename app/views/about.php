<main>
    <section class="carousel">
        <div class="carousel-container">
            <div class="carousel-slide">
                <img src="<?= $aboutData['about_carousel_img'] ?? 'assets/images/default.jpg' ?>" alt="About Carousel">
            </div>
        </div>
        <div class="typewriter-container">
            <span id="typewriter-text"><?= $aboutData['typewriter_text'] ?? '' ?></span><span class="cursor">|</span>
        </div>
    </section>

    <section class="about">
        <div class="about-container">
            <h2>Who We Are</h2>
            <p><?= $aboutData['about_paragraph_1'] ?? '' ?></p>
            <p><?= $aboutData['about_paragraph_2'] ?? '' ?></p>
            <p><?= $aboutData['about_paragraph_3'] ?? '' ?></p>
            <p><?= $aboutData['about_paragraph_4'] ?? '' ?></p><br>
        </div>
    </section>

    <section class="info-vertical">
        <div class="info-wrapper">

            <div class="info-block">
                <div class="info-icon">
                    <i class="bi bi-heart-fill"></i>
                    <div class="icon-backdrop"></div>
                </div>
                <h5 class="info-heading">Our Strategic Objectives</h5>
                <ul style="list-style: none; text-align: justify; padding: 0;">
                    <li style="margin-bottom: 8px;"><?= $aboutData['strategic_objective_1'] ?? '' ?></li>
                    <li style="margin-bottom: 8px;"><?= $aboutData['strategic_objective_2'] ?? '' ?></li>
                    <li style="margin-bottom: 8px;"><?= $aboutData['strategic_objective_3'] ?? '' ?></li>
                    <li style="margin-bottom: 8px;"><?= $aboutData['strategic_objective_4'] ?? '' ?></li>
                    <li style="margin-bottom: 8px;"><?= $aboutData['strategic_objective_5'] ?? '' ?></li>
                    <li style="margin-bottom: 8px;"><?= $aboutData['strategic_objective_6'] ?? '' ?></li>
                </ul>
                <div class="info-hover-effect"></div>
            </div>

            <div class="info-block">
                <div class="info-icon">
                    <i class="bi bi-bullseye"></i>
                    <div class="icon-backdrop"></div>
                </div>
                <h5 class="info-heading">Our Mission</h5>
                <p class="info-description">
                    <?= $aboutData['mission_text'] ?? '' ?>
                </p>
                <div class="info-hover-effect"></div>
            </div>

            <div class="info-block">
                <div class="info-icon">
                    <i class="bi bi-eye fs-2"></i>
                    <div class="icon-backdrop"></div>
                </div>
                <h5 class="info-heading">Our Vision</h5>
                <p class="info-description">
                    <?= $aboutData['vision_text'] ?? '' ?>
                </p>
                <div class="info-hover-effect"></div>
            </div>

        </div>
    </section>
</main>
