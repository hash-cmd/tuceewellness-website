<main>
  <div class="news-banner">
    <h2>Blog</h2>
  </div>

  <div class="news-main">
    <!-- Main Blog Article Section -->
    <section class="news-section">
      <div id="main-article">
        <?php if (!empty($articles)): ?>
          <?php $article = $articles[0]; ?>
          <?php include __DIR__ . '/partials/main_article.php'; ?>
        <?php endif; ?>
      </div>
    </section>

    <!-- Sidebar Section -->
    <section class="news-section">
      <div class="news-sidebar">

        <div class="sidebar-title sidebar-title-recently">
          <h4>Recently Posted</h4>
        </div>

        <?php foreach (array_slice($articles, 1, 3) as $article): ?>
          <div class="news-item">
            <a href="#" class="load-article" data-id="<?= $article['id'] ?>">
              <img src="/<?= htmlspecialchars($article['image_path']) ?>" alt="Thumbnail">
            </a>
            <div class="news-text">
              <h4>
                <a href="#" class="load-article" data-id="<?= $article['id'] ?>">
                  <?= htmlspecialchars($article['title']) ?>
                </a>
              </h4>
              <p><?= date('F j', strtotime($article['published_at'])) ?></p>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="sidebar-title sidebar-title-news-all">
          <h4>All Articles</h4>
        </div>

        <?php foreach ($articles as $article): ?>
          <div class="news-item">
            <a href="#" class="load-article" data-id="<?= $article['id'] ?>">
              <img src="as<?= htmlspecialchars($article['image_path']) ?>" alt="Thumbnail">
            </a>
            <div class="news-text">
              <h4>
                <a href="#" class="load-article" data-id="<?= $article['id'] ?>">
                  <?= htmlspecialchars($article['title']) ?>
                </a>
              </h4>
              <p><?= date('F j', strtotime($article['published_at'])) ?></p>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </section>
  </div>
</main>

<!-- JavaScript for dynamic article loading -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.load-article').forEach(item => {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        const articleId = this.getAttribute('data-id');

        fetch(`/tucee/blog/fetch/${articleId}`)
          .then(response => response.json())
          .then(data => {
            if (data.html) {
              document.getElementById('main-article').innerHTML = data.html;
              window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
              alert('Article not found');
            }
          })
          .catch(() => alert('Something went wrong'));
      });
    });
  });
</script>
