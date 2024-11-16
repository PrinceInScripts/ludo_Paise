<?php
include('db.php');
include('includes/sessions.php');

$session_user_id = $_SESSION['id']; // Fetch user_id from the session

// Initialize variables
$userEarning = 0; // Default earning is 0
$userRank = null;

// Fetch leaderboard data based on last 7 days (default)
$days = 7;
$sql = "SELECT user_id, SUM(ProfitAmount) as total 
        FROM game_record 
        WHERE status='won' 
        AND created_at >= DATE_SUB(CURDATE(), INTERVAL $days DAY)
        GROUP BY user_id 
        ORDER BY total DESC";
$sql_run = mysqli_query($con, $sql);

$teamData = [];
$rank = 1;

while ($row = mysqli_fetch_assoc($sql_run)) {
    $user_id = $row['user_id'];
    $total = $row['total'];

    $user_sql = "SELECT * FROM users WHERE id='$user_id'";
    $user_result = mysqli_query($con, $user_sql);
    $user_data = mysqli_fetch_assoc($user_result);

    $img_id = $user_data['profile_pic'];
    $img_sql = "SELECT * FROM profile_pic WHERE id='$img_id'";
    $img_result = mysqli_query($con, $img_sql);
    $img_data = mysqli_fetch_assoc($img_result);

    // If this is the session user, save their rank and earnings
    if ($user_id == $session_user_id) {
        $userRank = $rank;
        $userEarning = $total; // Update earning with actual amount
    }

    $teamData[] = [
        'rank' => $rank++,
        'name' => $user_data['username'],
        'handle' => $user_data['mobile'],
        'img' => $img_data['profile'],
        'kudos' => $total,
        'sent' => rand(1, 50)
    ];
}

// If user rank was not found, assign them the last rank
if ($userRank === null) {
    $userRank = $rank;
}

