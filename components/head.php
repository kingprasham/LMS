<?php
function renderHead($title = 'SAS-AI', $additionalCSS = [])
{
    $base = getBasePath();
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($title); ?></title>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-Z4ZYNE94Q6"></script>
        <script> 
        window.dataLayer = window.dataLayer || []; function gtag() { dataLayer.push(arguments); } gtag('js', new Date()); gtag('config', 'G-Z4ZYNE94Q6'); 
        </script>

        <meta name="google-site-verification" content="vrOzUQzKS58Wa2hpT0uw9luqFZrpMZ6oD9D2nGSQvAw" />
 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="<?php echo $base; ?>css/style.css">
        <?php foreach ($additionalCSS as $css): ?>
            <link rel="stylesheet" href="<?php echo $base . $css; ?>">
        <?php endforeach; ?>
    </head>

    <body>
        <?php
}
?>