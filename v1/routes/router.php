<?php
$request_uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode("/", $request_uri_path);

// if($uri[1] == "dev"){
//     $_SESSION['dev'] = true;
//     header("Location: /");
//     die;
// }

// if(!isset($_SESSION['dev'])){
//   include APP_PATH."/views/landing.php";
//   die;
// }

// var_dump($urlToPage); die;

if (count($uri) > 2) {

  switch ($uri[1]."/".$uri[2]) {

    // ── Mike Mahony detail routes ──────────────────────────────
    case 'services/'.$uri[2]:
      // /services/{hash_id} or /services/{hash_id}/{slug}
      include APP_PATH."/views/service_detail.php";
      $is404 = false;
      die;

    case 'podcast/'.$uri[2]:
      // /podcast/{hash_id}
      include APP_PATH."/views/podcast_episode.php";
      $is404 = false;
      die;

    case 'blog/'.$uri[2]:
      // /blog/{hash_id} or /blog/{hash_id}/{slug}
      include APP_PATH."/views/blog_post.php";
      $is404 = false;
      die;

    // ── Legacy routes (kept for backward compatibility) ────────
    case 'news_details/'.$uri[2]:
      include APP_PATH."/views/news_details.php";
      die;
      break;

    case 'project_details/'.$uri[2]:
      include APP_PATH."/views/project_details.php";
      die;
      break;

    case 'event_details/'.$uri[2]:
      include APP_PATH."/views/event_details.php";
      die;
      break;

  }



}else{

  switch ($uri[1]) {

    case 'test':
    include APP_PATH."/views/test.php";
    break;

  case '':
    include APP_PATH."/views/home.php";
    die;
    break;
  
  case 'home':
    include APP_PATH."/views/home.php";
    die;
    break;
  
  case ltrim($urlToPage['home'] ?? 'home', '/'):
    include APP_PATH."/views/home.php";
    break;

  case 'services':
    include APP_PATH."/views/services.php";
    die;
    break;

  case 'pricing':
    include APP_PATH."/views/pricing.php";
    die;
    break;

  case 'coverage':
    include APP_PATH."/views/coverage.php";
    die;
    break;

  case 'reviews':
    include APP_PATH."/views/reviews.php";
    die;
    break;

  case 'about':
    include APP_PATH."/views/about.php";
    die;
    break;

  case ltrim($urlToPage['about'] ?? 'about', 'about'):
  include APP_PATH."/views/about.php";
  break;
    
  case 'contact':
    include APP_PATH."/views/contact.php";
    die;
    break;

  case ltrim($urlToPage['contact'] ?? 'contact', 'contact'):
    include APP_PATH."/views/contact.php";
    break;

  // ── Mike Mahony pages ──────────────────────────────────────
  case 'podcast':
    include APP_PATH."/views/podcast.php";
    $is404 = false;
    die;

  case 'blog':
    include APP_PATH."/views/blog.php";
    $is404 = false;
    die;

  case 'book-session':
    include APP_PATH."/views/book_session.php";
    $is404 = false;
    die;

  // ── Mike Mahony form backends ──────────────────────────────
  case 'mm-contact':
    include APP_PATH."/views/mm_contact_backend.php";
    $is404 = false;
    die;

  case 'mm-book-session':
    include APP_PATH."/views/mm_session_backend.php";
    $is404 = false;
    die;

  case 'mm-newsletter':
    include APP_PATH."/views/mm_newsletter_backend.php";
    $is404 = false;
    die;


  case 'team':
    include APP_PATH."/views/team.php";
    die;
    break;

case ltrim($urlToPage['team'] ?? 'team', 'team'):
  include APP_PATH."/views/team.php";
  break;

  case 'projects':
    include APP_PATH."/views/project.php";
    die;
    break;

case ltrim($urlToPage['projects'] ?? 'projects', 'projects'):
  include APP_PATH."/views/project.php";
  break;

  case 'news':
    include APP_PATH."/views/news.php";
    die;
    break;

case ltrim($urlToPage['news'] ?? 'news', 'news'):
  include APP_PATH."/views/news.php";
  break;
  
  case 'events':
    include APP_PATH."/views/events.php";
    die;
    break;

case ltrim($urlToPage['events'] ?? 'events', 'events'):
  include APP_PATH."/views/events.php";
  break;

  case 'gallery':
    include APP_PATH."/views/gallery.php";
    die;
    break;

case ltrim($urlToPage['gallery'] ?? 'gallery', 'gallery'):
  include APP_PATH."/views/gallery.php";
  break;
  
  case 'news_details':
    include APP_PATH."/views/news_details.php";
    die;
    break;

  case 'contact-mail':
    include APP_PATH."/views/contact_mail_backend.php";
    die;
    break;
  
  case 'maintenance':
    include APP_PATH."/views/maintenance.php";
    die;
    break;

  case 'preview':
    include APP_PATH."/views/preview.php";
    die;
    break;
  
  case 'fetch-news':
    include APP_PATH."/views/includes/fetch_news.php";
    die;
    break;
  
  case 'fetch-project':
    include APP_PATH."/views/includes/fetch_project.php";
    die;
    break;
  
  case 'validator':
    include APP_PATH."/views/validator.php";
    die;
    break;
}

// default:
        // var_dump($urlToFile);
        foreach ($urlToFile as $key => $value) {
          if ($key === $uri) {
              // var_dump($key, $value, $uri );
                include APP_PATH . "/views/"."{$urlToFile[$key]}.php";
                die();
            }
        }

}

?>
