<main>
  <section class="carousel">
    <div class="mini-carousel">
      <div class="mini-carousel-container">
        <div class="mini-carousel-slide">
          <div class="mini-slide">
            <h3><?= $homeData['carousel_title_1'] ?? '' ?></h3>
            <p><?= $homeData['carousel_text_1'] ?? '' ?></p>
            <button>Learn More</button>
          </div>
          <div class="mini-slide">
            <h3><?= $homeData['carousel_title_2'] ?? '' ?></h3>
            <p><?= $homeData['carousel_text_2'] ?? '' ?></p>
            <button>Learn More</button>
          </div>
          <div class="mini-slide">
            <h3><?= $homeData['carousel_title_3'] ?? '' ?></h3>
            <p><?= $homeData['carousel_text_3'] ?? '' ?></p>
            <button>Learn More</button>
          </div>
        </div>
      </div>
    </div>

    <div class="carousel-container">
      <div class="carousel-slide">
        <img src="<?= $homeData['carousel_img_1'] ?? '' ?>" alt="Image 1">
        <img src="<?= $homeData['carousel_img_2'] ?? '' ?>" alt="Image 2">
        <img src="<?= $homeData['carousel_img_3'] ?? '' ?>" alt="Image 3">
      </div>
    </div>
    <button class="prev">&#10094;</button>
    <button class="next">&#10095;</button>
  </section>

<section class="services-card">
  <div class="cards">
    <div class="card card-1">
      <div class="icon"><i class="bi bi-flower3"></i></div>
      <h3><?= $homeData['service_reflexology_title'] ?? '' ?></h3>
      <p><?= $homeData['service_reflexology_desc'] ?? '' ?></p>
      <div class="card-footer">
        <div class="green-line"></div>
        <button class="green-btn">VIEW ALL</button>
      </div>
    </div>

    <div class="card card-2">
      <div class="icon"><i class="bi bi-chat-dots-fill"></i></div>
      <h3><?= $homeData['service_counselling_title'] ?? '' ?></h3>
      <p><?= $homeData['service_counselling_desc'] ?? '' ?></p>
      <div class="card-footer">
        <div class="green-line"></div>
        <button class="green-btn">VIEW ALL</button>
      </div>
    </div>

    <div class="card card-3">
      <div class="icon"><i class="bi bi-heart-pulse-fill"></i></div>
      <h3><?= $homeData['service_therapy_title'] ?? '' ?></h3>
      <p><?= $homeData['service_therapy_desc'] ?? '' ?></p>
      <div class="card-footer">
        <div class="green-line"></div>
        <button class="green-btn">VIEW ALL</button>
      </div>
    </div>

    <div class="card card-4">
      <div class="icon"><i class="bi bi-calendar-check-fill"></i></div>
      <h3><?= $homeData['service_appointment_title'] ?? '' ?></h3>
      <p><?= $homeData['service_appointment_desc'] ?? '' ?></p>
      <div class="card-footer">
        <div class="green-line"></div>
        <button class="green-btn">BOOK A SESSION</button>
      </div>
    </div>
  </div>
</section>


  <section class="brief-message">
    <div class="message-container">
      <h1><?= $homeData['welcome_title'] ?? '' ?></h1>
      <p><?= $homeData['welcome_paragraph'] ?? '' ?></p>

      <div class="message">
        <div class="sub-message">
          <div>
            <h3>A Message From the C.E.O</h3>
             <p><?= nl2br($homeData['ceo_message'] ?? '') ?></p>
          </div>
          <div>
             <img src="<?= $homeData['ceo_image'] ?? '' ?>" alt="<?= $homeData['ceo_name'] ?? 'CEO' ?>" />
            <h3><?= $homeData['ceo_name'] ?? '' ?></h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="services">
    <div class="services-container">
      <div class="services-impact-top">
        <h1>Our Impact</h1>
        <div class="services-count">
          <h1><?= $homeData['impact_clients_count'] ?? '' ?></h1>
          <p><?= $homeData['impact_clients_desc'] ?? '' ?></p>
        </div>
        <div class="services-count">
          <h1><?= $homeData['impact_volunteers_count'] ?? '' ?></h1>
          <p><?= $homeData['impact_volunteers_desc'] ?? '' ?></p>
        </div>
      </div>
      <div class="services-impact-down">
        <div class="services-count">
          <h1><?= $homeData['impact_corporate_count'] ?? '' ?></h1>
          <p><?= $homeData['impact_corporate_desc'] ?? '' ?></p>
        </div>
        <div class="services-count">
          <h1><?= $homeData['impact_professionals_count'] ?? '' ?></h1>
          <p><?= $homeData['impact_professionals_desc'] ?? '' ?></p>
        </div>
      </div>
    </div>
  </section>
</main>
