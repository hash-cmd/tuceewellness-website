<main>
  <div class="dashboard">
    <div class="sidebar">
      <?php include "layouts/sidebar.php" ?>
    </div>

    <div class="main-content">
      <div class="dashboard-header">
        <div class="header-content">
            <button id="sidebarToggle" class="sidebar-toggle"><i class="fas fa-bars"></i></button>

          <div class="user-info">
            <span class="username">John Doe</span>
            <img src="assets/images/TUCEE-Institute-logo.png" alt="User Image" class="user-image">
          </div>
        </div>
      </div>

      <div class="page-name">
        <h2>Website Content</h2>
      </div>

      <div class="tab-carousel">
        <div class="tabs-wrapper" id="tabsWrapper">
          <?php
            $tabs = ['Home', 'About', 'Programs', 'Contact', 'Team', 'Events', 'FAQ', 'Blog', 'Gallery', 'Support'];
            foreach ($tabs as $tab) {
              $isActive = ($tab === 'Blog' && isset($editBlog)) ? 'active' : (($tab === 'Home' && !isset($editBlog)) ? 'active' : '');
              echo "<button class=\"tab $isActive\">$tab</button>";
            }
          ?>
        </div>
      </div>

      <?php if (!empty($error)): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="success-message"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <div class="tab-content" id="tabContent">
        <?php foreach ($tabs as $tab): ?>
          <div class="tab-section <?= ($tab === 'Blog' && isset($editBlog)) || ($tab === 'Home' && !isset($editBlog)) ? 'active' : '' ?>" data-tab="<?= $tab ?>">
            <h3><?= $tab ?> Content</h3>

<?php if ($tab === 'Home'): ?>
  <form action="/tucee/website" method="POST" enctype="multipart/form-data" class="home-content-form">
  <input type="hidden" name="form_type" value="home_update">

  <h4>Mini Carousel</h4>
<div class="carousel-form-wrapper">
  <?php for ($i = 1; $i <= 3; $i++): ?>
    <div class="carousel-slide-item">
      <div class="carousel-image-upload">
        <label>Slide <?= $i ?> Image</label>
        <input type="file" name="carousel_img_<?= $i ?>" accept="image/*">
        <?php if (!empty($homeData["carousel_img_$i"])): ?>
          <img src="<?= htmlspecialchars($homeData["carousel_img_$i"]) ?>" alt="Slide <?= $i ?> Image">
        <?php endif; ?>
      </div>
      <div class="carousel-text-fields">
        <label>Slide <?= $i ?> Title</label>
        <input type="text" name="carousel_title_<?= $i ?>" value="<?= htmlspecialchars($homeData["carousel_title_$i"] ?? '') ?>">

        <label>Slide <?= $i ?> Text</label>
        <textarea name="carousel_text_<?= $i ?>"><?= htmlspecialchars($homeData["carousel_text_$i"] ?? '') ?></textarea>
      </div>
    </div>
  <?php endfor; ?>
</div>


  <h4>Welcome Message</h4>
  <div class="form-grid-2">
    <div class="form-item">
      <label>Welcome Title</label>
      <input type="text" name="welcome_title" value="<?= htmlspecialchars($homeData['welcome_title'] ?? '') ?>">
    </div>
    <div class="form-item">
      <label>Welcome Paragraph</label>
      <textarea name="welcome_paragraph"><?= htmlspecialchars($homeData['welcome_paragraph'] ?? '') ?></textarea>
    </div>
  </div>

  <h4>CEO Message</h4>
  <div class="form-grid-2">
    <div class="form-item">
      <label>CEO Name</label>
      <input type="text" name="ceo_name" value="<?= htmlspecialchars($homeData['ceo_name'] ?? '') ?>">
    </div>
    <div class="form-item">
      <label>CEO Message</label>
      <textarea name="ceo_message"><?= htmlspecialchars($homeData['ceo_message'] ?? '') ?></textarea>
    </div>
    <div class="form-item">
      <label>CEO Image</label>
      <input type="file" name="ceo_image" accept="image/*">
      <?php if (!empty($homeData['ceo_image'])): ?>
        <img src="<?= htmlspecialchars($homeData['ceo_image']) ?>" style="width: 80px; margin-top: 5px;">
      <?php endif; ?>
    </div>
  </div>

  <h4>Services</h4>
  <div class="form-grid-2">
    <?php
      $services = ['reflexology', 'counselling', 'therapy', 'appointment'];
      foreach ($services as $s):
    ?>
      <div class="form-item">
        <label><?= strtoupper($s) ?> Title</label>
        <input type="text" name="service_<?= $s ?>_title" value="<?= htmlspecialchars($homeData["service_{$s}_title"] ?? '') ?>">
      </div>
      <div class="form-item">
        <label><?= strtoupper($s) ?> Description</label>
        <textarea name="service_<?= $s ?>_desc"><?= htmlspecialchars($homeData["service_{$s}_desc"] ?? '') ?></textarea>
      </div>
    <?php endforeach; ?>
  </div>

  <h4>Our Impact</h4>
  <div class="form-grid-3">
    <?php
      $impacts = ['clients', 'volunteers', 'corporate', 'professionals'];
      foreach ($impacts as $i):
    ?>
      <div class="form-item">
        <label>Impact <?= ucfirst($i) ?> Count</label>
        <input type="text" name="impact_<?= $i ?>_count" value="<?= htmlspecialchars($homeData["impact_{$i}_count"] ?? '') ?>">
      </div>
      <div class="form-item">
        <label>Impact <?= ucfirst($i) ?> Description</label>
        <textarea name="impact_<?= $i ?>_desc"><?= htmlspecialchars($homeData["impact_{$i}_desc"] ?? '') ?></textarea>
      </div>
    <?php endforeach; ?>
  </div>

  <button type="submit">Save Home Content</button>
