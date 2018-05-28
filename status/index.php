<?php
    require_once 'parsecsv.lib.php';

    $data = file_get_contents('https://docs.google.com/spreadsheets/d/1ykT8Iir88uVKPXw5Ma4WFxxDTXNLfWrtOL-nCCw1kh8/pub?gid=0&single=true&output=csv');

    $csv = new parseCSV();
    $csv->encoding('UTF-8');
    $csv->delimiter = ",";
    $csv->parse($data);

    $countOrders = 0;
    $countFixes = 0;
    foreach ($csv->data as &$strings) {
        $status = $strings['статус'];
        $inQueue = $strings['в очереди'];
        if ($inQueue == '*') {
            if ($status == 'заказ') {
                $countOrders++;
            } else if ($status == 'доработка') {
                $countFixes++;
            }
        }
    }
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Статус работы</title>

    <link rel="icon" type="image/png" href="/img/favicon/32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/img/favicon/128.png" sizes="128x128"/>
    <link rel="icon" type="image/png" href="/img/favicon/256.png" sizes="256x256"/>
    <link rel="icon" type="image/svg+xml" href="/img/logo.svg"/>

    <link rel="stylesheet" href="/main.css"/>
</head>
<body>

<h1>Статус работы</h1>

<p>В очереди новых программ: <strong><?php echo $countOrders ?></strong>.</p>
<p>В очереди доработок: <strong><?php echo $countFixes ?></strong>.</p>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-4524239-5', 'auto');
    ga('send', 'pageview');

</script>

</body>
</html>