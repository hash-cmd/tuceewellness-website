<div class="news-content">
  <div class="news-header">
    <h1>
      <a href="/tucee/blog/show/<?= $article['id'] ?>">
        <?= htmlspecialchars($article['title']) ?>
      </a>
    </h1>
    <div class="news-meta">
      <span><i class="fas fa-user"></i> <?= htmlspecialchars($article['author']) ?></span>
      <span><i class="fas fa-clock"></i> <?= date('F j, Y', strtotime($article['published_at'])) ?></span>
    </div>
  </div>

  <div class="top-row">
    <?php if (!empty($article['image_path'])): ?>
      <a href="/tucee/blog/show/<?= $article['id'] ?>">
        <img src="/<?= htmlspecialchars($article['image_path']) ?>" alt="Main blog image">
      </a>
    <?php endif; ?>
  </div>

  <p class="description">
    <?= nl2br(htmlspecialchars(substr($article['content'], 0, 800))) ?>...
    <br>
    <a href="/tucee/blog/show/<?= $article['id'] ?>">Read more</a>
  </p>
</div>