</form>


<?php elseif ($tab === 'About'): ?>
  <form action="/tucee/website" method="POST" enctype="multipart/form-data" class="about-content-form">
    <input type="hidden" name="form_type" value="about_update">

    <h4>About Carousel Image</h4>
    <div class="form-item">
      <label>Header Image</label>
      <input type="file" name="about_carousel_img" accept="image/*">
      <?php if (!empty($aboutData['about_carousel_img'])): ?>
        <img src="<?= htmlspecialchars($aboutData['about_carousel_img']) ?>" style="width: 80px; margin-top: 5px;">
      <?php endif; ?>
    </div>

    <h4>Typewriter Text</h4>
    <div class="form-item">
      <label>Typewriter Text</label>
      <input type="text" name="typewriter_text" value="<?= htmlspecialchars($aboutData['typewriter_text'] ?? '') ?>">
    </div>

    <h4>Who We Are Paragraphs</h4>
    <?php for ($i = 1; $i <= 4; $i++): ?>
      <div class="form-item">
        <label>Paragraph <?= $i ?></label>
        <textarea name="about_paragraph_<?= $i ?>"><?= htmlspecialchars($aboutData["about_paragraph_$i"] ?? '') ?></textarea>
      </div>
    <?php endfor; ?>

    <h4>Strategic Objectives</h4>
    <?php for ($i = 1; $i <= 6; $i++): ?>
      <div class="form-item">
        <label>Objective <?= $i ?></label>
        <input type="text" name="strategic_objective_<?= $i ?>" value="<?= htmlspecialchars($aboutData["strategic_objective_$i"] ?? '') ?>">
      </div>
    <?php endfor; ?>

    <h4>Mission & Vision</h4>
    <div class="form-item">
      <label>Our Mission</label>
      <textarea name="mission_text"><?= htmlspecialchars($aboutData["mission_text"] ?? '') ?></textarea>
    </div>
    <div class="form-item">
      <label>Our Vision</label>
      <textarea name="vision_text"><?= htmlspecialchars($aboutData["vision_text"] ?? '') ?></textarea>
    </div>

    <button type="submit">Save About Content</button>
  </form>



            <?php elseif ($tab === 'Blog'): ?>
              <!-- BLOG ARTICLE FORM -->
              <div class="blog-wrapper">
                <div class="blog-form">
                  <h4><?= isset($editBlog) ? 'Edit Blog Article' : 'New Blog Article' ?></h4>
                  <form action="/tucee/website" method="POST" enctype="multipart/form-data" class="signup-form">
                    <?php if (isset($editBlog)): ?>
                      <input type="hidden" name="id" value="<?= $editBlog['id'] ?>">
                    <?php endif; ?>
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" name="title" id="title" required value="<?= $editBlog['title'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="author">Author</label>
                      <input type="text" name="author" id="author" required value="<?= $editBlog['author'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                      <label for="content">Content</label>
                      <textarea name="content" id="content" cols="80" rows="15" required><?= $editBlog['content'] ?? '' ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="image">Feature Image (optional)</label>
                      <input type="file" name="image" id="image" accept="image/*">
                    </div>
                    <div class="form-group">
                      <label><input type="checkbox" name="is_featured" value="1" <?= isset($editBlog) && $editBlog['is_featured'] ? 'checked' : '' ?>> Mark as featured</label>
                    </div>
                    <button type="submit"><?= isset($editBlog) ? 'Update Article' : 'Publish Article' ?></button>
                  </form>
                </div>

                <div class="articles-table">
                  <h4>Published Articles</h4>
                  <?php if (!empty($articles)): ?>
                    <table>
                      <thead>
                        <tr>
                          <th>#</th><th>Title</th><th>Author</th><th>Date</th><th>Image</th><th>Featured</th><th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($articles as $index => $article): ?>
                          <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($article['title']) ?></td>
                            <td><?= htmlspecialchars($article['author']) ?></td>
                            <td><?= date('Y-m-d', strtotime($article['published_at'])) ?></td>
                            <td>
                              <?php if ($article['image_path']): ?>
                                <img src="<?= htmlspecialchars($article['image_path']) ?>" alt="Img" style="width:40px;height:40px;object-fit:cover;border-radius:4px;">
                              <?php else: ?> — <?php endif; ?>
                            </td>
                            <td><?= $article['is_featured'] ? 'Yes' : 'No' ?></td>
                            <td>
                              <a href="/tucee/website?edit=<?= $article['id'] ?>" class="edit-btn">Edit</a>
                              <form action="/tucee/website" method="POST" style="display:inline;" onsubmit="return confirm('Delete this article?');">
                                <input type="hidden" name="delete_id" value="<?= $article['id'] ?>">
                                <button type="submit" class="delete-btn" style="border: none;">Delete</button>
                              </form>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  <?php else: ?>
                    <p>No articles yet.</p>
                  <?php endif; ?>
                </div>
              </div>

            <?php else: ?>
              <!-- Placeholder for other tabs -->
              <p>Manage <?= $tab ?> section content here.</p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</main>

<!-- Tab Switching Script -->
<script>
  const tabs = document.querySelectorAll('.tab');
  const sections = document.querySelectorAll('.tab-section');
  const lastTab = localStorage.getItem('activeTab') || '<?= isset($editBlog) ? 'Blog' : 'Home' ?>';

  tabs.forEach(tab => {
    if (tab.textContent.trim() === lastTab) tab.classList.add('active');
    else tab.classList.remove('active');
  });

  sections.forEach(section => {
    if (section.dataset.tab === lastTab) section.classList.add('active');
    else section.classList.remove('active');
  });

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const selectedTab = tab.textContent.trim();
      tabs.forEach(t => t.classList.remove('active'));
      sections.forEach(s => s.classList.remove('active'));
      tab.classList.add('active');
      document.querySelector(`.tab-section[data-tab="${selectedTab}"]`).classList.add('active');
      localStorage.setItem('activeTab', selectedTab);
    });
  });
