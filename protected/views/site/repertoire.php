<div class="conteyner">
    <h4 class="text1">
        <p class="right_text">
            У репертуарі ансамблю близько <b>30 пісень</b>, з-поміж яких улюблені бойками українські народні та авторські пісні, а також календарно-обрядові (пісенні жанри зимового та весняного циклу) в обробці для ансамблевого виконання у супроводі бандури та скрипки Лариси Дуди.
        </p>
        <p class="right_text">А саме:</p>

        <?php
            $categories=repertoireDB::model()->findAllBySql("SELECT Category FROM repertoire WHERE Name='' ORDER BY ID"); //Пошук всіх категорій.
            foreach($categories as $category){
                echo "<p class='rep_header'>".$category->Category.":</p>";
                echo "<ol class='repertoire'>";
                $repertoires=repertoireDB::model()->findAllBySql("SELECT Name FROM repertoire WHERE Name!='' AND Category='".$category->Category."' ORDER BY ID"); //Пошук всіх репертуарів в категорії.
                foreach($repertoires as $repertoire){
                    echo "<li>".$repertoire->Name.".</li>";
                }
                echo "</ol>";
            }

        ?>

    </h4>
</div>