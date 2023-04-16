<?php 

session_start();

include "./config/dbconnect.php";
include "./config/classes/Courses.php";
$q = new Courses();

    // check GET request course_code param
    if(isset($_GET['course_code'])){
        $course_code = $_GET['course_code'];

        

        // make sql
        $questions = $q->getQuestionsBy($course_code);
        
    }
    else{
        $questions = $q->getAllQuestions();
    }



include "./templates/header.php"

?>


<title><?php echo htmlspecialchars($course_code). " Discussion"; ?>
</title>
</head>
<body>

<?php include "./templates/navigation.php" ?>

    <section class="container">

        <h1 class="text-center"><?php echo htmlspecialchars($questions['course_code'])?> Discussion Forum</h1>
        <div class="discussion">
            <?php foreach ($questions as $question){ ?>
                <?php $username = $question['username']; $posted = $question['created_at']; ?>
                
                <div>
                    <h4><span class="text-danger">Q.</span><?php echo htmlspecialchars($question['question_title']); ?> <span class="" style="font-size:small; color:brown">(<?php echo $question['course_code'] ?>)</span> </h4>

                    <p>Asked by @<span><a href="user.php?username=<?php echo htmlspecialchars($username)?>"><?php echo htmlspecialchars($username)?></a></span> at <?php echo htmlspecialchars($question['created_at']); ?></p>

                    <p><span class="text-danger">Description : </span> <?php echo htmlspecialchars($question['question_body']); ?></p>
                    <a class="btn btn-primary" href="threads.php?question_id=<?php echo htmlspecialchars($question['question_id'])?>">Go to thread</a>
                    
                </div>

            <?php } ?>
            
        </div>
        <div class="answers">
            <ul>
                <?php foreach($answers as $answer){ ?>
                    <div>
                        <p><?php echo htmlspecialchars($answer['answer-text']) ?></p>
                        <p>Answered by @<?php echo htmlspecialchars($answer['username']) ?>
                        </p>
                    </div>
                <?php } ?>
                
            </ul>
        </div>

    </section>

<?php include "./templates/footer.php" ?>
</body>

</html>