</script>

<style>
  header, footer { display: none; }
</style>


<script>
  document.querySelectorAll('input[type="file"][name^="carousel_img_"]').forEach(input => {
    input.addEventListener('change', e => {
      const file = e.target.files[0];
      if (file) {
        const img = e.target.closest('.carousel-image-upload').querySelector('img');
        if (img) {
          img.src = URL.createObjectURL(file);
        } else {
          const preview = document.createElement('img');
          preview.style.width = '100%';
          preview.style.height = '150px';
          preview.style.objectFit = 'cover';
          preview.style.borderRadius = '6px';
          preview.style.marginTop = '8px';
          preview.style.border = '1px solid #ccc';
          preview.src = URL.createObjectURL(file);
          e.target.parentNode.appendChild(preview);
        }
      }
    });
  });


document.querySelector('input[name="about_carousel_img"]').addEventListener('change', e => {
  const file = e.target.files[0];
  if (file) {
    const img = e.target.parentNode.querySelector('img');
    if (img) {
      img.src = URL.createObjectURL(file);
    } else {
      const preview = document.createElement('img');
      preview.style.width = '80px';
      preview.style.marginTop = '5px';
      preview.src = URL.createObjectURL(file);
      e.target.parentNode.appendChild(preview);
    }
  }
});

</script>


<script>
  const sidebar = document.querySelector('.sidebar');
  const toggleBtn = document.getElementById('sidebarToggle');

  toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('active');
  });

  // Optional: hide sidebar if clicked outside
  document.addEventListener('click', function (e) {
    if (
      sidebar.classList.contains('active') &&
      !sidebar.contains(e.target) &&
      !toggleBtn.contains(e.target)
    ) {
      sidebar.classList.remove('active');
    }
  });
</script>
