<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }

    require_once 'config/dbconnect.php';
    require_once 'config/classes/Users.php';
    require_once 'config/classes/Courses.php';

    $c = new Courses();

    // check GET request course_code param
    if(isset($_GET['question_id'])){
        $question_id = $_GET['question_id'];

        $question = $c->getQuestion($question_id);
        $answers = $c->getAnswers($question_id);
        // echo $answers['question_title'];
    }


include "./templates/header.php"

?>


<title>Thread - <?= $question['question_title']?></title>
</head>
<body>

<?php include "./templates/navigation.php" ?>

    <section class="container my-5">

        <h1 class="text-center"><?php echo htmlspecialchars('Thread ID: 001')?> Threads</h1>
        <?php $username = $question['username']; $posted = $question['created_at']; ?>
                
        <div class="question bg-primary-subtle container rounded p-2" style="width:60%">
            <h4><span class="text-danger">Q.</span><?php echo htmlspecialchars($question['question_title']); ?> <span class="" style="font-size:small; color:brown">(<?php echo $question['course_code'] ?>)</span> </h4>

            <p>Asked by @<span><a href="user.php?username=<?php echo htmlspecialchars($username)?>"><?php echo htmlspecialchars($username)?></a></span> at <?php echo htmlspecialchars($question['created_at']); ?></p>

            <p><span class="text-danger">Description : </span> <?php echo htmlspecialchars($question['question_body']); ?></p>
            
        </div>

        <div class="add-answer  my-2 question bg-primary-subtle container rounded p-2" style="width:60%">
            <form class="d-flex" action="threads.php" method="post">

                <div class="form-group">
                    <label for="floatingTextarea">Your reply</label>
                    <textarea class="form-control" style="height: 100px" placeholder="CSE370 is an amazing course ..." id="floatingTextarea" name="answer"></textarea>
                    
                </div>

                <input class="" type="submit" value="Send">
            </form>
        </div>

        <!-- Previous Answers -->
        <div class="gy-5 my-3 question container rounded p-2" style="width:60%">
            <?php foreach($answers as $answer){ ?>
            
                <div class=" mb-3 mb-sm-0 d-flex" >
                    <div class="card p-3 shadow rounded">
                        <p><?php echo htmlspecialchars($answer['answer_text']);?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>

    </section>

<?php include "./templates/footer.php" ?>
</body>

</html>
