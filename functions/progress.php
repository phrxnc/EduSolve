<?php
function getUpNextLesson($userId, $currentLessonName, $pdo) {
    // Fetch current lesson ID and subject ID
    $query = $pdo->prepare("
        SELECT l.id, l.subject_id 
        FROM lessons l 
        WHERE l.name = :currentLessonName
    ");
    $query->execute([':currentLessonName' => $currentLessonName]);
    $currentLesson = $query->fetch();

    if (!$currentLesson) {
        return null; // No such lesson
    }

    // Check if the user passed the current lesson
    $query = $pdo->prepare("
        SELECT ls.score, l.passing_score 
        FROM lesson_scores ls 
        INNER JOIN lessons l ON l.id = ls.lesson_id 
        WHERE ls.user_id = :userId AND l.name = :currentLessonName
    ");
    $query->execute([
        ':userId' => $userId,
        ':currentLessonName' => $currentLessonName,
    ]);
    $result = $query->fetch();

    if (!$result || $result['score'] < $result['passing_score']) {
        return null; // User didn't pass the lesson
    }

    // Get the next lesson in the same subject
    $query = $pdo->prepare("
        SELECT l.name 
        FROM lessons l 
        WHERE l.subject_id = :subjectId AND l.id > :currentLessonId
        ORDER BY l.id ASC 
        LIMIT 1
    ");
    $query->execute([
        ':subjectId' => $currentLesson['subject_id'],
        ':currentLessonId' => $currentLesson['id'],
    ]);

    $nextLesson = $query->fetch();
    return $nextLesson ? $nextLesson['name'] : null;
}
?>
