<?php
  $isPrint = isset($_GET['print']);
  $isExtended = isset($_GET['contactdetails']); 
  $theme = $_GET['theme'] ?? (isset($_GET['print']) ? 'light' : '');
  $langCode = $_GET['lang'] ?? 'en'; // default to English
  $langFile = __DIR__ . "/languages/$langCode.php";

  if (file_exists($langFile)) {
    include $langFile;
  } else {
    include __DIR__ . "/languages/en.php";
  }

  $jobs = $lang['jobs'];
  krsort($jobs);

  $educations = $lang['education'];
  krsort($educations);
?>

<!DOCTYPE html>
<html lang="de" data-theme="<?= htmlspecialchars($theme) ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="format-detection" content="telephone=no">
  <title><?= $lang['myname'] ?> - <?= $lang['cvtitle'] ?></title>
  <link rel="stylesheet" href="styles.css" />
  <link href="fontawesome/css/all.css" rel="stylesheet" />
  <?php if ($isPrint): ?>
    <style>
      a {
        color: inherit;
        text-decoration: none;
      }
    </style>
  <?php else: ?>
    <style>
      a {
        color: inherit;
        text-decoration: underline;
      }
    </style>
  <?php endif; ?>
</head>
<body>

  <header class="header-row">
    <div class="name"><?= $lang['myname'] ?></div>
    <div class="title"><?= $lang['mytitle'] ?></div>
  </header>


  <section class="section" id="contact">
    <div class="section-title"><?= $lang['contact_section'] ?></div>
    <div class="section-content contact">
      <?php
        $allItems = array_filter($lang['contact'], function ($item) use ($isExtended) {
          return !($item['extended_only'] ?? false) || $isExtended;
        });

        $items = array_values($allItems);
        $half = ceil(count($items) / 2);
        $columns = array_chunk($items, $half);
      ?>

      <?php foreach ($columns as $column): ?>
        <div>
          <?php foreach ($column as $item): ?>
            <p>
              <?php if (!empty($item['icon'])): ?>
                <i class="<?= htmlspecialchars($item['icon']) ?>"></i>
              <?php endif; ?>
              <span class="label"><?= htmlspecialchars($item['label']) ?>:</span>
              <?php if (!empty($item['href'])): ?>
                <a href="<?= htmlspecialchars($item['href']) ?>"><?= htmlspecialchars($item['value']) ?></a>
              <?php else: ?>
                <?= htmlspecialchars($item['value']) ?>
              <?php endif; ?>
            </p>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>



  <section class="section" id="professional">
    <div class="section-title"><?= $lang['professional_section'] ?></div>
    <div class="section-content">

      <?php foreach ($jobs as $index => $job): ?>
        <div class="item" id="job-<?= $index ?>">
          <p class="job-title"><?= htmlspecialchars($job['title']) ?> | <?= htmlspecialchars($job['dates']) ?></p>
          <p class="job-company"><?= htmlspecialchars($job['company']) ?> · <?= htmlspecialchars($job['location']) ?></p>
          <ul class="job-description">
            <?php foreach ($job['description'] as $desc): ?>
              <li><?= htmlspecialchars($desc) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>

    </div>
  </section>

  <section class="section" id="education">
    <div class="section-title"><?= $lang['education_section'] ?></div>
    <div class="section-content">

      <?php foreach ($educations as $index => $edu): ?>
        <div class="item" id="edu-<?= $index ?>">
          <p class="edu-degree"><?= htmlspecialchars($edu['degree']) ?> | <?= htmlspecialchars($edu['dates']) ?></p>
          <p class="edu-institution"><?= $edu['institution'] ?></p>

          <?php if (!$isPrint && !empty($edu['courses'])): ?>
            <details class="edu-classes">
              <summary><?= $lang['show_courses'] ?? 'Show classes' ?></summary>
              <ul>
                <?php foreach ($edu['courses'] as $course): ?>
                  <?php
                    $isFav = str_starts_with($course, 'fav:');
                    $cleanCourse = $isFav ? substr($course, 4) : $course;
                  ?>
                  <li<?= $isFav ? ' class="fav-class"' : '' ?>><?= $cleanCourse ?></li>
                <?php endforeach; ?>
              </ul>
            </details>
          <?php endif; ?>

          <?php if (!empty($edu['description'])): ?>
            <ul class="edu-description">
              <?php foreach ($edu['description'] as $desc): ?>
                <li><?= $desc ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>

    </div>

  </section>


  <section class="section" id="skills">
    <div class="section-title"><?= $lang['skills_section'] ?></div>
    <div class="section-content">
      <div class="skills-grid">

        <?php foreach ($lang['skills'] as $key => $group): ?>
          <div class="skills-card" id="skills-<?= $key ?>">
            <div class="skills-title">
              <?php if (!empty($group['icon'])): ?><i class="<?= $group['icon'] ?>"></i><?php endif; ?>
              <?= htmlspecialchars($group['title']) ?>
            </div>
            <?php foreach ($group['items'] as $i => $item): ?>
              <span><?= htmlspecialchars($item) ?></span>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </section>


  <section class="section" id="projects">
    <div class="section-title"><?= $lang['projects_section'] ?></div>
    <div class="section-content">
      <div class="proj-grid">

        <?php foreach ($lang['projects'] as $id => $proj): ?>
          <div class="proj-card" id="proj-<?= htmlspecialchars($id) ?>">
            <div class="proj-title">
              <a href="<?= htmlspecialchars($proj['url']) ?>"><?= htmlspecialchars($proj['name']) ?></a>
              <?php if (!empty($proj['context'])): ?>
                (<?= htmlspecialchars($proj['context']) ?>)
              <?php endif; ?>
              <?php foreach ($proj['tech'] as $icon): ?>
                <i class="<?= htmlspecialchars($icon) ?>"></i>
              <?php endforeach; ?>
            </div>
            <p><?= htmlspecialchars($proj['description']) ?></p>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </section>

</body>
</html>
