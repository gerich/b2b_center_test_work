<?php

if (isset($argv)) {
    $_GET['user_ids'] = '1,2,3,4';
}

/**
 * @param string $user_ids
 * @return array
 */
function loadUsersData($user_ids)
{
    /** @var int[] $userIds */
    $userIds = array_map('intval', explode(',', $user_ids));
    $db  = new PDO('mysql:host=localhost;dbname=testdb', "testuser", "password");
    $stmt = $db->prepare('SELECT name FROM users WHERE id=:user');
    $data = [];
    foreach ($userIds as $id) {
        $stmt->execute([':user' => $id]);
        $user = $stmt->fetchColumn();
        if ($user) {
            $data[$id] = $user;
        }
    }
    $db = null;
    return $data;
}

// Как правило, в $_GET['user_ids'] должна приходить строка
// с номерами пользователей через запятую, например: 1,2,17,48
$data = loadUsersData($_GET['user_ids']);
foreach ($data as $userId => $name) {
    echo sprintf('<a href="/show_user.php?id=%d">%s</a>', $userId, $name);
}