// Output data as JSON and pass user rank and earning
echo "<script>
        const team = " . json_encode($teamData) . ";
        const userRank = $userRank;
        const userEarning = $userEarning;
      </script>";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="taxify">
    <meta name="keywords" content="taxify">
    <meta name="author" content="taxify">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <title>Ludopaisa </title>

    <link rel="apple-touch-icon" href="../assets/images/logo/favicon.png">
    <meta name="title-color" content="#01AA85">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="taxify">
    <meta name="msapplication-TileImage" content="../assets/images/logo/favicon.png">

    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+DE+Grund:wght@100..400&display=swap" rel="stylesheet">
    <style>
        html {
            --black: #000;
            --white: #fff;
            --darkest: #101010;
            --darker: #16171a;
            --dark: #a3afbf;
            --medium: #dfe7ef;
            --light: #cad4e1;
            --lighter: #f5f8fc;
            --lightest: var(--white);
            --primary: #7b16ff;
            --primary-light: #ddd9ff;
            --primary-trans: rgba(123, 22, 255, 0.4);
            --yellow: #fdcb6e;
            --orange: #e17055;
            --teal: #00cec9;
            --bg: var(--darkest);
            --color: var(--lightest);
            --surface: var(--darker);
        }

        html {
            font-size: 62.5%;
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            background: var(--bg);
            color: var(--color);
            font-size: 1.6rem;
            font-family: "Playwrite DE Grund", cursive;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 0.8rem;
            margin-bottom: 0.8rem;
            font-family: 'Oswald', system-ui;
        }

        a {
            color: var(--primary);
            text-decoration: none;
            transition: all 120ms ease-out 0s;
            display: inline-block;
            border-radius: 0.4rem;
        }

        a:hover {
            background: var(--primary-trans);
            color: var(--primary-light);
            box-shadow: 0px 0px 0px 0.4rem var(--primary-trans);
        }

        button,
        textarea,
        input,
        select {
            font-family: inherit;
            color: inherit;
        }

        button:active,
        textarea:active,
        input:active,
        select:active,
        button:focus,
        textarea:focus,
        input:focus,
        select:focus {
            outline: 0;
        }

        button,
        select {
            cursor: pointer;
        }

        .l-wrapper {
            width: 100%;
            max-width: 960px;
            margin: auto;
            padding: 1.6rem 1.6rem 3.2rem;
        }

        .l-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            grid-column-gap: 1.6rem;
            grid-row-gap: 1.6rem;
            position: relative;
        }

        @media screen and (max-width: 700px) {
            .l-grid {
                grid-template-columns: 1fr;
            }
        }

        .c-header {
            padding: 1.6rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.4rem;
            position: relative;
        }

        .c-header:before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            height: 0.2rem;
            background: var(--primary-trans);
        }

        .c-card {
            border-radius: 0.8rem;
            background: var(--surface);
            width: 100%;
            margin-bottom: 1.6rem;
            box-shadow: 0px 0px 0px 1px rgba(255, 255, 255, 0.12);
        }

        .c-card__body,
        .c-card__header {
            padding: 2.4rem;
        }

        @media screen and (max-width: 700px) {

            .c-card__body,
            .c-card__header {
                padding: 1.2rem;
            }
        }

        .c-card__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 0;
        }

        @media screen and (max-width: 700px) {
            .c-card__header {
                flex-direction: column;
            }
        }

        @media screen and (max-width: 700px) {
            .c-place {
                transform: translateY(4px);
            }
        }

        .c-logo {
            display: inline-block;
            width: 100%;
            max-width: 17.6rem;
            user-select: none;
        }

        .c-list {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .c-list__item {
            padding: 1.6rem 0;
        }

        .c-list__item .c-flag {
            margin-top: 0.8rem;
        }

        @media screen and (max-width: 700px) {
            .c-list__item .c-flag {
                margin-top: 0.4rem;
            }
        }

        .c-list__grid {
            display: grid;
            grid-template-columns: 4.8rem 3fr 1fr;
            grid-column-gap: 2.4rem;
        }

        @media screen and (max-width: 700px) {
            .c-list__grid {
                grid-template-columns: 3.2rem 3fr 1fr;
                grid-column-gap: 0.8rem;
            }
        }

        .c-media {
            display: inline-flex;
            align-items: center;
        }

        .c-media__content {
            padding-left: 1.6rem;
        }

        @media screen and (max-width: 700px) {
            .c-media__content {
                padding-left: 0.8rem;
            }
        }

        .c-media__title {
            margin-bottom: 0.4rem;
        }

        @media screen and (max-width: 700px) {
            .c-media__title {
                font-size: 1.4rem;
            }
        }

        .c-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 4.8rem;
            height: 4.8rem;
            box-shadow: inset 0px 0px 0px 1px currentColor;
            border-radius: 50%;
            background: var(--lightest);
            color: var(--dark);
        }

        @media screen and (max-width: 700px) {
            .c-avatar {
                width: 3.2rem;
                height: 3.2rem;
            }
        }

        .c-avatar--lg {
            width: 9.6rem;
            height: 9.6rem;
        }

        .c-button {
            display: inline-block;
            color: #fff;
            font-weight: 800;
            background: var(--dark);
            border: 0;
            border-radius: 0.4rem;
            padding: 1.2rem 2rem;
            transition: all 120ms ease-out 0s;
        }

        .c-button--block {
            display: block;
            width: 100%;
        }

        .c-button:hover,
        .c-button:focus {
            filter: brightness(0.9);
        }

        .c-button:focus {
            box-shadow: 0px 0px 0px 0.4rem var(--primary-trans);
        }

        .c-button:active {
            box-shadow: 0px 0px 0px 0.4rem var(--primary-trans), inset 0px 0px 0.8rem rgba(0, 0, 0, 0.2);
            filter: brightness(0.8);
        }

        .c-select {
            background: transparent;
            padding: 1.2rem;
            appearance: none;
            font-size: 1.4rem;
            border-color: rgba(255, 255, 255, 0.2);
            transition: all 120ms ease-out 0s;
        }

        .c-select:hover {
            background: var(--darkest);
        }

        .c-flag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 3.2rem;
            height: 3.2rem;
            background: var(--lightest);
            color: var(--dark);
            border-radius: 0.4rem;
        }

        @media screen and (max-width: 700px) {
            .c-flag {
                width: 2.4rem;
                height: 2.4rem;
            }
        }

        .c-button--light {
            background: var(--lightest);
        }

        .c-button--primary {
            background: var(--primary);
        }

        .c-button--dark {
            background: var(--darkest);
        }

        .c-button--transparent {
            background: transparent;
        }

        .c-button--medium {
            background: var(--medium);
        }

        .c-button--yellow {
            background: var(--yellow);
        }

        .c-button--orange {
            background: var(--orange);
        }

        .c-button--teal {
            background: var(--teal);
        }

        .c-button--light-gradient {
            background: linear-gradient(to top, var(--light), var(--lightest));
        }

        .u-text--title {
            font-family: 'Oswald', system-ui;
        }

        .u-text--left {
            text-align: left;
        }

        .u-text--center {
            text-align: center;
        }

        .u-text--right {
            text-align: right;
        }

        .u-bg--light {
            background: var(--lightest) !important;
        }

        .u-text--light {
            color: var(--lightest) !important;
        }

        .u-bg--primary {
            background: var(--primary) !important;
        }

        .u-text--primary {
            color: var(--primary) !important;
        }

        .u-bg--dark {
            background: var(--darkest) !important;
        }

        .u-text--dark {
            color: var(--darkest) !important;
        }

        .u-bg--transparent {
            background: transparent !important;
        }

        .u-text--transparent {
            color: transparent !important;
        }

        .u-bg--medium {
            background: var(--medium) !important;
        }

        .u-text--medium {
            color: var(--medium) !important;
        }

        .u-bg--yellow {
            background: var(--yellow) !important;
        }

        .u-text--yellow {
            color: var(--yellow) !important;
        }

        .u-bg--orange {
            background: var(--orange) !important;
        }

        .u-text--orange {
            color: var(--orange) !important;
        }

        .u-bg--teal {
            background: var(--teal) !important;
        }

        .u-text--teal {
            color: var(--teal) !important;
        }

        .u-bg--light-gradient {
            background: linear-gradient(to top, var(--light), var(--lightest)) !important;
        }

        .u-text--light-gradient {
            color: linear-gradient(to top, var(--light), var(--lightest)) !important;
        }

        .u-display--flex {
            display: flex;
        }

        .u-align--center {
            align-items: center;
        }

        .u-justify--center {
            justify-content: center;
        }

        .u-align--flex-end {
            align-items: flex-end;
        }

        .u-justify--flex-end {
            justify-content: flex-end;
        }

        .u-align--flex-start {
            align-items: flex-start;
        }

        .u-justify--flex-start {
            justify-content: flex-start;
        }

        .u-align--space-between {
            align-items: space-between;
        }

        .u-justify--space-between {
            justify-content: space-between;
        }

        .u-text--small {
            font-size: 1.4rem;
        }

        .u-pl--2 {
            padding-left: 0.2rem;
        }

        .u-ml--2 {
            margin-left: 0.2rem;
        }

        .u-pr--2 {
            padding-right: 0.2rem;
        }

        .u-mr--2 {
            margin-right: 0.2rem;
        }

        .u-pb--2 {
            padding-bottom: 0.2rem;
        }

        .u-mb--2 {
            margin-bottom: 0.2rem;
        }

        .u-pt--2 {
            padding-top: 0.2rem;
        }

        .u-mt--2 {
            margin-top: 0.2rem;
        }

        .u-pl--4 {
            padding-left: 0.4rem;
        }

        .u-ml--4 {
            margin-left: 0.4rem;
        }

        .u-pr--4 {
            padding-right: 0.4rem;
        }

        .u-mr--4 {
            margin-right: 0.4rem;
        }

        .u-pb--4 {
            padding-bottom: 0.4rem;
        }

        .u-mb--4 {
            margin-bottom: 0.4rem;
        }

        .u-pt--4 {
            padding-top: 0.4rem;
        }

        .u-mt--4 {
            margin-top: 0.4rem;
        }

        .u-pl--8 {
            padding-left: 0.8rem;
        }

        .u-ml--8 {
            margin-left: 0.8rem;
        }

        .u-pr--8 {
            padding-right: 0.8rem;
        }

        .u-mr--8 {
            margin-right: 0.8rem;
        }

        .u-pb--8 {
            padding-bottom: 0.8rem;
        }

        .u-mb--8 {
            margin-bottom: 0.8rem;
        }

        .u-pt--8 {
            padding-top: 0.8rem;
        }

        .u-mt--8 {
            margin-top: 0.8rem;
        }

        .u-pl--16 {
            padding-left: 1.6rem;
        }

        .u-ml--16 {
            margin-left: 1.6rem;
        }

        .u-pr--16 {
            padding-right: 1.6rem;
        }

        .u-mr--16 {
            margin-right: 1.6rem;
        }

        .u-pb--16 {
            padding-bottom: 1.6rem;
        }

        .u-mb--16 {
            margin-bottom: 1.6rem;
        }

        .u-pt--16 {
            padding-top: 1.6rem;
        }

        .u-mt--16 {
            margin-top: 1.6rem;
        }

        .u-pl--24 {
            padding-left: 2.4rem;
        }

        .u-ml--24 {
            margin-left: 2.4rem;
        }

        .u-pr--24 {
            padding-right: 2.4rem;
        }

        .u-mr--24 {
            margin-right: 2.4rem;
        }

        .u-pb--24 {
            padding-bottom: 2.4rem;
        }

        .u-mb--24 {
            margin-bottom: 2.4rem;
        }

        .u-pt--24 {
            padding-top: 2.4rem;
        }

        .u-mt--24 {
            margin-top: 2.4rem;
        }

        .u-pl--32 {
            padding-left: 3.2rem;
        }

        .u-ml--32 {
            margin-left: 3.2rem;
        }

        .u-pr--32 {
            padding-right: 3.2rem;
        }

        .u-mr--32 {
            margin-right: 3.2rem;
        }

        .u-pb--32 {
            padding-bottom: 3.2rem;
        }

        .u-mb--32 {
            margin-bottom: 3.2rem;
        }

        .u-pt--32 {
            padding-top: 3.2rem;
        }

        .u-mt--32 {
            margin-top: 3.2rem;
        }
    </style>
