<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>

<body>
    <?php
    include 'query.php';
    $queries = new Queries();
    ?>


    <div style="border: 1px solid black; max-width: 400px; width: 100%; max-height: 400px; margin-bottom: 20px;">
        <br />

        INSERT:

        <form action="query.php" method="post" style="margin-top: 20px;">
            <div style="margin-bottom: 20px;">
                <label for="english">input english word: </label>
                <input type="text" name="english" placeholder="input english here">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="georgian">input georgian word</label>
                <input type="text" name="georgian" placeholder="input georgian here">
            </div>
            <div style="margin-bottom: 20px;">
                <label for="georgian">input second georgian word</label>
                <input type="text" name="georgianTwo" placeholder="input second georgian here">
            </div>

            <label for="correctanswer">correct answer will be</label>
            <input type="number" name="correctAnswer" id="answer">
            <button type="submit">input</button>
        </form>
    </div>

    <?php

    $rows = $queries->getAllDictionary();
    echo "<div style='border: 1px solid black; max-width: 400px; width: 100%; max-height: 400px; '>";
    echo "<br />";
    echo "TEST";
    foreach ($rows as $row) {
        echo "<div class='single_question' >";
        echo "<p>" . $row['english'] . "  targmani aris:" . "</p>";

        echo "<select onchange='checkifAnswer(this)' data-correctanswareid='" . $row['correctAnswer'] . "'>";
        echo "<option hidden >select the answare</option>";
        echo "<option value='1'>" . $row['georgian'] . "</option>";
        echo "<option value='2'>" . $row['georgianTwo'] . "</option>";
        echo "</select>";

        echo "<p class='error'></p>";

        echo "</div>";
    }
    echo "</div>";

    ?>

    <h1 class="score"></h1>



    <?php
    $rows = $queries->getAllDictionary();
    echo "<div style='border: 1px solid black; max-width: 400px; width: 100%; max-height: 400px;'>";
    echo "<br />";
    echo "ALL DICTIONARY: ";
    echo "<br />";
    echo "<br />";

    foreach ($rows as $row) {
        echo "<table  style='border: 1px solid black; ' border=1>";
        echo "<tr>";
        echo "<th> English </th>";
        echo "<td>" . $row['english'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th> gerogian </th>";
        echo "<td>" . $row['georgian'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th> gerogian two </th>";
        echo "<td>" . $row['georgianTwo'] . "</td>";
        echo "</tr>";
    }
    echo "</div>";
    ?>

</body>


<script>
    let randomNum = Math.floor(Math.random() * 2) + 1

    document.querySelector("#answer").value = randomNum;

    localStorage.clear();
    localStorage.setItem('score', 2);
    window.checkifAnswer = (selectElement) => {
        let isCorrect = selectElement.parentElement.querySelector('.error');
        selectElement.value == selectElement.dataset.correctanswareid;


        let curentScore = +localStorage.getItem('score');

        if (selectElement.value != selectElement.dataset.correctanswareid) {
            curentScore = curentScore - 2;
            localStorage.setItem('score', curentScore);
            let scoreElement = document.querySelector('.score');
            scoreElement.innerText = curentScore;
            isCorrect.innerHTML = "<p style='color: red;'>incorrect</p >";

        } else {
            curentScore = curentScore + 2;
            localStorage.setItem('score', curentScore);
            let scoreElement = document.querySelector('.score');
            scoreElement.innerText = curentScore;
            isCorrect.innerHTML = "<p style='color: green;'>correct</p >";
        }
    }
</script>

</html>