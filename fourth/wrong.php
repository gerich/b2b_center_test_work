<?php

/**
 * @param string $user_ids
 * @return array
 */
function load_users_data($user_ids)
{
    $user_ids = explode(',', $user_ids);
    // Нужно коннетк к бд вынести за цикл
    foreach ($user_ids as $user_id) {
        // Безопаснее использовать PDO и параметры
        $db  = mysqli_connect("localhost", "root", "123123", "database");
        // SQL injection: ?users_id=1,'; SELECT User, Host, Password FROM mysql.user;
        // Не плохо было бы обернуть работу с бд в try catch
        $sql = mysqli_query($db, "SELECT * FROM users WHERE id=$user_id");
        // Проверка if на то что пользователь был выбран из бд была бы нагляднее на мой взгляд
        while ($obj = $sql->fetch_object()) {
            $data[$user_id] = $obj->name;
        }
        mysqli_close($db);
    }
    return $data;
}

// Как правило, в $_GET['user_ids'] должна приходить строка
// с номерами пользователей через запятую, например: 1,2,17,48
$data = load_users_data($_GET['user_ids']);
foreach ($data as $user_id => $name) {
    // Тут не фильтрации, можно попробывать ?users_id=1,; SELECT "<script>alert()</script>" as name;
    echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
}