</head>

<body>
<div class="l-wrapper">
        <div class="c-header">
            <img class="c-logo" src="../assets/images/logo/logo-1.png" draggable="false" />
            <a href="home" class="c-button c-button--primary">Go Back</a>
        </div>
        <div class="l-grid">
            <div class="l-grid__item l-grid__item--sticky">
                <div class="c-card u-bg--light-gradient u-text--dark">
                    <div class="c-card__body">
                        <div class="u-display--flex u-justify--space-between">
                            <div class="u-text--left">
                                <div class="u-text--small">My Rank</div>
                                <h2 id="user-rank"></h2>
                            </div>
                            <div class="u-text--right">
                                <div class="u-text--small">My Earning</div>
                                <h2 id="user-earning"></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-grid__item">
                <div class="c-card">
                    <div class="c-card__header">
                        <h3>Leaderboard</h3>
                        <select id="dateFilter" class="c-select" onchange="fetchLeaderboardData()">
                            <option value="7" selected>Last 7 Days</option>
                            <option value="30">Last Month</option>
                            <option value="365">Last Year</option>
                        </select>
                    </div>
                    <div class="c-card__body">
                        <ul class="c-list" id="list">
                            <!-- List items will be dynamically generated here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for populating data
        document.addEventListener("DOMContentLoaded", () => {
            document.getElementById("user-rank").textContent = userRank;
            document.getElementById("user-earning").textContent = userEarning;
            fetchLeaderboardData(); // Fetch data for default 7 days
        });

        function fetchLeaderboardData() {
            const dateFilter = document.getElementById("dateFilter").value;
            const list = document.getElementById("list");
            list.innerHTML = ""; // Clear the list

            fetch(`leaderboard.php?days=${dateFilter}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach((member) => {
                        let newRow = document.createElement("li");
                        newRow.classList = "c-list__item";
                        newRow.innerHTML = `
                            <div class="c-list__grid">
                                <div class="c-flag c-place u-bg--transparent">${member.rank}</div>
                                <div class="c-media">
                                    <img class="c-avatar c-media__img" src="../assets/images/profile/${member.img}" />
                                    <div class="c-media__content">
                                        <div class="c-media__title">${member.name}</div>
                                        <a class="c-media__link u-text--small" href="#0" target="_blank">@${member.handle.slice(0, 2) + "*".repeat(member.handle.length - 4) + member.handle.slice(-2)}</a>
                                    </div>
                                </div>
                                <div class="u-text--right c-kudos">
                                    <div class="u-mt--8">
                                        <strong>${member.kudos}</strong>
                                    </div>
                                </div>
                            </div>
                        `;
                        list.appendChild(newRow);
                    });
                });
        }
    </script>
</body>
</html>