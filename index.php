<?php
require_once 'header.php';
?>
<!--================================main container ==================================-->

<div class="main-container" id="myMain">
    <div class="main-top">
        <div class="main-top2">
            <button class="mainTop-btn">All</button>
            <button class="mainTop-btn">Notice</button>
        </div>
        <div class="main-top2">
            <div class="search">
                <input type="text" class="searchTerm" placeholder="Search here!">
                <button type="submit" class="searchButton"><i class="fa fa-search"></i></button>
            </div>

            <?php require_once 'write.php'; ?>

        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th scope="col" class="col-no">No</th>
                <th scope="col" class="col-category">Category</th>
                <th scope="col" class="col-title">Title</th>
                <th scope="col" class="col-writer">Writer</th>
                <th scope="col" class="col-date">Date</th>
            </tr>
        </thead>
        <tbody>

            <?php

            require 'dbconn.php';

            // reset the auto_increment to start counting from 1 again
            $sql = "alter table board drop id";
            $result = mysqli_query($conn, $sql);

            $sql = "alter table board add id int(11) not null AUTO_INCREMENT FIRST, ADD PRIMARY KEY(id)";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }

            // pagination
            $limit = 15;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $limit;

            $result = $conn->query("SELECT * FROM board order by id desc LIMIT $start, $limit");
            $board = $result->fetch_all(MYSQLI_ASSOC);

            $result1 = $conn->query("SELECT count(id) AS id FROM board");
            $count = $result1->fetch_all(MYSQLI_ASSOC);
            $total = $count[0]['id'];
            $pages = ceil($total / $limit);

            $previous = $page - 1;
            $next = $page + 1;

            if ($page == $pages) {
                $next = 1;
                $next = ($next);
            }
            if ($page == 1) {
                $previous = $pages;
                $previous = ($previous);
            }

            foreach ($board as $row) :
                $filtered = array(
                    'id' => htmlspecialchars($row['id']),
                    'category' => htmlspecialchars($row['category']),
                    'title' => htmlspecialchars($row['title']),
                    'content' => htmlspecialchars($row['content']),
                    'writer' => htmlspecialchars($row['writer']),
                    'date' => htmlspecialchars($row['date'])
                )

            ?>

                <tr>
                    <th scope="row"><?= $filtered['id'] ?></th>
                    <td><?= $filtered['category'] ?></td>
                    <td class="tbl-title">
                        <a href="detail_page.php?id=<?= $filtered['id'] ?>"><?= $filtered['title'] ?></a>
                    </td>
                    <td class="tbl-writer"><?= $filtered['writer'] ?></td>
                    <td><?= $filtered['date'] ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <div class="pagination" id="pagination">
        <a href="index.php?page=<?= $previous; ?>">&laquo;</a>
        <?php for ($i = 1; $i <= $pages; $i++) : ?>
            <li><a href="index.php?page=<?= $i; ?>"><?= $i; ?></a></li>
        <?php endfor; ?>
        <a href="index.php?page=<?= $next; ?>">&raquo;</a>
    </div>

</div>

<script>
    const main = document.getElementById("myMain");
    const side = document.getElementById("mySidebar");

    function toggleSidebar() {
        main.classList.toggle("collapseMain");
        side.classList.toggle("collapseSide");
    }
</script>

<?php
require_once 'footer.php';
?>